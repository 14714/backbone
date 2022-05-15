<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalEntity extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    protected $hidden = ['id'];
    protected $casts = [
        'key' => 'integer',
        'name' => 'string',
    ];

}
