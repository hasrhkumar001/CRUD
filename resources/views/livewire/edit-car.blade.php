<div class="container my-5">
    <div class="card">
        <div class="card-header justify-content-baseline">  
            <div class="row">
           <div class="col"><h2>Edit Car</h2></div>
           <div class="col">
           <a href="/cars" wire:navigate class=" btn btn-primary float-end">Cars List</a>
</div>
</div>
        </div>
        <div class="card-body ">
            <form wire:submit="update">
        <div class="row">
            <div class="mb-3 col-6">
            <label for="car_name" class="form-label">Car Name</label>
            <input type="text" class="form-control" wire:model="car_name" id="car_name" placeholder="Enter Car Name" value={{$car_name}}>
            @error('car_name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="mb-3 col-6">
            <label for="brand_name" class="form-label">Brand Name</label>
            <input type="text" class="form-control" wire:model="brand_name" id="brand_name" placeholder="Enter Brand Name" value={{$brand_name}}>
            @error('brand_name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-4">
                <label for="capacity" class="form-label">Engine Capacity</label>
                <input type="number" step="0.1" class="form-control" wire:model="capacity" id="capacity" placeholder="Enter Car Engine Capacity" value={{$capacity}}>
                @error('capacity')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 col-4">
                <label for="fuel_type" class="form-label">Fuel Type</label>
                <select id="fuel_type" wire:model="fuel_type" class="form-select">
                <option selected value={{$fuel_type}}>{{$fuel_type}}</option>
                <option value="Petrol">Petrol</option>
                <option value="Diesel">Diesel</option>
                <option value="Electric">Electric</option>
                </select>
                @error('fuel_type')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 col-4">
                <label for="transmission_type" class="form-label">Transmission Type</label>
                <select id="transmission_type" wire:model="transmission_type" class="form-select">
                    <option selected>Choose</option>
                    <option value="Automatic">Automatic</option>
                    <option value="Manual">Manual</option>
                    
                </select>
                @error('transmission_type')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-4">
                <label for="car_mileage" class="form-label">Mileage</label>
                <input type="number" step="0.1" class="form-control" wire:model="car_mileage" id="car_mileage" placeholder="Enter Car Mileage">
                @error('car_mileage')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 col-4">
                <label for="model_year" class="form-label">Model year</label>
                <input type="number"  class="form-control" wire:model="model_year" id="model_year" placeholder="Enter Model Year">
                @error('model_year')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3 col-4">
                <label for="car_price" class="form-label">Price</label>
                <input type="number" class="form-control" wire:model="car_price" id="car_price" placeholder="Enter Car Price">
                @error('car_price')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
                    <div class="mb-3">
                        <label for="car_desc" class="form-label">Description</label>
                        <input type="text" class="form-control" wire:model="car_desc" id="car_desc" placeholder="Enter Car Description">
                        @error('car_desc')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
        
        <div class="mb-3">
                    <label for="photo" class="form-label">Car Image</label>
                    <input type="file" class="form-control" wire:model="photo" >
                    @error('photo')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
        <button type="submit" class="btn btn-success mt-3 float-end">Update</button>
</form>
        </div>
    </div>

</div>
