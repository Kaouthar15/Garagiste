<html @if(app()->getLocale() == 'ar') dir="rtl" @endif 
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize </title>
    <link rel="stylesheet" href="{{ asset('../assets/css/styles.min.css') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/favicon.png') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="/" class="text-nowrap logo-img">
                    <img src="{{ asset('../assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{__('Home')}}</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">{{__('Dashboard')}}</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu"> {{__('User')}} :</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.create') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-plus"></i>
                            </span>
                            <span class="hide-menu">{{__('Add')}} {{__('User')}}</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.show') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">{{__('Manage')}} {{__('Users')}}</span>
                        </a>
                    </li>
                    
                    
                    
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{__('Vehicle')}} : </span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('vehicle.create')}}" aria-expanded="false">
                            <span>
                                <i class="ti ti-car"></i>
                            </span>
                            <span class="hide-menu">{{__('Add')}} {{__('Vehicle')}}</span> 
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('vehicle.show')}}" aria-expanded="false">
                            <span>
                                <i class="ti ti-car"></i>

                            </span>
                            <span class="hide-menu">{{__('Manage')}} {{__('Vehicles')}}</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">{{__('Statistics')}} : </span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('user.statistics')}}" aria-expanded="false">
                            <span>
                                <i class="fa fa-pie-chart"></i>
                            </span>
                            <span class="hide-menu">{{__('Users')}} </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{route('vehicle.statistics')}}" aria-expanded="false">
                            <span>
                                <i class="fa fa-bar-chart"></i>
                            </span>
                            <span class="hide-menu">{{__('Vehicles')}} </span>
                        </a>
                    </li>
                </ul>
                
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
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
                    {{-- <li class="nav-item">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                            <i class="ti ti-bell-ringing"></i>
                            <div class="notification bg-primary rounded-circle"></div>
                        </a>
                    </li> --}}
                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        {{-- {{session('locale')}} --}}
                        <select name="selectLocale" id="selectLocale">
                            <option @if(app()->getLocale() == 'ar') selected @endif value="ar">🇲🇦</option>
                            <option @if(app()->getLocale() == 'fr') selected @endif value="fr">🇫🇷</option>
                            <option @if(app()->getLocale() == 'en') selected @endif value="en">🇺🇸</option>
                            <option @if(app()->getLocale() == 'es') selected @endif value="es">🇪🇸</option>
                        </select>  
                        
                        @guest
                            <a href="{{ route('login.perform') }}"
                                class="btn btn-outline-primary mx-3 mt-2 d-block">{{__('Login')}}</a>
                            <a href="{{ route('register.perform') }}" class="btn btn-primary">Sign-up</a>
                        @endguest
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../assets/images/profile/user-1.jpg" alt="" width="35"
                                    height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop2">
                                <div class="message-body">
                                    {{-- <a href=""
                                        class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-user fs-6"></i>
                                        <p  class="mb-0 fs-3">My Profile (coming soon)</p>
                                    </a> --}}
                                    
                                    
                                    <a href="{{ route('logout.perform') }}"
                                        class="btn btn-outline-primary mx-3 mt-2 d-block">{{__('Logout')}}</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header> 
    </div>
</div>
<script src="{{ asset('../assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('../assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('../assets/js/app.min.js') }}"></script>
<script src="{{ asset('../assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('../assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('../assets/js/dashboard.js') }}"></script>
@section('scripts')
<script>
$("#selectLocale").on('change',function(){
    var locale = $(this).val();
  
    window.location.href = "/changeLocale/"+locale;
}) 
</script>
@endsection
</html>