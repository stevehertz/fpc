<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\StoreDelegatesRequest;
use App\Mail\EventConfirmationMail;
use App\Repositories\AttendanceRepository;
use App\Repositories\EventRepositories;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ExhibitionController extends Controller
{
    //
    private $eventRepositories, $attendanceRepository, $paymentRepository;
    public function __construct(EventRepositories $eventRepositories, AttendanceRepository $attendanceRepository, PaymentRepository $paymentRepository)
    {
        $this->eventRepositories = $eventRepositories;
        $this->attendanceRepository = $attendanceRepository;
        $this->paymentRepository = $paymentRepository;
    }

    public function sign_up($slug)
    {
        $data = $this->eventRepositories->showEventBySlug($slug);
        return view('frontend.exhibition.sign-up', [
            'data' => $data
        ]);
    }

    public function register(StoreAttendanceRequest $request)
    {
        $data = $request->except("_token");
        // first register attendance
        $attendance = $this->attendanceRepository->storeAttendance($data);
        // store payment
        if ($attendance) {
            $payment = $this->paymentRepository->storePayment($data, $attendance);
            if ($payment) {
                $data = [
                    'title' => $attendance->name . ' REGISTRATION',
                    'message' => 'You have successfully registered for this exhibition. Please wait for confirmation.',
                    'recipient_email' => $attendance->email,
                ];

                // Mail::to($attendance->name)->send(new EventConfirmationMail($data));

                // if (Mail::failures()) {
                //     // Handle the failure
                //     return response()->json([
                //         'status' => false,
                //         'message' => 'Failed to send email'
                //     ]);;
                // }

                return response()->json([
                    'status' => true,
                    'message' => 'You have successfully registered for ' . $attendance->event->name
                ]);
            }
        }
    }

    public function delegates_sign_up($slug)
    {
        $data = $this->eventRepositories->showEventBySlug($slug);
        return view('frontend.exhibition.delegates-sign-up', [
            'data' => $data
        ]);
    }

    public function register_delegates(StoreDelegatesRequest $request)
    {
        $data = $request->except("_token");
        // first register attendance
        $attendance = $this->attendanceRepository->storeAttendance($data);

        if ($attendance) {
            return response()->json([
                'status' => true,
                'message' => 'You have successfully registered for this exhibition. Please wait for confirmation.'
            ]);
        }
    }

    public function exhibitors_sign_up($slug)
    {
        $data = $this->eventRepositories->showEventBySlug($slug);
        return view('frontend.exhibition.delegates-sign-up', [
            'data' => $data
        ]);
    }
}
