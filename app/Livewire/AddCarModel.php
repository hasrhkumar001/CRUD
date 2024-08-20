<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\CarModel;

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

    
    
    protected $rules = [
        'carId' => 'required|exists:cars,id',
        'model_name' => 'required|string',
        'transmission_type' => 'required|string',
        'engine_capacity' => 'required|string',
        'fuel_type' => 'required|string',
        'car_desc' => 'required|string',
        'car_mileage' => 'required|string',
        'car_price' => 'required|string',
    ];

    public function mount($id){
        $this->carId = $id;
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
        $cars = Car::all(); // Fetch all cars to populate the dropdown

        return view('livewire.add-car-model',[
            'cars' => Car::all(),
        ]);
    }
}