<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeoInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'user_id'  => $this->user_id,
            'ip'       => $this->ip,
            'hostname' => $this->hostname,
            'city'     => $this->city,
            'region'   => $this->region,
            'country'  => $this->country,
            'loc'      => $this->loc,
            'org'      => $this->org,
            'postal'   => $this->postal,
            'timezone' => $this->timezone,
        ];
    }
}
