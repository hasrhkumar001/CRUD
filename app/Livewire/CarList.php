<?php

namespace App\Livewire;

use App\Models\Car;

use Illuminate\Http\Request;
use Livewire\Component;

class CarList extends Component
{
    public $all_cars;
    
    public function mount(){
        $this->all_cars = Car::all();
    }
    public function delete($id){
        try{
            Car::where('id',$id)->delete(); 
            return $this->redirect('/',navigate:true);
        }catch(\Exception $e){
            dd($e);
        }
    }

    public function viewCarModels($carId)
    {
        return redirect()->route('car-models', ['carId' => $carId]);
    }
    
    public function render()
    {
        return view('livewire.car-list',[
            'cars' => $this->all_cars
        ]);
    }
}
