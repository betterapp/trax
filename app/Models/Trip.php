<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $car_id
 * @property $date
 * @property $miles
 */
class Trip extends Model
{
    protected $fillable = ['date', 'car_id', 'miles'];
    protected $hidden = ['created_at', 'updated_at'];
}
