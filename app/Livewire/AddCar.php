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
    public $car_price='';
    public $model_year='';
    public $transmission_type='';

    public $path1;
    
    public function saveCar(){
        $this->validate([
            'car_name'=>'required',
            'brand_name'=>'required',
            'capacity'=>'required',
            'fuel_type'=>'required',
            'photo' => 'required|image|max:1024',
            'car_desc' => 'required|max:1024',
            'car_mileage' => 'required',
            'car_price' => 'required',
            'model_year'=> 'required',
            'transmission_type'=>'required'
        ]);
    
        $new_car =new Car;
        $new_car->car_name =$this->car_name;
        $new_car->brand =$this->brand_name;
        $new_car->engine_capacity =$this->capacity;
        $new_car->fuel_type =$this->fuel_type;
        $new_car->car_desc =$this->car_desc;
        $new_car->car_mileage =$this->car_mileage;
        $new_car->car_price =$this->car_price;
        $new_car->model_year =$this->model_year;
        $new_car->transmission_type =$this->transmission_type;

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
        
        return $this->redirect('/cars',navigate:true);
    }

    public function render()
    {
        return view('livewire.add-car');
    }
}
