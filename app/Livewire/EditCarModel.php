<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarModel;

class EditCarModel extends Component
{
    public $modelId;
    public $model_name;
    public $transmission_type;
    public $engine_capacity;
    public $fuel_type;
    public $car_desc;
    public $car_mileage;
    public $car_price;

    public function mount($modelId)
    {
        $model = CarModel::find($modelId);
        if ($model) {
            $this->modelId = $model->id;
            $this->model_name = $model->model_name;
            $this->transmission_type = $model->transmission_type;
            $this->engine_capacity = $model->engine_capacity;
            $this->fuel_type = $model->fuel_type;
            $this->car_desc = $model->car_desc;
            $this->car_mileage = $model->car_mileage;
            $this->car_price = $model->car_price;
        }
    }

    public function updateModel()
    {
        $this->validate([
            'model_name' => 'required|string',
            'transmission_type' => 'required|string',
            'engine_capacity' => 'required|string',
            'fuel_type' => 'required|string',
            'car_desc' => 'required|string',
            'car_mileage' => 'required|string',
            'car_price' => 'required|string',
        ]);

        $model = CarModel::find($this->modelId);
        if ($model) {
            $model->update([
                'model_name' => $this->model_name,
                'transmission_type' => $this->transmission_type,
                'engine_capacity' => $this->engine_capacity,
                'fuel_type' => $this->fuel_type,
                'car_desc' => $this->car_desc,
                'car_mileage' => $this->car_mileage,
                'car_price' => $this->car_price,
            ]);

            session()->flash('message', 'Car Model updated successfully.');
            return redirect()->route('car-models', ['carId' => $model->car_id]);
        }
    }

    public function render()
    {
        return view('livewire.edit-car-model');
    }
}

