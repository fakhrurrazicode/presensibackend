<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Sistem Informasi Presensi') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    {{--
    <meta content="Coderthemes" name="author" /> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    {{--
    <link rel="shortcut icon" href="{{asset('shreyu/dist/assets/images/favicon.ico')}}" /> --}}

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('images/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <link href="{{asset('shreyu/dist/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{asset('shreyu/dist/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{asset('shreyu/dist/assets/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled />
    <link href="{{asset('shreyu/dist/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled />


    <link href="{{asset('shreyu/dist/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/bootstrap-table/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/sweetalert2/sweetalert2.css')}}" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>


    <div id="wrapper">
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-end mb-0">
                    <li class="d-none d-lg-block">
                        <form class="app-search">
                            <div class="app-search-box dropdown">
                                {{-- <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search..." id="top-search" />
                                    <button class="btn input-group-text" type="submit">
                                        <i class="uil uil-search"></i>
                                    </button>
                                </div> --}}

                                {{-- <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">
                                            Found 05 results
                                        </h5>
                                    </div>

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="uil uil-sliders-v-alt me-1"></i>
                                        <span>User profile settings</span>
                                    </a>

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="uil uil-home-alt me-1"></i>
                                        <span>Analytics Report</span>
                                    </a>

                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="uil uil-life-ring me-1"></i>
                                        <span>How can I help you?</span>
                                    </a>

                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow mb-2 text-uppercase">
                                            Users
                                        </h6>
                                    </div>

                                    <div class="notification-list">
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex text-align-start">
                                                <img class="me-2 rounded-circle"
                                                    src="{{asset('shreyu/dist/assets/images/users/avatar-2.jpg')}}"
                                                    alt="Generic placeholder image" height="32" />
                                                <div class="flex-grow-1">
                                                    <h5 class="m-0 fs-14">
                                                        Shirley Miller
                                                    </h5>
                                                    <span class="fs-12 mb-0">UI Designer</span>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex text-align-start">
                                                <img class="me-2 rounded-circle"
                                                    src="{{asset('shreyu/dist/assets/images/users/avatar-5.jpg')}}"
                                                    alt="Generic placeholder image" height="32" />
                                                <div class="flex-grow-1">
                                                    <h5 class="m-0 fs-14">
                                                        Timothy Moreno
                                                    </h5>
                                                    <span class="fs-12 mb-0">Frontend
                                                        Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div> --}}
                            </div>
                        </form>
                    </li>

                    {{-- <li class="dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i data-feather="search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="search here" />
                            </form>
                        </div>
                    </li> --}}

                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="fullscreen" href="#">
                            <i data-feather="maximize"></i>
                        </a>
                    </li>

                    {{-- <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i data-feather="grid"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <div class="p-1">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('shreyu/dist/assets/images/brands/slack.png')}}"
                                                alt="slack" />
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('shreyu/dist/assets/images/brands/github.png')}}"
                                                alt="Github" />
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="{{asset('shreyu/dist/assets/images/brands/dribbble.png')}}"
                                                alt="dribbble" />
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}

                    {{-- <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i data-feather="globe"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="{{asset('shreyu/dist/assets/images/flags/us.jpg')}}" alt="user-image"
                                    class="me-1" height="12" />
                                <span class="align-middle">English</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="{{asset('shreyu/dist/assets/images/flags/germany.jpg')}}" alt="user-image"
                                    class="me-1" height="12" />
                                <span class="align-middle">German</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="{{asset('shreyu/dist/assets/images/flags/italy.jpg')}}" alt="user-image"
                                    class="me-1" height="12" />
                                <span class="align-middle">Italian</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="{{asset('shreyu/dist/assets/images/flags/spain.jpg')}}" alt="user-image"
                                    class="me-1" height="12" />
                                <span class="align-middle">Spanish</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="{{asset('shreyu/dist/assets/images/flags/russia.jpg')}}" alt="user-image"
                                    class="me-1" height="12" />
                                <span class="align-middle">Russian</span>
                            </a>
                        </div>
                    </li> --}}

                    {{-- <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle position-relative" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i data-feather="bell"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">6</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="" class="text-dark"><small>Clear All</small></a> </span>Notification
                                </h5>
                            </div>

                            <div class="noti-scroll" data-simplebar>
                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                    <div class="notify-icon bg-primary">
                                        <i class="uil uil-user-plus"></i>
                                    </div>
                                    <p class="notify-details">
                                        New user registered.<small class="text-muted">5 hours ago</small>
                                    </p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                    <div class="notify-icon">
                                        <img src="{{asset('shreyu/dist/assets/images/users/avatar-1.jpg')}}"
                                            class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <p class="notify-details">
                                        Karen Robinson
                                    </p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>Wow ! this admin looks good and
                                            awesome design</small>
                                    </p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                    <div class="notify-icon">
                                        <img src="{{asset('shreyu/dist/assets/images/users/avatar-2.jpg')}}"
                                            class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <p class="notify-details">
                                        Cristina Pride
                                    </p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>Hi, How are you? What about our
                                            next meeting</small>
                                    </p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom active">
                                    <div class="notify-icon bg-success">
                                        <i class="uil uil-comment-message"></i>
                                    </div>
                                    <p class="notify-details">
                                        Jaclyn Brunswick commented on
                                        Dashboard<small class="text-muted">1 min ago</small>
                                    </p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                    <div class="notify-icon bg-danger">
                                        <i class="uil uil-comment-message"></i>
                                    </div>
                                    <p class="notify-details">
                                        Caleb Flakelar commented on
                                        Admin<small class="text-muted">4 days ago</small>
                                    </p>
                                </a>

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="uil uil-heart"></i>
                                    </div>
                                    <p class="notify-details">
                                        Carlos Crouch liked <b>Admin</b>
                                        <small class="text-muted">13 days ago</small>
                                    </p>
                                </a>
                            </div>

                            <a href="javascript:void(0);"
                                class="dropdown-item text-center text-primary notify-item notify-all">
                                View all <i class="fe-arrow-right"></i>
                            </a>
                        </div>
                    </li> --}}

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            {{-- <img src="{{asset('shreyu/dist/assets/images/users/avatar-1.jpg')}}" alt="user-image"
                                class="rounded-circle" /> --}}
                            <span class="pro-user-name ms-1">
                                {{Auth::user()->name}} <i class="uil uil-angle-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            {{-- <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                            </a>

                            <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div> --}}



                            <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                            </a>



                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                            <i data-feather="settings"></i>
                        </a>
                    </li>
                </ul>

                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark ">
                        <span class="logo-sm">
                            <img src="{{asset('shreyu/dist/assets/images/logo-sm.png')}}" alt="" height="24" />
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('shreyu/dist/assets/images/logo-dark.png')}}" alt="" height="24" />
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('shreyu/dist/assets/images/logo-sm.png')}}" alt="" height="24" />
                        </span>
                        <span class="logo-lg">
                            {{-- <img src="{{asset('shreyu/dist/assets/images/logo-light.png')}}" alt="" height="24" /> --}}
                            <img src="{{asset('shreyu/dist/assets/images/logo-dark.png')}}" alt="" height="24" />
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile">
                            <i data-feather="menu"></i>
                        </button>
                    </li>

                    <li>
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                    </li>

                    {{-- <li class="dropdown d-none d-xl-block">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            Create New
                            <i class="uil uil-angle-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="uil uil-bag me-1"></i><span>New Projects</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="uil uil-user-plus me-1"></i><span>Create Users</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="uil uil-chart-pie me-1"></i><span>Revenue Report</span>
                            </a>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="uil uil-cog me-1"></i><span>Settings</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="uil uil-question-circle me-1"></i><span>Help & Support</span>
                            </a>
                        </div>
                    </li> --}}
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="left-side-menu">
            <div class="h-100" data-simplebar>
                <div class="user-box text-center">
                    {{-- <img src="{{asset('shreyu/dist/assets/images/users/avatar-1.jpg')}}" alt="user-img"
                        title="Mat Helme" class="rounded-circle avatar-md" /> --}}
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                            data-bs-toggle="dropdown">{{Auth::user()->name}}</a>
                        <div class="dropdown-menu user-pro-dropdown">
                            {{-- <a href="pages-profile.html" class="dropdown-item notify-item">
                                <i data-feather="user" class="icon-dual icon-xs me-1"></i><span>My Account</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="settings" class="icon-dual icon-xs me-1"></i><span>Settings</span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="help-circle" class="icon-dual icon-xs me-1"></i><span>Support</span>
                            </a>
                            <a href="pages-lock-screen.html" class="dropdown-item notify-item">
                                <i data-feather="lock" class="icon-dual icon-xs me-1"></i><span>Lock Screen</span>
                            </a> --}}
                            {{-- <div class="dropdown-divider"></div> --}}

                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                            </a>


                            <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i data-feather="log-out" class="icon-dual icon-xs me-1"></i><span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <p class="text-muted">Admin Head</p>
                </div>

                <div id="sidebar-menu">
                    <ul id="side-menu">
                        <li>
                            <a href="{{route('home')}}">
                                <i data-feather="home"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Apps</li>
                        <li>
                            <a href="{{route('pegawai.index')}}">
                                <i data-feather="users"></i>
                                <span> Pegawai </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('user.index')}}">
                                <i data-feather="users"></i>
                                <span> User </span>
                            </a>
                        </li>


                        <li>
                            <a href="{{route('bidang.index')}}">
                                <i data-feather="grid"></i>
                                <span> Bidang </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('golongan.index')}}">
                                <i data-feather="grid"></i>
                                <span> Golongan </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('hari_jam_kerja.index')}}">
                                <i data-feather="calendar"></i>
                                <span> Hari & Jam Kerja </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('tanggal_libur.index')}}">
                                <i data-feather="calendar"></i>
                                <span> Tanggal Libur </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('presensi.index')}}">
                                <i data-feather="calendar"></i>
                                <span> Presensi </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('absensi_request.index')}}">
                                <i data-feather="calendar"></i>
                                <span> Absensi Request </span>
                            </a>
                        </li>



                        <li>
                            <a href="#sidebarSettings" data-bs-toggle="collapse">
                                <i data-feather="settings"></i>
                                <span> Settings </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarSettings">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{route('setting.polygon')}}">Polygon Area Kantor</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarReport" data-bs-toggle="collapse">
                                <i data-feather="file-text"></i>
                                <span> Report </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarReport">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{route('report.rekap_presensi')}}">Rekapitulasi Presensi</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <div class="content-page">
            <div class="content  mt-3">
                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            &copy; Bappeda Sulawesi Tengah
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div class="right-bar">
        <div data-simplebar class="h-100">
            <h6 class="fw-medium px-3 m-0 py-2 text-uppercase bg-light">
                <span class="d-block py-1">Theme Settings</span>
            </h6>

            <div class="p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme,
                    sidebar menu, etc.
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Color Scheme</h6>
                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="light"
                        id="light-mode-check" checked />
                    <label class="form-check-label" for="light-mode-check">Light Mode</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="color-scheme-mode" value="dark"
                        id="dark-mode-check" />
                    <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Width</h6>
                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="width" value="fluid" id="fluid-check"
                        checked />
                    <label class="form-check-label" for="fluid-check">Fluid</label>
                </div>
                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="width" value="boxed" id="boxed-check" />
                    <label class="form-check-label" for="boxed-check">Boxed</label>
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">
                    Menus (Leftsidebar and Topbar) Positon
                </h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="menus-position" value="fixed" id="fixed-check"
                        checked />
                    <label class="form-check-label" for="fixed-check">Fixed</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="menus-position" value="scrollable"
                        id="scrollable-check" />
                    <label class="form-check-label" for="scrollable-check">Scrollable</label>
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="light"
                        id="light-check" checked />
                    <label class="form-check-label" for="light-check">Light</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-color" value="dark"
                        id="dark-check" />
                    <label class="form-check-label" for="dark-check">Dark</label>
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="default"
                        id="default-size-check" checked />
                    <label class="form-check-label" for="default-size-check">Default</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="condensed"
                        id="condensed-check" />
                    <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small
                            size)</small></label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-size" value="compact"
                        id="compact-check" />
                    <label class="form-check-label" for="compact-check">Compact <small>(Small size)</small></label>
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Sidebar User Info</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="leftsidebar-user" value="fixed"
                        id="sidebaruser-check" />
                    <label class="form-check-label" for="sidebaruser-check">Enable</label>
                </div>

                <h6 class="fw-medium mt-4 mb-2 pb-1">Topbar</h6>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="topbar-color" value="dark"
                        id="darktopbar-check" checked />
                    <label class="form-check-label" for="darktopbar-check">Dark</label>
                </div>

                <div class="form-switch mb-1">
                    <input type="checkbox" class="form-check-input" name="topbar-color" value="light"
                        id="lighttopbar-check" />
                    <label class="form-check-label" for="lighttopbar-check">Light</label>
                </div>

                <button class="btn btn-primary w-100 mt-4" id="resetBtn">
                    Reset to Default
                </button>

                <a href="https://1.envato.market/shreyu_admin" class="btn btn-danger d-block mt-3" target="_blank">
                    <i class="mdi mdi-basket me-1"></i> Purchase Now
                </a>
            </div>
        </div>
    </div>

    <div class="rightbar-overlay"></div>




    <script src="{{asset('shreyu/dist/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('shreyu/dist/assets/js/app.min.js')}}"></script>

    {{-- Vendors --}}
    <script src="{{asset('vendors/bootstrap-table/bootstrap-table.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('vendors/chart.js/dist/chart.min.js')}}"></script>

    <script>
        const baseURL = "{{ url('/') }}";

        window.baseURL = baseURL;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script src="{{ asset('js/app.js') }}" defer></script>



    @yield('scripts')
</body>

</html>