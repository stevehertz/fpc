<?php

namespace App\Exports\Attendances;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Repositories\AttendanceRepository;
use Maatwebsite\Excel\Concerns\Exportable;

class ConfirmedDelegatesAttendanceExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $attendanceRepository = new AttendanceRepository();
        $data = $attendanceRepository->getAllConfirmedDelegates();
        return view('backend.attendances.export-delegates', [
            'data' => $data,
        ]);
    }
}
