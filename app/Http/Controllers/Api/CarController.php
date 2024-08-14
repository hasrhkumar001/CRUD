<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cars;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index(Request $request)
    {

        $query = Car::query();

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        if ($request->filled('engine_capacity')) {
            $engineCapacityRange = explode(',', $request->engine_capacity);
            $minEngineCapacity = $engineCapacityRange[0];
            $maxEngineCapacity = $engineCapacityRange[1];
            $query->whereBetween('engine_capacity', [$minEngineCapacity, $maxEngineCapacity]);
        }

        if ($request->filled('car_mileage')) {
            $mileageRange = explode(',', $request->car_mileage);
            $minMileage = $mileageRange[0];
            $maxMileage = $mileageRange[1];
            $query->whereBetween('car_mileage', [$minMileage, $maxMileage]);
        }

        if ($request->filled('price_range')) {
            $priceRange = explode(',', $request->price_range);
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];
            $query->whereBetween('car_price', [$minPrice, $maxPrice]);
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }


        // $cars = Car::get();
        $carss = $query->orderBy('created_at', 'desc')->get();
    //    foreach ($carss as &$car) {
    //         $file = file_get_contents('http://127.0.0.1:8000/public/photos/'.$car->car_img);
    //         $car['car_img'] = base64_encode($file);
    //         // echo $car->car_img;
            
    //     }
        
        if (!empty($carss)) {
            // return Cars::collection($carss);
            return response()->json([
                'message' => "Cars",
                'data' =>  $carss
            ], 200);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_name' => 'required',
            'brand' => 'required',
            'engine_capacity' => 'required',
            'fuel_type' => 'required',
            'car_img' => 'required|image|max:10240',
            'car_desc' => 'required|max:1024',
            'car_mileage' => 'required',
            'car_price' => 'required',
            'model_year' => 'required',
            'transmission_type' => 'required'
        ]);



        if ($validator->fails()) {
            return response()->json([
                'message' => "All fields are mandatory",
                'error' => $validator->messages(),
            ], 422);
        }
        if ($request->hasFile('car_img')) {
            $file = $request->file('car_img');

            $filename = $file->getClientOriginalName();
            // Store the file in the custom disk/location
            $path = $file->storeAs('photos', $filename, 'public');

            // Get the file path
            $filePath = 'photos/' . $filename;
            $request->car_img = $filePath;
        }

        // Assuming $imagePath is the URL or storage path of the image
        

        $car = Car::create([
            'car_name' => strtoupper($request->car_name),
            'brand' => strtoupper($request->brand),
            'engine_capacity' => $request->engine_capacity,
            'fuel_type' => strtoupper($request->fuel_type),
            'car_img' => $request->car_img,
            'car_desc' => $request->car_desc,
            'car_mileage' => $request->car_mileage,
            'car_price' => $request->car_price,
            'model_year' => $request->model_year,
            'transmission_type' => strtoupper($request->transmission_type)
        ]);
        return response()->json([
            'message' => "Car added successfully",
            'data' => new Cars($car),
            
        ], 200);
    }
    public function show(Car $car)
    {
        return new Cars($car);
    }
    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), [
            'car_name' => 'required',
            'brand' => 'required',
            'engine_capacity' => 'required',
            'fuel_type' => 'required',
            'car_desc' => 'required|max:10240',
            'car_mileage' => 'required',
            'car_price' => 'required',
            'model_year' => 'required',
            'transmission_type' => 'required'
            // 'car_img' => 'required|image|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "All fields are required",
                'error' => $validator->messages(),
            ], 422);
        }

        $car->update([
            'car_name' => strtoupper($request->car_name),
            'brand' => strtoupper($request->brand),
            'engine_capacity' => $request->engine_capacity,
            'fuel_type' => strtoupper($request->fuel_type),
            'car_img' => $request->car_img,
            'car_desc' => $request->car_desc,
            'car_mileage' => $request->car_mileage,
            'car_price' => $request->car_price,
            'model_year' => $request->model_year,
            'transmission_type' => strtoupper($request->transmission_type)
        ]);
        return response()->json([
            'message' => "Car updated successfully",
            'data' => new Cars($car),

        ], 200);
    }
    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json([
            'message' => "Car deleted successfully",
        ], 200);
    }

    

    public function filter(Request $request)
    {

    }
}