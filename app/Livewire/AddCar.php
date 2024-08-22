<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCar extends Component
{
    use WithFileUploads;
    public $car_name ='';
    public $brand_name ='';
    public $capacity ='';
    public $fuel_type ='';
    public $photo='' ;
    public $car_desc='';
    public $car_mileage='';
    public $car_price_range='';
   
    public $transmission_type='';

    public $path1;
    
    public function saveCar(){
        $this->validate([
            'car_name'=>'required',
            'brand_name'=>'required',
            'capacity'=>'required|string',
            'photo' => 'required|image|max:10240',
            'car_desc' => 'required|string',
            'car_mileage' => 'required',
            'car_price_range' => 'required',
            'fuel_type.*' => 'in:Petrol,Diesel,Electric,Hybrid,CNG',
        'transmission_type.*' => 'in:Automatic,Manual',
            
        ]);
    
        $new_car =new Car;
        $new_car->car_name =$this->car_name;
        $new_car->brand =$this->brand_name;
        $new_car->engine_capacity =$this->capacity;
        $new_car->fuel_type =implode(',',$this->fuel_type);
        $new_car->car_desc =$this->car_desc;
        $new_car->car_mileage =$this->car_mileage;
        $new_car->car_price_range =$this->car_price_range;
        $new_car->transmission_type =implode(',',$this->transmission_type);

        // $path1 = '';
        // if($this->photo){
        //     // dd($this->photo);
        //     $path1 = $this->photo->store('photos');
        // }
        // $new_car->car_img = $path1;

        $filename = $this->photo->getClientOriginalName();
            $this->photo->storeAs('photos', $filename, 'public');

            // Get the file path
            $filePath = 'photos/' . $filename;
            $new_car->car_img = $filePath;
        
        $new_car->save();
        
        return $this->redirect('/',navigate:true);
    }

    public function render()
    {
        return view('livewire.add-car');
    }
}
