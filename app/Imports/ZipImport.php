<?php

namespace App\Imports;

use App\Models\ZipCode;
use Maatwebsite\Excel\Concerns\ToModel;

class ZipImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ZipCode([
            //
        ]);
    }
}