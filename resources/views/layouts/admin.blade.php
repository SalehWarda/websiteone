<!doctype html>
<html lang="en" style=" {{App::getLocale() == 'ar' ? "direction: rtl;" : "direction: ltr;"}} ">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/site/img/favicon_io/favicon-32x32.png')}}">

    <!-- jquery.vectormap css -->
    <link href="{{asset('assets/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"  href="{{asset('assets/admin/vendor/summernote/summernote-lite.min.css')}}"/>

{{--    <style>--}}
{{--        .select2-selection__arrow b{--}}
{{--            display:none !important;--}}
{{--        }--}}
{{--    </style>--}}
    <link rel="stylesheet" href="{{asset('assets/site/css/font-awesome-pro.css')}}">

    <!-- Alpine Plugins -->
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


@if (App::getLocale() == 'ar')
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/admin/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/admin/css/icons-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/admin/css/app-rtl.min.css')}}"  rel="stylesheet" type="text/css" />
    @else
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/admin/css/app.min.css')}}"  rel="stylesheet" type="text/css" />
    @endif
    <link href="{{asset('css/custom.css')}}"  rel="stylesheet" type="text/css" />

    @yield('style')

    @livewireStyles
   @stack('style')
</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


   @include('partials.admin.header')

    <!-- ========== Left Sidebar Start ========== -->
   @include('partials.admin.sidebar')
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

     @yield('content')
        <!-- End Page-content -->

        @include('partials.admin.footer')

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

{{--        <div class="p-4">--}}
{{--            <div class="mb-2">--}}
{{--                <img src="{{asset('assets/admin/images/layouts/layout-1.jpg')}}" class="img-fluid img-thumbnail" alt="layout-1">--}}
{{--            </div>--}}

{{--            <div class="form-check form-switch mb-3">--}}
{{--                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>--}}
{{--                <label class="form-check-label" for="light-mode-switch">Light Mode</label>--}}
{{--            </div>--}}

{{--            <div class="mb-2">--}}
{{--                <img src="{{asset('assets/admin/images/layouts/layout-2.jpg')}}" class="img-fluid img-thumbnail" alt="layout-2">--}}
{{--            </div>--}}
{{--            <div class="form-check form-switch mb-3">--}}
{{--                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">--}}
{{--                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>--}}
{{--            </div>--}}

{{--            <div class="mb-2">--}}
{{--                <img src="{{asset('assets/admin/images/layouts/layout-3.jpg')}}" class="img-fluid img-thumbnail" alt="layout-3">--}}
{{--            </div>--}}
{{--            <div class="form-check form-switch mb-5">--}}
{{--                <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">--}}
{{--                <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>--}}
{{--            </div>--}}


{{--        </div>--}}

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<!-- JAVASCRIPT -->
<script src="{{asset('assets/admin/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/node-waves/waves.min.js')}}"></script>


<!-- apexcharts -->
<script src="{{asset('assets/admin/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- jquery.vectormap map -->
<script src="{{asset('assets/admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('assets/admin/js/pages/dashboard.init.js')}}"></script>

<script src="{{asset('assets/admin/vendor/summernote/summernote-lite.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('assets/admin/js/app.js')}}"></script>

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />

@stack('scripts')

</body>

</html>
