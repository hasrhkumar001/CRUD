<div class="d-flex flex-column flex-shrink-0 p-3  text-light" style="width: 250px; height: auto; min-height:95vh; background-color: #2d4575;" >
     
     
    <ul class="nav nav-pills flex-column mb-auto">
        <li  class="nav-link {{ Request::is('cars') ? 'active' : '' }} d-flex align-items-center">
        <i class="fa-solid fa-car"></i>
            <a href="/cars" wire:navigate class="nav-link " aria-current="page">
                Cars List   
            </a>
        </li>
        <li class="nav-link  {{ Request::is('add') ? 'active' : '' }} d-flex align-items-center">
        <i class="fa-solid fa-plus-circle"></i>
            <a href="/add" wire:navigate class="nav-link ">Add New Car
            </a>
        </li>
        
    </ul>
    
</div>
