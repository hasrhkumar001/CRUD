<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Support\Facades\Route;

class AddCarModel extends Component
{
    public $carId;
    public $model_name;
    public $transmission_type;
    public $engine_capacity;
    public $fuel_type;
    public $car_name;
    public $car_desc;
    public $car_mileage;
    public $car_price;
    public $cars = [];
    public $dropdownEnabled = false;

    
    
    protected $rules = [
        'carId' => 'required|exists:cars,id',
        'model_name' => 'required|string',
        'engine_capacity' => 'required|string',
        'car_desc' => 'required|string',
        'car_mileage' => 'required|string',
        'car_price' => 'required|string',
        'fuel_type.*' => 'in:Petrol,Diesel,Electric,Hybrid,CNG',
        'transmission_type.*' => 'in:Automatic,Manual',
            
    ];

    public function mount($id = null)
    {
        // Fetch the list of cars
        $this->cars = Car::all();

        // Enable the dropdown based on the route
        if (Route::is('add.carmodel')) {
            // For the /add/carmodel/{id} route
            $this->dropdownEnabled = false;
            // You can add logic to load the car model based on $id if needed
            $this->carId = $id;
        } else {
            // For the /add/car-models route
            $this->dropdownEnabled = true;
        }
    }
    public function submit()
    {
        $this->validate();

        $model = CarModel::create([
            'car_id' => $this->carId,
            'model_name' => $this->model_name,
            'transmission_type' => $this->transmission_type,
            'engine_capacity' => $this->engine_capacity,
            'fuel_type' => $this->fuel_type,
            'car_desc' => $this->car_desc,
            'car_mileage' => $this->car_mileage,
            'car_price' => $this->car_price,
        ]);
    
        session()->flash('message', 'Car Model added successfully.');
    
        $this->reset(); // Reset all fields after submission
    
        return redirect()->route('car-models', ['carId' => $model->car_id]);
    }

    
    
    public function render()
    {
        return view('livewire.add-car-model');
    }
}