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
    /** @var string[] */
    protected $fillable = ['make', 'model', 'year'];

    /** @var string[] */
    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    public function trips()
    {
        return $this->hasMany('App\Models\Trip');
    }
}
