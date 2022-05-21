<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Services\CommandCarService;
use App\Services\QueryCarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return [
            'data' => (new QueryCarService())->getUserCars($request->user()->id),
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        (new CommandCarService())->store($request->user()->id, $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        return [
            'data' =>  (new QueryCarService())->getUserCarWithTripsStatistic($request->user()->id, $id),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        (new CommandCarService())->destroy($request->user()->id, $id);
    }
}
