<?php

namespace App\Http\Services;

use App\Models\GeoInfo;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\GeoInfoFormRequest;
use App\Http\Actions\GeoInfo\StoreGeoInfoAction;

class GeoInfoService
{
    public $url = 'https://ipinfo.io/';

    public function __construct(
        public StoreGeoInfoAction $action
    ){}

    public function make(GeoInfoFormRequest $request)
    {
        $geo_ip = GeoInfo::where('ip', $request->ip)->where('user_id', $request->user()->id)->first();

        if(is_null($geo_ip)) {
            $response = $this->sendRequest($request->ip);
            if($response['success']){
                return ($this->action)($response['data']);
            }
        }

        return $geo_ip;
    }

    public function sendRequest($ip)
    {
        $response = Http::get($this->url . $ip . '/geo');

        if($response->successful()) {
            $contents = json_decode($response->body(), true);
            return [
                'success' => true,
                'data'    => $contents
            ];
        }

        return [
            'success' => false,
            'data'    => null
        ];
    }
}
