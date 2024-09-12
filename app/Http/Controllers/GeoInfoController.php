<?php

namespace App\Http\Controllers;

use App\Models\GeoInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GeoInfoService;
use App\Http\Resources\GeoInfoResource;
use App\Http\Requests\GeoInfoFormRequest;

class GeoInfoController extends Controller
{
    public function index() {}

    public function show(GeoInfo $geoInfo)
    {
        return response()->json(new GeoInfoResource($geoInfo));
    }

    public function store(
        GeoInfoFormRequest $request,
        GeoInfoService $service
    ) {
        return DB::transaction(function () use ($request, $service) {
            $result = $service->make($request);
            return response()->json(new GeoInfoResource($result));
        });
    }

    public function update() {}

    public function destroy(GeoInfo $geoInfo)
    {
        if ($geoInfo->user_id == Auth::user()->id) {
            $geoInfo->delete();

            return response()->json([
                'message' => 'geolocation information deleted.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'geolocation information not found.'
        ]);
    }
}
