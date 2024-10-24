<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    //category
    public function category()
    {
        return $this->belongsTo(StandCategory::class);
    }

    //is paid
    public function getIsPaidAttribute()
    {
        return $this->paid_by != null;
    }

    //is booked
    public function getIsBookedAttribute()
    {
        return $this->booked_for != null;
    }

}
