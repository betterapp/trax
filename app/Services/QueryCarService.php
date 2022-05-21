<?php

namespace App\Services;

use App\Helpers\DataConvertHelper;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class QueryCarService
{
    /**
     * @param int $userId
     * @param int $carId
     * @return array
     */
    public function getUserCarWithTripsStatistic(int $userId, int $carId): array
    {
        $userCarWithTripStatistic = DB::table('cars')
            ->leftjoin('trips','trips.car_id','=','cars.id')
            ->selectRaw('
            cars.id,
            cars.year,
            cars.make,
            cars.model,
            COUNT(trips.id) as trip_count,
            SUM(trips.miles) as trip_miles')
            ->where('cars.id', '=', $carId)
            ->where('cars.user_id', '=', $userId)
            ->groupBy(['cars.id', 'cars.year', 'cars.model', 'cars.make'])
            ->get()->first();

        return DataConvertHelper::stdClassToArray($userCarWithTripStatistic);
    }

    /**
     * @param int $userId
     * @param int $carId
     * @return array
     */
    public function getUserCar(int $userId, int $carId): array
    {
        $userCar = Car::where('user_id', $userId)->where('id', $carId)->first();

        return DataConvertHelper::jsonableToArray($userCar);
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getUserCars(int $userId): array
    {
        $userCars = Car::where('user_id', $userId)->get();

        return DataConvertHelper::jsonableToArray($userCars);
    }
}
