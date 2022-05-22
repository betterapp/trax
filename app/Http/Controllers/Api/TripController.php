<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Services\CommandTripService;
use App\Services\QueryTripService;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return [
            'data' => (new QueryTripService())->getUserTripsWithCar($request->user()->id),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTripRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripRequest $request)
    {
        (new CommandTripService())->store($request->user()->id, $request->all());
    }
}
