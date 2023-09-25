<!-- Sidebar navigation-->
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Order</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.order') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu">Order Keranjang</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.order.payment') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu">Order Payment</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('sistem.order.selesai') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu">Order Selesai</span>
            </a>
        </li>

        @if(Auth::guard('websistem')->user()->role=='Administrator')
            
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Menu</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.meja') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-brand-airtable"></i>
                    </span>
                    <span class="hide-menu">Meja</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.kategorimenu') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Kategori Menu</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.menu') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Menu</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.bank') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Bank</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.rekening') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-article"></i>
                    </span>
                    <span class="hide-menu">Rekening</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Setting</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.user') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user"></i>
                    </span>
                    <span class="hide-menu">User Management</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.setting') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-settings"></i>
                    </span>
                    <span class="hide-menu">Setting Website</span>
                </a>
            </li>
        
        @else
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Setting</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('sistem.user') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-user"></i>
                    </span>
                    <span class="hide-menu">User Management</span>
                </a>
            </li>
        @endif

    </ul>
    <a href="{{ route('sistem.logout') }}" class="btn btn-danger fs-2 fw-semibold d-block"><i class="ti ti-logout"></i> Sign Out</a>
</nav>
<!-- End Sidebar navigation -->