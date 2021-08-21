<!doctype html>
<html class="no-js" lang="en">
@php
$public = \App\Inhouse::where(['notification_status' => 1])->where(['type' => 'public'])->count();
$guru = \App\Inhouse::where(['notification_status' => 1])->where(['type' => 'guru'])->count();
$inhouse = \App\Inhouse::where(['notification_status' => 1])->where(['type' => 'in_house'])->count();
$manage_guru = \App\User::where(['notification_status' => 1])->count();


@endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
           @if(Auth::guard('admin-web')->user())
              Admin
           @else
              Guru Panel
           @endif
        </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('backend/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('backend/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="page-container">

        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="#"><img src="{{asset('/frontend/images/First-aid-Guru-dark-logo.svg')}}" loading="lazy" height="50" width="150" alt=""></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            @if(Auth::guard('customer-web')->user())
                                <li class="active">
                                    <a href="{{ url('/customer') }}" aria-expanded="true"><i
                                            class="ti-dashboard"></i><span>dashboard</span></a>
                                </li>    
                                
                                <li>
                                    <a href="{{ url('/customer/customer_details') }}" aria-expanded="true"><i
                                            class="ti-pie-chart"></i><span>customer Details</span></a>
                                    
                                </li>
                              
                                
                            @else
                                <li class="active">
                                    <a href="{{ url('/home') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                </li>
                                <!-- <li><a href="{{route('gurubookings.upcoming')}}">Booking Course</a></li> -->
                                <!-- <li><a href="{{route('assignDates')}}">All Bookings</a></li> -->
                            @endif                                
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        @if(Session::has('error'))
                            <div class="mt-2 alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="mt-2 alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <!-- <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div> -->
                    </div>
                   
                </div>
            </div>
            <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    @if(Auth::guard('admin-web')->user())
                        <li><a href="/admin">Home</a></li>
                   @else
                      <li><a href="/home">Home</a></li>
                   @endif
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
               
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                    
                @if(Auth::guard('customer-web')->user())
                {{ Auth::guard('customer-web')->user()->name }}
                
                @endif
                <i class="fa fa-angle-down"></i>
                </h4>
                <div class="dropdown-menu">
                @if(!(Auth::guard('customer-web')->user()))
                    <a class="dropdown-item" href="{{ route('profile') }}">Update Profile</a>
                    <a class="dropdown-item" href="{{ route('guru.single', Auth::user()->id) }}" target="_blank">Profile Url</a>
                @endif
            </div>
                <div class="dropdown-menu">
                @if(Auth::guard('customer-web')->user())
                    <a class="dropdown-item" href="{{ route('customer.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                      @else
                      <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      @endif
                </div>
            </div>
        </div>
    </div>
</div>
            @yield('content')
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright {{date('Y')}}. All right reserved.  <a href="/"></a>.
                </p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
 
    <!-- jquery latest version -->
    <script src="{{ asset('backend/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('backend/js/popper.min.js')}}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('backend/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.slicknav.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
   
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('backend/js/line-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('backend/js/pie-chart.js')}}"></script>
    <!-- others plugins -->
    <script src="{{ asset('backend/js/plugins.js')}}"></script>
    <script src="{{ asset('backend/js/scripts.js')}}"></script>
</body>

</html>
