<?php

namespace App\Http\Controllers;

use App\Models\CarImage;
use Illuminate\Http\Request;

class CarImageController extends Controller
{
    public function getCarImages($carId)
    {
        $carImages = CarImage::where('car_id', $carId)->get();
        return response()->json($carImages);
    }
}
