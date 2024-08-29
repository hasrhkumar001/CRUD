<div>
    <form wire:submit.prevent="uploadImages" enctype="multipart/form-data">
        <div class="form-group">
            <label for="car">Select Car</label>
            <select wire:model="carId" class="form-control">
                <option value="">Select a car</option>
                @foreach($cars as $car)
                    <option  value="{{ $car->id }}">{{ $car->car_name }}</option>
                @endforeach
            </select>
            @error('carId') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mt-3">
            <label for="images">Upload Images</label>
            <input type="file" wire:model="images" multiple>
            @error('images.*') <span class="error">{{ $message }}</span> @enderror
        </div>

        @if ($images)
            <div class="preview mt-3">
                <h5>Image Preview:</h5>
                @foreach ($images as $image)
                    <img src="{{ $image->temporaryUrl() }}" width="100" class="img-thumbnail">
                @endforeach
            </div>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Upload Images</button>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif
</div>
