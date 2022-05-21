<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $user_id
 * @property $make
 * @property $model
 * @property $year
 */
class Car extends Model
{
    protected $fillable = ['make', 'model', 'year'];
    protected $hidden = ['user_id', 'created_at', 'updated_at'];
}
