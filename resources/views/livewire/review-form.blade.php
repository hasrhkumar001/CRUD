<!-- resources/views/livewire/review-form.blade.php -->

<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" wire:model="rating" min="1" max="5" class="form-control">
            @error('rating') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="review">Review:</label>
            <textarea id="review" wire:model="review" class="form-control"></textarea>
            @error('review') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
