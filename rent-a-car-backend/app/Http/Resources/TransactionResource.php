<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'date'=> $this->resource->date,
            'status'=> $this->resource->status,
            'user'=> new UserResource($this->resource->user),
            'rentalAgent'=>  new RentalAgentResource($this->resource->rentalAgent),
            'car'=>  new CarResource($this->resource->car),
        ];
    }
}
