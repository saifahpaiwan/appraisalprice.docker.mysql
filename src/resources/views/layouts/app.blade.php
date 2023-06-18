<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Project Name') }}</title>

    <!-- App css -->
    <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ asset('template/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <style>
        a {
            text-decoration: inherit !important;
        }

        .page-title-box {
            padding: 12px 20px;
        }

        .drinkcard-cc {
            color: #fff;
            padding: 0.25rem;
            border-radius: 5px;
        }

        .note-popover .popover-content,
        .card-header.note-toolbar {
            z-index: 2;
        }

        .w-220 {
            width: 220px;
        }
    </style>
</head>

<body>

    <div id="wrapper">
        <div class="navbar-custom">
            @guest
            @else
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-user"></i>
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0"> ยินดีต้อนรับเข้าสู่ระบบ </h6>
                        </div>

                        <a href="{{ route('users.edit', Auth::user()->id) }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>ตั้งค่าข้อมูลส่วนตัว</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            Role :
                            <span> {{ Auth::user()->getRoleNames()->first() }} </span>
                        </a>
                        <a href="#" class="dropdown-item notify-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fe-log-out"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            @endguest

            <div class="logo-box">
                <a href="{{ route('home') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{ asset('/logo-1.png') }}" height="40"> 
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('/favicon.ico') }}" height="35">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>
            </ul>
        </div>

        <div class="left-side-menu">
            <div class="slimscroll-menu">
                <div id="sidebar-menu">
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title"> Menu List </li>
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fe-home"></i>
                                <span> Home </span>
                            </a>
                        </li>
                        @can('product-list')
                        <li>
                            <a href="{{ route('products.index') }}">
                                <i class="fe-box"></i>
                                <span> Product</span>
                            </a>
                        </li>
                        @endcan

                        <li class="menu-title"> Management Authenticate </li>
                        <li>
                            <a href="{{ route('users.index') }}">
                                <i class="fe-users"></i>
                                <span> Users </span>
                            </a>
                        </li>
                        @can('role-list')
                        <li>
                            <a href="{{ route('roles.index') }}">
                                <i class="fe-lock"></i>
                                <span> Role </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('log-viewer') }}">
                                <i class="fe-folder"></i>
                                <span> Logs System </span>
                            </a>
                        </li>
                        @endcan 
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            {{date('Y')}} &copy; {{ config('app.name', 'Project Name') }}
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

    <script src="{{ asset('template/js/vendor.min.js') }}"></script>
    <script src="{{ asset('template/js/app.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function() { 
                $(this).find(":submit").attr('disabled', 'disabled');
                $(this).find(":submit").html('<i class="mdi mdi-spin mdi-loading"></i>');
            }); 
        });
    </script>
    @yield('script')
</body>

</html>