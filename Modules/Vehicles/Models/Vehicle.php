<?php

namespace Modules\Vehicles\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Vehicles\Models\VehicleType;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'company_1';
    protected $table = 'vehicles';
    protected $fillable = ['license', 'status', 'vehicle_type_id'];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }
}
