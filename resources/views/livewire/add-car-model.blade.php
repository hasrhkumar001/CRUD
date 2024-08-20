<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="carId">Select Car:</label>
            <select wire:model="carId" id="carId" class="form-control" disabled>
                <option value="">Select a Car</option>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->car_name }}</option>
                @endforeach
            </select>
            @error('carId') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
       

        <div class="form-group">
            <label for="model_name">Model Name:</label>
            <input type="text" wire:model="model_name" id="model_name" class="form-control">
            @error('model_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="transmission_type">Transmission Type:</label>
            <input type="text" wire:model="transmission_type" id="transmission_type" class="form-control">
            @error('transmission_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="engine_capacity">Engine Capacity:</label>
            <input type="text" wire:model="engine_capacity" id="engine_capacity" class="form-control">
            @error('engine_capacity') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="fuel_type">Fuel Type:</label>
            <input type="text" wire:model="fuel_type" id="fuel_type" class="form-control">
            @error('fuel_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="car_desc">Description:</label>
            <textarea wire:model="car_desc" id="car_desc" class="form-control"></textarea>
            @error('car_desc') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="car_mileage">Mileage:</label>
            <input type="text" wire:model="car_mileage" id="car_mileage" class="form-control">
            @error('car_mileage') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="car_price">Price:</label>
            <input type="text" wire:model="car_price" id="car_price" class="form-control">
            @error('car_price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Car Model</button>
    </form>
</div>
