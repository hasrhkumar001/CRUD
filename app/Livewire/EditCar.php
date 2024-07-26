<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCar extends Component
{
    use WithFileUploads;
    public $car_id;
    public $car_name;
    public $brand_name;
    public $capacity;
    public $fuel_type;
    public $photo;
    public $car_desc;
    public $car_mileage;
    public $car_price;
    public $model_year;
    public $transmission_type;
    public Car $car_data;

    public function mount($id){
        $this->car_id=$id;
        $this->car_data= Car::where('id',$id)->first();
        $this->car_name=$this->car_data->car_name;
        $this->brand_name=$this->car_data->brand;
        $this->capacity=$this->car_data->engine_capacity;
        $this->fuel_type=$this->car_data->fuel_type;
        $this->photo=$this->car_data->car_img;
        $this->car_mileage=$this->car_data->car_mileage;
        $this->car_price=$this->car_data->car_price;
        $this->model_year=$this->car_data->model_year;
        $this->transmission_type=$this->car_data->transmission_type;
        $this->car_desc=$this->car_data->car_desc;
    }
    public function update(){
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

        try{
            $filename = $this->photo->getClientOriginalName();
            $this->photo->storeAs('photos', $filename, 'public');

            // Get the file path
            $filePath = 'photos/' . $filename;
            
            Car::where('id',$this->car_id)->update([
                'car_name'=> $this->car_name,
                'brand'=>$this->brand_name,
                'engine_capacity'=>$this->capacity,
                'fuel_type'=>$this->fuel_type,
                'car_img'=>$filePath,
                'car_price'=>$this->car_price,
                'car_mileage'=>$this->car_mileage,
                'model_year'=>$this->model_year,
                'transmission_type'=>$this->transmission_type,
                'car_desc'=>$this->car_desc
            ]);
            return $this->redirect('/cars',navigate:true);
        }catch(\Exception $e){
            dd($e);
        }
    }
   
    public function render()
    {
        return view('livewire.edit-car');
    }
}
