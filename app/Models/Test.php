<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    protected $table='test';
    public $timestamps=false;

    protected $fillable = [
        'name',
    ];
}
