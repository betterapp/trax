<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'date',
        'car_id',
        'miles',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
