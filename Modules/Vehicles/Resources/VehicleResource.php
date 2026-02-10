<?php

namespace Modules\Vehicles\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'license' => $this->license,
            'status' => $this->status,
            'vehicle_type_id' => $this->vehicle_type_id,
            'vehicle_type' => VehicleTypeResource::make($this->whenLoaded('vehicleType')),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
