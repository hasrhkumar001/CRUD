<div class="d-flex flex-column sidebar flex-shrink-0 p-3 text-light" style="width: 250px; background-color: #2d4575;">
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Car Section -->
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" data-bs-toggle="collapse" href="#carMenu" role="button" aria-expanded="false" aria-controls="carMenu">
                <i class="fa-solid fa-car me-2"></i>
                Car
                <i class="ms-auto fa-solid fa-chevron-down toggle-icon"></i>
            </a>
            <div class="collapse" id="carMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-link {{ Request::is('/') ? 'active' : '' }} d-flex align-items-center">
                        <i class="fa-solid fa-car"></i>
                        <a href="/" wire:navigate class="nav-link" aria-current="page">Cars List</a>
                    </li>
                    <li class="nav-link {{ Request::is('add') ? 'active' : '' }} d-flex align-items-center">
                        <i class="fa-solid fa-circle-plus"></i>
                        <a href="/add" wire:navigate class="nav-link">Add New Car</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- User Section -->
        <li class="nav-item" >
            <a class="nav-link main-link d-flex align-items-center" data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="false" aria-controls="userMenu">
                <i class="fa-solid fa-user me-2"></i>
                User
                <i class="ms-auto fa-solid fa-chevron-down toggle-icon "></i>
            </a>
            <div class="collapse" id="userMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-link {{ Request::is('users') ? 'active' : '' }} d-flex align-items-center">
                        <i class="fa-solid fa-list"></i>
                        <a href="/users" wire:navigate class="nav-link" aria-current="page">Users List</a>
                    </li>
                    <li class="nav-link {{ Request::is('add/user') ? 'active' : '' }} d-flex align-items-center">
                        <i class="fa-solid fa-user-plus"></i>
                        <a href="/add/user" wire:navigate class="nav-link">Add New User</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>


