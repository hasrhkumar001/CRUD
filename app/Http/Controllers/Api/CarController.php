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
        $query->where(function ($query) use ($request) {
            foreach (explode(',', $request->fuel_type) as $fuelType) {
                $query->orWhere('fuel_type', 'LIKE', '%' . $fuelType . '%');
            }
        });
    }

    if ($request->filled('transmission_type')) {
        $query->where(function ($query) use ($request) {
            foreach (explode(',', $request->transmission_type) as $transmissionType) {
                $query->orWhere('transmission_type', 'LIKE', '%' . $transmissionType . '%');
            }
        });
    }

    if ($request->filled('engine_capacity')) {
        $engineCapacityRange = explode('-', $request->engine_capacity);
    
        if (count($engineCapacityRange) === 2) {
            // Handling a range format
            $minEngineCapacity = $engineCapacityRange[0];
            $maxEngineCapacity = $engineCapacityRange[1];
            $query->where(function ($query) use ($minEngineCapacity, $maxEngineCapacity) {
                $query->where(function ($subQuery) use ($minEngineCapacity, $maxEngineCapacity) {
                    $subQuery->whereRaw("CAST(engine_capacity AS UNSIGNED) >= ?", [$minEngineCapacity])
                             ->whereRaw("CAST(engine_capacity AS UNSIGNED) <= ?", [$maxEngineCapacity]);
                })
                ->orWhere(function ($subQuery) use ($minEngineCapacity, $maxEngineCapacity) {
                    $subQuery->whereRaw("CAST(SUBSTRING_INDEX(engine_capacity, '-', 1) AS UNSIGNED) >= ?", [$minEngineCapacity])
                             ->whereRaw("CAST(SUBSTRING_INDEX(engine_capacity, '-', -1) AS UNSIGNED) <= ?", [$maxEngineCapacity]);
                });
            });
        } else {
            // Handling a single value format
            $query->whereRaw("CAST(engine_capacity AS UNSIGNED) = ?", [$engineCapacityRange[0]]);
        }
    }
    
    if ($request->filled('car_mileage')) {
        $mileageRange = explode('-', $request->car_mileage);
    
        if (count($mileageRange) === 2) {
            // Handling a range format
            $minMileage = $mileageRange[0];
            $maxMileage = $mileageRange[1];
            $query->where(function ($query) use ($minMileage, $maxMileage) {
                $query->where(function ($subQuery) use ($minMileage, $maxMileage) {
                    $subQuery->whereRaw("CAST(car_mileage AS UNSIGNED) >= ?", [$minMileage])
                             ->whereRaw("CAST(car_mileage AS UNSIGNED) <= ?", [$maxMileage]);
                })
                ->orWhere(function ($subQuery) use ($minMileage, $maxMileage) {
                    $subQuery->whereRaw("CAST(SUBSTRING_INDEX(car_mileage, '-', 1) AS UNSIGNED) >= ?", [$minMileage])
                             ->whereRaw("CAST(SUBSTRING_INDEX(car_mileage, '-', -1) AS UNSIGNED) <= ?", [$maxMileage]);
                });
            });
        } else {
            // Handling a single value format
            $query->whereRaw("CAST(car_mileage AS UNSIGNED) = ?", [$mileageRange[0]]);
        }
    }
    
    if ($request->filled('car_price_range')) {
        $priceRange = explode('-', $request->car_price_range);
    
        if (count($priceRange) === 2) {
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
    
            $query->where(function ($query) use ($minPrice, $maxPrice) {
                // Check for any overlap between the stored price range and the selected price range
                $query->where(function ($query) use ($minPrice, $maxPrice) {
                    $query->whereRaw("CAST(SUBSTRING_INDEX(car_price_range, '-', 1) AS UNSIGNED) BETWEEN ? AND ?", [$minPrice, $maxPrice])
                          ->orWhereRaw("CAST(SUBSTRING_INDEX(car_price_range, '-', -1) AS UNSIGNED) BETWEEN ? AND ?", [$minPrice, $maxPrice])
                          ->orWhereRaw("? BETWEEN CAST(SUBSTRING_INDEX(car_price_range, '-', 1) AS UNSIGNED) AND CAST(SUBSTRING_INDEX(car_price_range, '-', -1) AS UNSIGNED)", [$minPrice])
                          ->orWhereRaw("? BETWEEN CAST(SUBSTRING_INDEX(car_price_range, '-', 1) AS UNSIGNED) AND CAST(SUBSTRING_INDEX(car_price_range, '-', -1) AS UNSIGNED)", [$maxPrice]);
                });
            });
        }
    }
    
    

    if ($request->filled('brand')) {
        $query->where('brand', $request->brand);
    }

    $carss = $query->orderBy('created_at', 'desc')->get();

    if (!empty($carss)) {
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