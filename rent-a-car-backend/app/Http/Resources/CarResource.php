<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Car;
use App\Http\Resources\CarTypeResource;

class CarResource extends JsonResource
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
            'name' => $this->resource->name,
            'description'=> $this->resource->description,
            'image'=> $this->resource->image,
            'price'=> $this->resource->price,
            'rentTimeInDays'=> $this->resource->rentTimeInDays,
            'VIN'=> $this->resource->VIN,
            'fuelType'=> $this->resource->fuelType,
            'gearType'=> $this->resource->gearType,
            'properties'=> $this->resource->properties,
            'registration'=> $this->resource->registration,
            'carType'=>new CarTypeResource($this->resource->carType),
        ];
    }
}
