<div class="container my-3">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header justify-content-baseline">  
            <div class="row">
           <div class="col"><h2>Edit Car</h2></div>
           <div class="col">
           <a href="/" wire:navigate class=" btn btn-primary float-end">Cars List</a>
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
                <input type="text" class="form-control" wire:model.lazy="capacity" id="capacity" placeholder="Enter Engine Capacity (e.g., 1800cc-2700cc)">
                        @error('capacity')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
            </div>
            <div class="mb-3 col-4">
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

                    <div class="mb-3 col-4">
                        <label for="transmission_type" class="form-label">Transmission Type</label>
                        <select id="transmission_type" wire:model="transmission_type" class="form-select" multiple>
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
                <input type="text"  class="form-control" wire:model="car_mileage" id="car_mileage" placeholder="Enter Car Mileage">
                @error('car_mileage')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="mb-3 col-4">
                <label for="car_price_range" class="form-label">Price Range</label>
                <input type="text" class="form-control" wire:model="car_price_range" id="car_price_range" placeholder="Enter Car Price Range (eg., 50000-100000)">
                @error('car_price_range')
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
