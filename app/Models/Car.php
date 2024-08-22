<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table ="cars";

    protected $fillable=[
        'car_name',
        'brand',
        'engine_capacity',
        'fuel_type',
        'car_img',
        'car_desc',
        'car_mileage',
        'car_price',
        'transmission_type',
        
    ];
    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}
