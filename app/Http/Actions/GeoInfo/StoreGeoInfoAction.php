<?php

namespace App\Http\Actions\GeoInfo;

use App\Models\GeoInfo;

class StoreGeoInfoAction
{
    public function __invoke($response)
    {
        return GeoInfo::create(array_merge(
            [
                'user_id' => request()->user()->id
            ],
            $response
        ));
    }
}
