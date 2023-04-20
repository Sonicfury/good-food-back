<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'birthDate' => $this->birthDate,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'disabledAt' => $this->disable_at,
            'restaurant' => RestaurantResource::make($this->restaurant_id),
            'roles' => RoleResource::collection($this->roles),
            'adresses' => AddressResource::collection($this->addresses),
        ];
    }
}
