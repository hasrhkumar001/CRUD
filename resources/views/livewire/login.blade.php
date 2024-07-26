<div class="container w-50 mt-5">
<div class="card ">
  <div class="card-header text-center">
    Login
  </div>
  <div class="card-body">
    <!-- <h5 class="card-title">Special title treatment</h5> -->
    <form wire:submit="login" >
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" wire:model="email" aria-describedby="emailHelp">
            
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" wire:model="password">
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Login</button>
    </form>
  <div class="card-footer text-body-secondary">
    
        <p>Don't have an account? Create New <a href="/register" wire:navigate class="text-style-none">Register</a></p>
    
  </div>
</div>
</div>
