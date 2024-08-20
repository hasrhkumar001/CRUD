<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\CarModel;

class CarModelList extends Component
{
    public $selectedModelId;
    public $carId;
    public $carModels = [];
    public function mount($carId = null)
    {
        $this->carId = $carId;
        if ($carId) {
            $this->carModels = CarModel::where('car_id', $carId)->get();
        }
    }

    public function updatedCarId($value)
    {
        if ($value) {
            $this->carModels = CarModel::where('car_id', $value)->get();
        } else {
            $this->carModels = [];
        }
    }

    public function editModel($modelId)
    {
        $this->selectedModelId = $modelId;
        return redirect()->route('car-model.edit', ['modelId' => $modelId]);
    }
    public function deleteModel($modelId)
    {
        $model = CarModel::findOrFail($modelId);
        $model->delete();
        $this->carModels = CarModel::where('car_id', $this->carId)->get();
        session()->flash('message', 'Car Model deleted successfully.');
        return redirect()->route('car-models', [$this->carId]);
    }
    public function render()
    {
        $cars = Car::all();

        return view('livewire.car-model-list', [
            'cars' => $cars,
            'carModels' => $this->carModels,
        ]);
    }
}
