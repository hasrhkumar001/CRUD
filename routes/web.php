<?php

use App\Livewire\AddCar;
use App\Livewire\CarList;
use App\Livewire\EditCar;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\TestPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/testpage',TestPage::class)->name('mainpage');



Route::get('/register',Register::class);

Route::get('/login',Login::class)->name('login');

Route::middleware('auth')->group(function(){
    Route::get('/cars',CarList::class);
    Route::get('/add',AddCar::class);
    Route::get('/edit/car/{id}',EditCar::class);
});
