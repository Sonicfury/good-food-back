<?php

namespace App\Http\Resources;

use App\Models\Ordered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'state' => $this->state,
            'isTakeaway' => $this->isTakeaway,
            'total' => $this->total,
            'ordered' => $this->ordereds,
            'customer' => UserResource::make(User::find($this->customer_id)),
            'restaurant' => $this->restaurant,
            'employee' => $this->employee_id,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
