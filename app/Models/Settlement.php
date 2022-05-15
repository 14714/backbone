<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public $with = ['settlementType'];
    protected $hidden = ['id','settlement_type_id','zip_code_id'];
    protected $casts = [
        'key' => 'integer',
    ];

    public function zipCode()
    {
        return $this->belongsTo(ZipCode::class);
    }

    public function settlementType()
    {
        return $this->belongsTo(SettlementType::class);
    }

}
