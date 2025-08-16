<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriversModel extends Model
{
    use HasFactory;

    protected $table = 'drivers_models';
    protected $fillable = [
        'id',
        'name_driver',
        'email',
        'phone_number',
        'address',
        'vehicle_type',
        'vehicle_plate_number',
        'license_number',
        'status'
    ];

    public function tickets()
    {
        return $this->hasMany(TicketsModel::class, 'id_driver', 'id');
    }

}


