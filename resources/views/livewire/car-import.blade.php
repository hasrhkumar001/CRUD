<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="import">
        <div class="form-group">
            <label for="file">Upload Car CSV</label>
            <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <input type="file" wire:model="file" id="file" accept=".csv" class="form-control">
                
                <!-- Progress Bar -->
                <div x-show="isUploading" class="progress mt-2">
                    <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`"></div>
                </div>
            </div>
            @error('file') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3" >
            
           Import
        </button>
    </form>
</div>