<?php

namespace App\Exports\Attendances;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Repositories\AttendanceRepository;
use Maatwebsite\Excel\Concerns\Exportable;

class ConfirmedExhibitorsAttendanceExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $attendanceRepository = new AttendanceRepository();
        $data = $attendanceRepository->getAllConfirmedExhibitors();
        return view('backend.attendances.export-exhibitors', [
            'data' => $data
        ]);   
    }

}
