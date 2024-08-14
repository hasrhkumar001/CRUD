<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewForm extends Component
{
    public $rating;
    public $review;
    public $carId;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
        'reviewHeading' => 'required|string|max:100',
    ];

    public function submit()
    {
        $this->validate();

        Review::create([
            'user_id' => auth()->id(),
            'car_id' => $this->carId,
            'rating' => $this->rating,
            'review' => $this->review,
            'reviewHeading' => $this->reviewHeading,
        ]);

        session()->flash('message', 'Review submitted successfully.');
        $this->reset();
    }

   
    public function render()
    {
        return view('livewire.review-form');
    }
}