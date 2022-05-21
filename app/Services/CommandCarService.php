<?php

namespace App\Services;

use App\Models\Car;

class CommandCarService
{
    /**
     * @param int $userId
     * @param array $data
     * @return void
     */
    public function store(int $userId, array $data)
    {
        $car = new Car;
        $car->fill($data);
        $car->user_id = $userId;
        $car->save();
    }

    /**
     * @param int $userId
     * @param int $carId
     * @return void
     */
    public function destroy(int $userId, int $carId)
    {
        (new CommandTripService())->destroyByCarId($carId);
        Car::where('user_id', $userId)->where('id', $carId)->delete();
    }
}
