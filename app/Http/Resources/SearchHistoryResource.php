<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchHistoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'user_id' => $this->user_id,
            'keyword' => $this->keyword
        ];
    }
}
