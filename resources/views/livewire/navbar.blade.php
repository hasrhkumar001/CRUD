<nav class="navbar navbar-expand-lg  navbar-light " style="background-color: #1c2b4a;">
    <div class="container-fluid ">
        <div>
            <a class="navbar-brand text-white mx-3 fs-3 fw-bold" wire:navigate  href="/">DriveDetails</a>
            
        </div>
        <div class=" d-flex align-items-center" id="navbarNav">
            
            
            <div class="dropdown ms-3">
                <a href="#" class=" text-decoration-none dropdown-toggle text-white" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mt-2 text-small shadow " aria-labelledby="dropdownUser">
                    
                    <li><a class="dropdown-item " wire:navigate wire:click="logout"  href="/login">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
