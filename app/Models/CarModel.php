<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the plural form of the model
    protected $table = 'car_models';

    // Define the fields that can be mass-assigned
    protected $fillable = ['car_name','car_id',
    'model_name',
    'brand',
    'engine_capacity',
    'fuel_type',
    'car_desc',
    'car_mileage',
    'car_price',
    'transmission_type',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}