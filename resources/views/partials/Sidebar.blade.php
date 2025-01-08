<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-headers">
            <div class="sidebar-menu">
                <ul class="menu">
                <br>
                <br>
                <br>
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ url()->current() == route('dashboard') ? 'active' : '' }} ">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ url()->current() == route('profile') ? 'active' : '' }} ">
                    <a href="{{ route('profile') }}" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li>
                @if (auth()->user()->role == "Admin")
                    <li class="sidebar-title">Menu Lain</li>
                    <li class="sidebar-item  {{ url()->current() == route('users.index') ? 'active' : '' }} ">
                        <a href="{{ route('users.index') }}" class='sidebar-link'>
                            <i class="bi bi-person-circle"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == "User")
                @endif


                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link a-confirm'>
                        <i class="bi bi-power"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>