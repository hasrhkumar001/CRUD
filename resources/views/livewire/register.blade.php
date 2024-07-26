<div class="container w-50 mt-5">
<div class="card ">
  <div class="card-header text-center">
    Register
  </div>
  <div class="card-body">
    <!-- <h5 class="card-title">Special title treatment</h5> -->
    <form wire:submit="register" >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name')
                        <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" wire:model="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            @error('email')
                        <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" wire:model="password">
            @error('password')
                        <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Register</button>
    </form>
  <div class="card-footer ">
    
        <p>Already have an account? <a href="/login" class="text-style-none"  wire:navigate>Login</a></p>
    
  </div>
</div>
</div>
