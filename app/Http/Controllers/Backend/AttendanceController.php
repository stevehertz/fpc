<?php

namespace App\Http\Controllers\Backend;

use App\Enums\EventPaymentStatus;
use App\Exports\Attendances\ConfirmedAttendanceExport;
use App\Exports\Attendances\ConfirmedDelegatesAttendanceExport;
use App\Exports\Attendances\ConfirmedExhibitorsAttendanceExport;
use setasign\Fpdi\Fpdi;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CancelAttendanceRequest;
use App\Http\Requests\ConfirmExhibitionRequest;
use App\Repositories\EventRepositories;
use App\Repositories\AttendanceRepository;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Mail\AttendanceCancelMail;
use App\Mail\AttendanceCCNdegwaMail;
use App\Mail\AttendanceConfirmationMail;
use App\Repositories\PaymentRepository;
use Illuminate\Foundation\Mix;
use Illuminate\Support\Facades\Mail;

class AttendanceController extends Controller
{

    private $attendanceRepository, $eventRepositories, $paymentRepository;
    public function __construct(AttendanceRepository $attendanceRepository, EventRepositories $eventRepositories, PaymentRepository $paymentRepository)
    {
        $this->middleware('auth');
        $this->attendanceRepository = $attendanceRepository;
        $this->eventRepositories = $eventRepositories;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter_data = [];
        if ($request->_token) {
            $filter_data = $request->except('_token');
            if (!empty($filter_data['event_id']) && empty($filter_data['user_type'])) {
                $data = $this->attendanceRepository->getAttendanceForAnEvent($filter_data);
                $registeredDelegates = $this->attendanceRepository->getRegisteredDelegatesForAnEvent($filter_data);
                $registeredExhibitors = $this->attendanceRepository->getExhibitorsForAnEvent($filter_data);
                $confirmed = $this->attendanceRepository->getAllConfirmedAttendancesForAnEvent($filter_data);
                $confirmedDelegates = $this->attendanceRepository->getConfirmedDelegatesForAnEvent($filter_data);
                $confirmedExhibitors = $this->attendanceRepository->getConfirmedExhibitorsForAnEvent($filter_data);
            } else if (empty($filter_data['event_id']) && !empty($filter_data['user_type'])) {
                $data = $this->attendanceRepository->getRegisteredAttendanceForAUserType($filter_data);
                $registeredDelegates = $this->attendanceRepository->getAllRegisteredDelegates();
                $registeredExhibitors = $this->attendanceRepository->getAllRegisteredExhibitors();
                $confirmed = $this->attendanceRepository->getConfirmedAttendanceForAUserType($filter_data);
                $confirmedDelegates = $this->attendanceRepository->getAllConfirmedDelegates($filter_data);
                $confirmedExhibitors = $this->attendanceRepository->getAllConfirmedExhibitors($filter_data);
            } else if (!empty($filter_data['event_id']) && !empty($filter_data['user_type'])) {
                $data = $this->attendanceRepository->getRegisteredAttendanceForAnEventandUserType($filter_data);
                $registeredDelegates = $this->attendanceRepository->getRegisteredDelegatesForAnEvent($filter_data);
                $registeredExhibitors = $this->attendanceRepository->getExhibitorsForAnEvent($filter_data);
                $confirmed = $this->attendanceRepository->getConfimedAttendanceForAnEventandUserType($filter_data);
                $confirmedDelegates = $this->attendanceRepository->getConfirmedExhibitorsForAnEvent($filter_data);
                $confirmedExhibitors = $this->attendanceRepository->getConfirmedExhibitorsForAnEvent($filter_data);
            } else {
                $data = $this->attendanceRepository->getAllRegisteredAttendances();
                $registeredDelegates = $this->attendanceRepository->getAllRegisteredDelegates();
                $registeredExhibitors = $this->attendanceRepository->getAllRegisteredExhibitors();
                $confirmed = $this->attendanceRepository->getAllConfirmedAttendances();
                $confirmedDelegates = $this->attendanceRepository->getAllConfirmedDelegates();
                $confirmedExhibitors = $this->attendanceRepository->getAllConfirmedExhibitors();
            }
        } else {
            $data = $this->attendanceRepository->getAllRegisteredAttendances();
            $registeredDelegates = $this->attendanceRepository->getAllRegisteredDelegates();
            $registeredExhibitors = $this->attendanceRepository->getAllRegisteredExhibitors();
            $confirmed = $this->attendanceRepository->getAllConfirmedAttendances();
            $confirmedDelegates = $this->attendanceRepository->getAllConfirmedDelegates();
            $confirmedExhibitors = $this->attendanceRepository->getAllConfirmedExhibitors();
        }
        $events = $this->eventRepositories->getAllEvents();
        return view('backend.attendances.index', [
            'data' => $data,
            'confirmed' => $confirmed,
            'filter_data' => $filter_data,
            'events' => $events,
            'registeredDelegates' => $registeredDelegates,
            'registeredExhibitors' => $registeredExhibitors,
            'confirmedDelegates' => $confirmedDelegates,
            'confirmedExhibitors' => $confirmedExhibitors,
        ]);
    }

