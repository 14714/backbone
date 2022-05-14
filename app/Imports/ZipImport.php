<?php

namespace App\Imports;

use App\Models\FederalEntity;
use App\Models\Municipality;
use App\Models\Settlement;
use App\Models\SettlementType;
use App\Models\ZipCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZipImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $municipality = Municipality::firstOrCreate([
            'key' => $row['c_mnpio'],
            'name' => $row['d_mnpio'],
        ]);

        $federal = FederalEntity::firstOrCreate([
            'key' => $row['c_estado'],
            'name' => $row['d_estado'],
            'code' => $row['c_cp']
        ]);

        $zipcode = ZipCode::firstOrCreate([
            'zip_code' => $row['d_codigo'],
            'locality' => $row['d_ciudad'],
            'municipality_id' => $municipality->id,
            'federal_entity_id' => $federal->id,
        ]);

        $settlementType = SettlementType::firstOrCreate([
            'name' => $row['d_tipo_asenta'],
        ]);
        $settlement = Settlement::firstOrCreate([
            'key' => $row['id_asenta_cpcons'],
            'name' => $row['d_asenta'],
            'zone_type' => $row['d_zone'],
            'settlement_type_id' => $settlementType->id,
            'zip_code_id' => $zipcode->id
        ]);

        // return new ZipCode([
        //     'zip_code' => $row['d_codigo'],
        //     'locality' => $row['d_ciudad'],
        // ]);
    }
}
