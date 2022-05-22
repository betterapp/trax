<?php

namespace App\Services;

use App\Helpers\DataConvertHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QueryTripService
{
    /**
     * @param int $userId
     * @return array
     */
    public function getUserTripsWithCar(int $userId): array
    {
        $tripsWithCarData = DB::table('trips')
            ->leftjoin('cars','trips.car_id','=','cars.id')
            ->selectRaw('
            trips.id,
            trips.date,
            trips.miles,
            (
                SELECT SUM(trips.miles)
                FROM trips
                WHERE trips.car_id = cars.id
            ) total,
            cars.id as car_id,
            cars.make as car_make,
            cars.model as car_model,
            cars.year as car_year')
            ->where('cars.user_id', '=', $userId)
            ->orderBy('trips.date', 'desc')
            ->get();

        $tripsWithCarData = DataConvertHelper::jsonableToArray($tripsWithCarData);

        $tripsWithCar = [];
        foreach ($tripsWithCarData as $tripWithCarData) {
            $car['id'] = $tripWithCarData['car_id'];
            $car['make'] = $tripWithCarData['car_make'];
            $car['model'] = $tripWithCarData['car_model'];
            $car['year'] = $tripWithCarData['car_year'];

            $tripWithCar['car'] = $car;
            $tripWithCar['date'] = (new Carbon($tripWithCarData['date']))->format('m/d/Y');
            $tripWithCar['id'] = $tripWithCarData['id'];
            $tripWithCar['miles'] = $tripWithCarData['miles'];
            $tripWithCar['total'] = $tripWithCarData['total'];

            $tripsWithCar[] = $tripWithCar;
        }

        return $tripsWithCar;
    }
}