    /**
     * Export Confirmed Attendances list.
     */
    public function export()
    {
        return (new ConfirmedAttendanceExport())
            ->download('confirmed-attendances-' . time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Export Confirmed Attendances list.
     */
    public function exportDelegates()
    {   
        return (new ConfirmedDelegatesAttendanceExport())
            ->download('confirmed-delegates-' . time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Export Confirmed Attendances list.
     */
    public function exportExhibitors()
    {
        return (new ConfirmedExhibitorsAttendanceExport())
            ->download('confirmed-exhibitors-' . time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function confirmAttendance($attendance_id)
    {
        //
        $attendance = $this->attendanceRepository->generateAndStoreQrCode($attendance_id);
        if ($attendance) {

            // mail to the attendance email
            $qrCodePath = $attendance->qr_code;

            $att_email = $attendance->email;
            // $att_email = "bizstevekama@gmail.com";
            $ndegwa_email = "ndegwaedwin@gmail.com";
            // $ndegwa_email = "stevekamahertz@gmail.com";

            if (file_exists($qrCodePath)) {
                Mail::to($att_email)->send(new AttendanceConfirmationMail($attendance, $qrCodePath));
                Mail::to($ndegwa_email)->send(new AttendanceCCNdegwaMail($attendance, $qrCodePath));
            }

            return response()->json([
                'status' => true,
                'message' => 'You have successfully confirmed attendance registration for ' . $attendance->first_name . ' ' . $attendance->last_name
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function confirmExhibitors(ConfirmExhibitionRequest $request, Attendance $attendance)
    {
        // check and update payments 
        $data = $request->except("_token");
        $payments = $this->paymentRepository->confirmAndUpdatePayments($data, $attendance);

        if ($payments) {

            if ($payments->payment_status == EventPaymentStatus::PAID) {
                // print qr code
                $attendance = $this->attendanceRepository->generateAndStoreQrCode($attendance->id);

                // mail to the attendance email
                $qrCodePath = $attendance->qr_code;

                $att_email = $attendance->email;
                $ndegwa_email = "ndegwaedwin@gmail.com";

                if (file_exists($qrCodePath)) {
                    Mail::to($att_email)->send(new AttendanceConfirmationMail($attendance, $qrCodePath));
                    Mail::to($ndegwa_email)->send(new AttendanceCCNdegwaMail($attendance, $qrCodePath));
                }

                return response()->json([
                    'status' => true,
                    'message' => 'You have successfully confirmed attendance registration for ' . $attendance->first_name . ' ' . $attendance->last_name
                ]);
            }

            /// payment was not completely cleared 
            /// exhibitor cannot attebd the event 
        }

        return response()->json([
            'status' => false,
            'message' => 'Transaction code enter was not found!'
        ]);


        // confirm attendance 
        // print and send qr code
    }


    /**
     * Show the form for creating a new resource.
     */
    public function cancelAttendance(CancelAttendanceRequest $request, Attendance $attendance)
    {
        $data = $request->except("_token");
        $cancelAttendance = $this->attendanceRepository->cancelAttendance($data, $attendance);
        if ($cancelAttendance) {

            $data = [
                'reasons' => $cancelAttendance->reasons
            ];

            $attendanceEmail = $attendance->email;
            // $attendanceEmail = 'stevekamahertz@gmail.com';

            Mail::to($attendanceEmail)->send(new AttendanceCancelMail($attendance, $data));

            return response()->json([
                'status' => true,
                'message' => 'You have successfully cancelled attendance for ' . $attendance->first_name . ' ' . $attendance->last_name
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
