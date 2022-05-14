<?php

namespace App\Http\Controllers;

use App\Imports\ZipImport;
use App\Models\FederalEntity;
use App\Models\Municipality;
use App\Models\Settlement;
use App\Models\SettlementType;
use App\Models\ZipCode;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ZipCodeController extends Controller
{
    public function upload()
    {
        FederalEntity::truncate();
        Municipality::truncate();
        Settlement::truncate();
        SettlementType::truncate();
        ZipCode::truncate();

        Excel::import(new ZipImport, storage_path("app/public/data.xls"));
        return 'Base de datos poblada con exito';
    }

    public function show(Request $request, $zipcode)
    {
        $foo = ZipCode::with('federalEntity','settlements','municipality')->where('zip_code', $zipcode)->first();
        return $foo;
    }
}
