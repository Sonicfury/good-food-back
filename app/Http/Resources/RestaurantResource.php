<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'zipCode' => $this->zipCode,
            'city' => $this->city,
            'lat' => $this->lat,
            'long' => $this->long,
            'distanceKm' => $this->distanceKm,
            'primaryPhone' => $this->primaryPhone,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'disableAt' => $this->disable_at,
        ];
    }
}
