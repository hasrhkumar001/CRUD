<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h4>Edit Car Model</h4>
    <form wire:submit.prevent="updateModel">
        <div class="form-group mb-3 ">
            <label for="model_name">Model Name:</label>
            <input type="text" wire:model="model_name" id="model_name" class="form-control">
            @error('model_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3 ">
        <label for="transmission_type" class="form-label">Transmission Type</label>
                        <select id="transmission_type" wire:model="transmission_type" class="form-select" multiple>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                        @error('transmission_type')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
        </div>

        <div class="form-group mb-3 ">
            <label for="engine_capacity">Engine Capacity:</label>
            <input type="text" wire:model="engine_capacity" id="engine_capacity" class="form-control">
            @error('engine_capacity') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3 ">
        <label for="fuel_type" class="form-label">Fuel Type <span class="text-secondary "> (Add Electric Car Separately)</span> </label>
                        <select id="fuel_type" wire:model="fuel_type" class="form-select" multiple>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="CNG">CNG</option>
                            <option value="Electric">Electric</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                        @error('fuel_type')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
        </div>

        

        <div class="form-group mb-3 ">
        <label for="car_mileage" class="form-label">Mileage</label>
        <input type="number" step="0.1" class="form-control" wire:model="car_mileage" id="car_mileage" placeholder="Enter Car Mileage">
                @error('car_mileage')
                    <span class="text-danger">{{$message}}</span>
                @enderror
        </div>

        <div class="form-group mb-3 ">
            <label for="car_price">Price:</label>
            <input type="text" wire:model="car_price" id="car_price" class="form-control">
            @error('car_price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group mb-3 ">
            <label for="car_desc">Description:</label>
            <textarea wire:model="car_desc" id="car_desc" class="form-control"></textarea>
            @error('car_desc') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Car Model</button>
    </form>
</div>
