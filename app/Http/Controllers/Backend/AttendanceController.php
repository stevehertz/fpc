<?php

namespace App\Http\Controllers\Backend;

use setasign\Fpdi\Fpdi;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepositories;
use App\Repositories\AttendanceRepository;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;

class AttendanceController extends Controller
{

    private $attendanceRepository, $eventRepositories;
    public function __construct(AttendanceRepository $attendanceRepository, EventRepositories $eventRepositories)
    {
        $this->middleware('auth');
        $this->attendanceRepository = $attendanceRepository;
        $this->eventRepositories = $eventRepositories;
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
            } else if (empty($filter_data['event_id']) && !empty($filter_data['user_type'])) {
                $data = $this->attendanceRepository->getAttendanceForAUserType($filter_data);
            } else if (!empty($filter_data['event_id']) && !empty($filter_data['user_type'])) {
                $data = $this->attendanceRepository->getAttendanceForAnEventandUserType($filter_data);
            } else {
                $data = $this->attendanceRepository->getAllAttendances();
            }
        } else {
            $data = $this->attendanceRepository->getAllAttendances();
        }

        $events = $this->eventRepositories->getAllEvents();
        return view('backend.attendances.index', [
            'data' => $data,
            'filter_data' => $filter_data,
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function confirmAttendance($attendance_id)
    {
        //
        $attendance = $this->attendanceRepository->generateAndStoreQrCode($attendance_id);
        if ($attendance) {
            return response()->json([
                'status' => true,
                'message' => 'You have successfully confirmed attendance registration for ' . $attendance->first_name . ' ' . $attendance->last_name
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
