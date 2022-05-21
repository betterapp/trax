<?php

namespace App\Services;

use App\Models\Trip;

class CommandTripService
{
    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $trip = new Trip;
        $trip->fill($data);
        $trip->date = date('Y-m-d' , strtotime($data['date']));
        $trip->save();
    }

    /**
     * @param int $carId
     * @return void
     */
    public function destroyByCarId(int $carId)
    {
        Trip::where('car_id', $carId)->delete();
    }
}
