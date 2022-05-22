<?php

namespace App\Services;

use App\Models\Trip;

class CommandTripService
{
    /**
     * @param int $userId
     * @param array $data
     * @return void
     */
    public function store(int $userId, array $data)
    {
        $userCar = (new QueryCarService())->getUserCar($userId, $data['car_id']);
        if (empty($userCar)) {
            return;
        }

        $trip = new Trip;
        $trip->fill($data);
        $trip->date = date('Y-m-d' , strtotime($data['date']));
        $trip->save();
    }
}
