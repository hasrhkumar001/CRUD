<div class="container my-3">
    <div class="card">
        <div class="card-header justify-content-baseline">  
            <div class="row">
           <div class="col"><h2>Edit User</h2></div>
           <div class="col">
           <a href="/users" wire:navigate class=" btn btn-primary float-end">User List</a>
</div>
</div>
        </div>
        <div class="card-body ">
            <form wire:submit="update">
        
            <div class="mb-3 ">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" wire:model="name" id="name" placeholder="Enter New Name" value={{$name}}>
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="mb-3 ">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" wire:model="email" id="email" placeholder="Enter New Email" value={{$email}}>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
        
        
            <div class="mb-3 ">
                <label for="password" class="form-label">Password</label>
                <input type="password"  class="form-control" wire:model="password" id="password" placeholder="Enter New Password" value={{$password}}>
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
        <button type="submit" class="btn btn-success mt-3 float-end">Update</button>
</form>
        </div>
    </div>

</div>
