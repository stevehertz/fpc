<?php

namespace App\Exports\Attendances;

use App\Repositories\AttendanceRepository;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ConfirmedAttendanceExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $attendanceRepository = new AttendanceRepository();
        $data = $attendanceRepository->getAllConfirmedAttendances();
        return view('backend.attendances.export', [
            'data' => $data,
        ]);
    }
}
