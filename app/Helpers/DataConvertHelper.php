<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent;
use Illuminate\Support;
use stdClass;

class DataConvertHelper
{
    /**
     * @param stdClass $data
     * @return array
     */
    public static function stdClassToArray(stdClass $data): array
    {
        return json_decode(json_encode($data), true);
    }

    /**
     * @param Eloquent\Model | Eloquent\Collection | Support\Collection $data
     *
     * @return array
     */
    public static function jsonableToArray($data): array
    {
        return json_decode($data->toJson(), true);
    }
}
