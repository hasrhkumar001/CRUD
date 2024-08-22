<?php


use App\Livewire\AddCarModel;
use App\Livewire\AddCar;
use App\Livewire\AddUser;
use App\Livewire\CarList;
use App\Livewire\CarModelList;
use App\Livewire\EditCar;
use App\Livewire\EditCarModel;
use App\Livewire\Login;

use App\Livewire\Register;

use App\Livewire\UserList;
use App\Livewire\EditUser;
use Illuminate\Support\Facades\Route;




Route::get('/register',Register::class)->name('register');

Route::get('/login',Login::class)->name('login');



Route::middleware('auth:admin')->group(function(){
    Route::get('/',CarList::class);
    Route::get('/add',AddCar::class);
    Route::get('/edit/car/{id}',EditCar::class);
    Route::get('/users',UserList::class);
    Route::get('/edit/user/{id}',EditUser::class);
    Route::get('/add/user',AddUser::class);
    Route::get('/add/carmodel/{id}', AddCarModel::class);
    Route::get('/car-models/{carId?}', CarModelList::class)->name('car-models');;
    Route::get('/car-model/edit/{modelId}', EditCarModel::class)->name('car-model.edit');
});

