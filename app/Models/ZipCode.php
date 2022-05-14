<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $hidden = ['id','municipality_id','federal_entity_id'];

    public function federalEntity()
    {
        return $this->belongsTo(FederalEntity::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

}
