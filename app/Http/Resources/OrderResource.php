<?php

namespace App\Http\Resources;

use App\Models\Ordered;
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
            'customer' => $this->customer_id,
            'restaurant' => $this->restaurant,
            'employee_id' => $this->employee_id,
            'ordered' => OrderedResource::collection($this->ordereds),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
