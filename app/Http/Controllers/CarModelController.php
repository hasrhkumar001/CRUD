<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        $carModels = CarModel::with('car')->get();
        return response()->json($carModels);
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
