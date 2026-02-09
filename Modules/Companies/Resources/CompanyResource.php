<?php

namespace Modules\Companies\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'created_by_id' => $this->created_by_id,
            'name' => $this->name,
            'description' => $this->description,
            'cif' => $this->cif,
            'db_conexion' => $this->db_conexion,
            'db_user' => $this->db_user,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
