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
    public $car_price_range;
    public $model_year;
    public $transmission_type;
    public Car $car_data;

    public function mount($id){
        $this->car_id=$id;
        $this->car_data= Car::where('id',$id)->first();
        $this->car_name=$this->car_data->car_name;
        $this->brand_name=$this->car_data->brand;
        $this->capacity=$this->car_data->engine_capacity;
        $this->fuel_type=explode(',',$this->car_data->fuel_type);
        $this->photo=$this->car_data->car_img;
        $this->car_mileage=$this->car_data->car_mileage;
        $this->car_price_range=$this->car_data->car_price_range;
        $this->transmission_type=explode(',',$this->car_data->transmission_type);
        $this->car_desc=$this->car_data->car_desc;
    }
    public function update(){
        $this->validate([
            'car_name'=>'required',
            'brand_name'=>'required',
            'capacity'=>'required',
            'photo' => 'required|image|max:10240',
            'car_desc' => 'required|string',
            'car_mileage' => 'required',
            'car_price_range' => 'required',
            'fuel_type.*' => 'in:Petrol,Diesel,Electric,Hybrid,CNG',
            'transmission_type.*' => 'in:Automatic,Manual',
            
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
                'fuel_type'=>implode(',',$this->fuel_type),
                'car_img'=>$filePath,
                'car_price_range'=>$this->car_price_range,
                'car_mileage'=>$this->car_mileage,
                'transmission_type'=>implode(',',$this->transmission_type),
                'car_desc'=>$this->car_desc
            ]);
            return $this->redirect('/',navigate:true);
        }catch(\Exception $e){
            dd($e);
        }
    }
   
    public function render()
    {
        return view('livewire.edit-car');
    }
}
