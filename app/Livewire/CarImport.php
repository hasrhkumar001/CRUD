<?php
namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarImport extends Component
{
    use WithFileUploads;

    public $file;

    protected $rules = [
        'file' => 'required|file|mimes:csv,txt,xlsx',
    ];

    public function import()
    {
        $this->validate();

        $path = $this->file->storeAs('uploads', $this->file->getClientOriginalName(),'public');
     

        // Open the file and read its content
        if (($handle = fopen(public_path('public/photos/' . $path), 'r')) !== false) {
            $header = null;

            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    if (count($header) != count($row)) {
                        // Debugging
                        
                        throw new \Exception("The number of columns in the row does not match the header.");
                    }
    
                    $data = array_combine($header, $row);
    
                    Car::create([
                        'car_name' => $data['car_name'],
                        'brand' => $data['brand_name'],
                        'engine_capacity' => $data['capacity'],
                        'fuel_type' => $data['fuel_type'],
                        'car_desc' => $data['car_desc'],
                        'car_mileage' => $data['car_mileage'],
                        'car_price_range' => $data['car_price_range'],
                        'transmission_type' => $data['transmission_type'],
                        'car_img' => 'photos/' . $data['car_img'],

                    ]);
                }
            }
    
            fclose($handle);
        }

        session()->flash('message', 'Car data imported successfully.');
    }

    public function render()
    {
        return view('livewire.car-import');
    }
}
