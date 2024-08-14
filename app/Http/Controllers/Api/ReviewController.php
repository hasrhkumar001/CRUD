<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    if (!$request->user()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $validated = $request->validate([
        'car_id' => 'required|exists:cars,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
        'reviewHeading' => 'required|string|max:100',
    ]);

    // Check if the user has already reviewed this car
    $existingReview = Review::where('user_id', $request->user()->id)
                            ->where('car_id', $validated['car_id'])
                            ->first();

    if ($existingReview) {
        return response()->json(['error' => 'You have already reviewed this car'], 403);
    }

    $review = Review::create([
        'user_id' => $request->user()->id,
        'car_id' => $validated['car_id'],
        'rating' => $validated['rating'],
        'review' => $validated['review'],
        'reviewHeading' => $validated['reviewHeading'],
    ]);

    return response()->json(['message' => 'Review submitted successfully.', 'review' => $review]);
}
    public function index($carId)
    {
        $reviews = Review::where('car_id', $carId)->with('user:id,name')->get();
        return response()->json($reviews);
    }
}
