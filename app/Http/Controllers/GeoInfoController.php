<?php

namespace App\Http\Controllers;

use App\Models\GeoInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\GeoInfoFormRequest;
use App\Http\Resources\GeoInfoResource;
use App\Http\Services\GeoInfoService;

class GeoInfoController extends Controller
{
    public function index()
    {

    }

    public function show(GeoInfo $geoInfo)
    {
        return response()->json(new GeoInfoResource($geoInfo));
    }

    public function store(
        GeoInfoFormRequest $request,
        GeoInfoService $service
    ){
        return DB::transaction(function () use ($request, $service) {
            $result = $service->make($request);
            return response()->json(new GeoInfoResource($result));
        });
    }

    public function update()
    {

    }

    public function destroy(GeoInfo $geoInfo)
    {
        $geoInfo->delete();

        return response()->json([
            'message' => 'geolocation information deleted'
        ]);
    }
}
