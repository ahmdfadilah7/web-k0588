<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem | {{ $setting->name_website }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ url($setting->favicon) }}" />
    
    {{-- CSS --}}
    @yield('css')
    {{-- END CSS --}}
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('sistem.dashboard') }}" class="text-nowrap logo-img">
                        <img src="{{ url($setting->logo) }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                
                {{-- SideBar --}}
                @include('sistem.layouts.partials.sidebar')
                {{-- End SideBar --}}
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ url(Auth::guard('websistem')->user()->foto) }}" alt="" width="35"
                                        height="35" class="rounded-circle">
                                    {{ Auth::guard('websistem')->user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">                                        
                                        <a href="{{ route('sistem.logout') }}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                
                {{-- Content --}}
                @yield('content')
                {{-- End Content --}}

                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">{{ $setting->name_website }}</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- JS --}}
    @yield('js')
    {{-- EN JS --}}

    {{-- Script JS --}}
    @yield('script')
    {{-- End Script JS --}}
</body>

</html>
