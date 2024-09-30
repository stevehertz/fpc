<?php

namespace App\Imports;

use App\Models\Agra;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgraFileImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        //
        return new Agra([
            'name' => $row['name'],
            'organization' => $row['organization'],
            'email' => $row['email'],
            'phone' => $row['phone']
        ]);
    }
}
