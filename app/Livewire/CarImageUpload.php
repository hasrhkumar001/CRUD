<?php

namespace App\Livewire;

use App\Models\Car;
use App\Models\CarImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarImageUpload extends Component
{
    use WithFileUploads;

    public $carId;
    public $images = [];

    protected $rules = [
        'carId' => 'required|exists:cars,id',
        'images.*' => 'image|max:50240',
        'images' => 'array|max:20', 
    ];

    public function updatedImages()
    {
        $this->validate();
    }

    public function uploadImages()
    {
        $this->validate();

        foreach ($this->images as $image) {
            $filename = $image->getClientOriginalName();
            $path = $image->storeAs('car_images', $filename, 'public');

            CarImage::create([
                'car_id' => $this->carId,
                'image_url' => $path,
            ]);
        }

        session()->flash('message', 'Images uploaded successfully.');
        $this->reset('images');
    }

    public function render()
    {
        return view('livewire.car-image-upload', [
            'cars' => Car::all(), // Fetch all cars for the dropdown
        ]);
    }
}