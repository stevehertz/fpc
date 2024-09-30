<?php

namespace App\Exports;

use App\Models\Agra;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class AgraExport implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = Agra::all();
        return view('backend.agra.export', [
            'data' => $data
        ]);   
    }
}
