<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index(Request $request)
{
    // Initialize query for CarModel
    $query = CarModel::query();
    
    // Retrieve car_id from request
    $carId = $request->input('car_id'); 

    // Apply filters
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

    // Retrieve filtered CarModels
    $carModels = $query->orderBy('created_at', 'desc')->get();

    // Retrieve specific Car if car_id is provided
    $specificCar = null;
    if ($carId) {
        $specificCar = Car::with('carModels')->find($carId);
    }
        

    // Prepare response data
    $responseData = [
        'cars' => $carModels,
    ];

    if ($specificCar) {
        $responseData['car'] = $specificCar;
    }

    if ($carModels->isNotEmpty() || $specificCar) {
        return response()->json([
            'message' => 'Car Models and Specific Car Retrieved Successfully',
            'data' => $responseData,
        ], 200);
    } else {
        return response()->json(['message' => 'No car models or specific car available'], 200);
    }
}

    
    public function getByCarId($car_id)
{
    // Query the car model based on the car_id
    $carModels = CarModel::where('car_id', $car_id)->with('car')->get();

    // Check if car models are found
    if ($carModels->isEmpty()) {
        return response()->json(['message' => 'No car models found for this car ID'], 404);
    }

    return response()->json($carModels);
}
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'model_name' => 'required|string',
            'car_name' => 'required|string',
            'brand' => 'required|string',
            'transmission_type' => 'required|string',
            'engine_capacity' => 'required|string',
            'fuel_type' => 'required|string',
            'car_desc' => 'required|string',
            'car_mileage' => 'required|string',
            'car_price' => 'required|string',
        ]);

        $carModel = CarModel::create($validatedData);

        return response()->json($carModel, 201);
    }

    public function show($id)
    {
        $carModel = CarModel::with('car')->findOrFail($id);
        return response()->json($carModel);
    }

    public function update(Request $request, $id)
    {
        $carModel = CarModel::findOrFail($id);

        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'model_name' => 'sometimes|string',
            'car_name' => 'sometimes|string',
            'brand' => 'sometimes|string',
            'transmission_type' => 'sometimes|string',
            'engine_capacity' => 'sometimes|string',
            'fuel_type' => 'sometimes|string',
            'car_desc' => 'sometimes|string|max:10240',
            'car_mileage' => 'sometimes|string',
            'car_price' => 'sometimes|string',
        ]);

        $carModel->fill($validatedData);
        $carModel->save();

        return response()->json($carModel, 200);
    }

    public function destroy($id)
    {
        $carModel = CarModel::findOrFail($id);
        $carModel->delete();

        return response()->json(['message' => 'Car model deleted successfully', 'carModel' => $carModel], 200);
    }
}
