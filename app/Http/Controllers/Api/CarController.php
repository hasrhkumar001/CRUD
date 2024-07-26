<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cars;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index(Request $request){

        $cars = Car::query();

        // Filter by fuel type
        if ($request->has('fuel_type')) {
            $cars->where('fuel_type', $request->input('fuel_type'));
        }

        // Filter by car brand
        if ($request->has('brand')) {
            $cars->where('brand', $request->input('brand'));
        }

        // Return the filtered cars
        // return $cars->get();


        // $cars = Car::get();
        $carss = $cars->get();
        if(!empty($carss)){
           return Cars::collection($carss);
        }
        else{
            return response()->json(['message' => 'No record available'], 200);
        }
        
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'car_name'=>'required',
            'brand'=>'required',
            'engine_capacity'=>'required',
            'fuel_type'=>'required',
            'car_img' => 'required|image|max:1024',
            'car_desc' => 'required|max:1024',
            'car_mileage' => 'required',
            'car_price' => 'required',
            'model_year'=> 'required',
            'transmission_type'=>'required'
        ]);
       
        if($validator->fails()){
            return response()->json([
                'message'=> "All fields are mandatory",
                'error'=>$validator->messages(),    
            ],422);
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

        $car= Car::create([
            'car_name'=>$request->car_name,
            'brand'=>$request->brand,
            'engine_capacity'=>$request->engine_capacity,
            'fuel_type'=>$request->fuel_type,
            'car_img' => $request->car_img,
            'car_desc' => $request->car_desc,
            'car_mileage' => $request->car_mileage,
            'car_price' => $request->car_price,
            'model_year' => $request->model_year,
            'transmission_type' => $request->transmission_type
        ]);
        return response()->json([
            'message' => "Car added successfully",
            'data' => new Cars($car),
        ],200);
    }
    public function show(Car $car){
        return new Cars($car);
    }
    public function update(Request $request,Car $car){
        $validator = Validator::make($request->all(),[
            'car_name'=>'required',
            'brand'=>'required',
            'engine_capacity'=>'required',
            'fuel_type'=>'required',
            'car_desc' => 'required|max:1024',
            'car_mileage' => 'required',
            'car_price' => 'required',
            'model_year'=> 'required',
            'transmission_type'=>'required'
            // 'car_img' => 'required|image|max:1024'
        ]);
       
        if($validator->fails()){
            return response()->json([
                'message'=> "All fields are required",
                'error'=>$validator->messages(),    
            ],422);
        }

        $car->update([
            'car_name'=>$request->car_name,
            'brand'=>$request->brand,
            'engine_capacity'=>$request->engine_capacity,
            'fuel_type'=>$request->fuel_type,
            'car_img' => $request->car_img,
            'car_desc' => $request->car_desc,
            'car_mileage' => $request->car_mileage,
            'car_price' => $request->car_price,
            'model_year' => $request->model_year,
            'transmission_type' => $request->transmission_type
        ]);
        return response()->json([
            'message' => "Car updated successfully",
            'data' => new Cars($car),
        ],200);
    }
    public function destroy(Car $car){
        $car->delete();
        return response()->json([
            'message' => "Car deleted successfully",
        ],200);
    }

    public function filter(Request $request)
    {
       
    }
}
