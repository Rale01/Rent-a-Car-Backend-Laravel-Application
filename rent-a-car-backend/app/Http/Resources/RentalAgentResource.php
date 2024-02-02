<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalAgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name'=> $this->resource->name,
            'city'=> $this->resource->city,
            'address'=> $this->resource->address,
            'email'=> $this->resource->email,
            'telephone'=> $this->resource->telephone,
        ];
    }
}
