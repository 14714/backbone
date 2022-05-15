<?php

namespace App\Imports;

use App\Models\FederalEntity;
use App\Models\Municipality;
use App\Models\Settlement;
use App\Models\SettlementType;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZipImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $municipality = Municipality::firstOrCreate([
            'key' => intval($row['c_mnpio']),
            'name' => $row['d_mnpio'],
        ]);

        $federal = FederalEntity::firstOrCreate([
            'key' => intval($row['c_estado']),
            'name' => strtoupper($row['d_estado']),
            'code' => $row['c_cp']
        ]);

        $zipcode = ZipCode::firstOrCreate([
            'zip_code' => $row['d_codigo'],
            'locality' => strtoupper($row['d_ciudad']),
            'municipality_id' => $municipality->id,
            'federal_entity_id' => $federal->id,
        ]);

        $settlementType = SettlementType::firstOrCreate([
            'name' => $row['d_tipo_asenta'],
        ]);
        $settlement = Settlement::firstOrCreate([
            'key' => intval($row['id_asenta_cpcons']),
            'name' => strtoupper($row['d_asenta']),
            'zone_type' => strtoupper($row['d_zona']),
            'settlement_type_id' => $settlementType->id,
            'zip_code_id' => $zipcode->id
        ]);
    }

    public function chunkSize(): int
    {
        return 100000;
    }
}
