<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>د.فوائد الخرشي</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/site/img/logo/lo.png')}}">

    <!-- CSS here -->

    <!-- Alpine Plugins -->
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if (App::getLocale() == 'ar')

        <link rel="stylesheet" href="{{asset('assets/site/css_ar/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/meanmenu.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/animate.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/owl-carousel.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/swiper-bundle.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/backtotop.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/font-awesome-pro.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/spacing.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css_ar/style.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('assets/site/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/meanmenu.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/owl-carousel.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/swiper-bundle.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/backtotop.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/font-awesome-pro.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/spacing.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
    @endif




    @yield('style')
    @livewireStyles
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->




<!-- back to top start -->
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</div>
<!-- back to top end -->

<!-- header area start -->
 @include('partials.site.header')
<!-- header area end -->

<!-- offcanvas area start -->
<div class="offcanvas__area">
    <div class="modal fade" id="offcanvasmodal" tabindex="-1" aria-labelledby="offcanvasmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="offcanvas__wrapper">
                    <div class="offcanvas__content">
                        <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                            <div class="offcanvas__logo logo">
                                <a href="{{route('site.index')}}">
                                    <img src="{{asset('assets/site/img/logo/lo.png')}}" alt="logo">
                                </a>
                            </div>

                            <div class="offcanvas__close">
                                <button class="offcanvas__close-btn" data-bs-toggle="modal"
                                        data-bs-target="#offcanvasmodal">
                                    <i class="fal fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="offcanvas__social d-flex justify-content-center align-items-center">
                            <div >
                                <livewire:site.carts/>
                            </div>

                            @guest
                                <div >
                                    <ul>
                                        <li>
                                            <a href="{{route('site.login')}}">
                                                {{trans('site/login.Login')}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            @else

                                <div class="dropdown"  @if (App::getLocale() == 'ar') style="left: 30px" @else style="right: 30px" @endif >

                                    <livewire:site.header.notification-component/>

                                </div>

                                <div class="dropdown"@if (App::getLocale() == 'ar') style="left: 20px" @else style="right: 20px" @endif>

                                    <a   class=" btn header-item waves-effect rounded-circle"
                                         data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        <i class="fas fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">

                                        <a class="dropdown-item border-0" href="{{route('customer.courses')}}">
                                            {{trans('site.My_Courses')}}</a>


                                        <a class="dropdown-item border-0" href="{{route('customer.profile')}}">
                                            {{trans('site.My_profile')}}</a>

                                        <a href="javascript:void(0);" class="dropdown-item border-0"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{trans('site.Logout')}}</a>
                                        <form action="{{ route('logout') }}" method="post" id="logout-form"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    </div>

                                </div>





                            @endguest
                        </div><br><br><br><br>
                        <div class="mobile-menu fix"></div>

                        <div class="offcanvas__contact mt-30 mb-20">
                            <h4>{{trans('site.Get_in_touch')}}</h4>
                            <ul>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <p>{{$about->address}}</p>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="far fa-phone"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="tel:{{$about->mobile}}">{{$about->mobile}}</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="offcanvas__contact-icon mr-15">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="offcanvas__contact-text">
                                        <a href="mailto:{{$about->email}}">{{$about->email}}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="offcanvas__social">
                            <ul>
                                @foreach($socials as $social)
                                    <li><a href="{{$social->link}}" target="_blank" ><i class="fa-brands fa-{{$social->name}}"></i></a></li>

                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas area end -->
<div class="body-overlay"></div>
<!-- offcanvas area end -->

<main>

@yield('content')

</main>

<!-- footer area start -->
   @include('partials.site.footer')
<!-- footer area end -->
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<!-- JS here -->
<script src="{{asset('assets/site/js/vendor/jquery.js')}}"></script>
<script src="{{asset('assets/site/js/vendor/waypoints.js')}}"></script>
<script src="{{asset('assets/site/js/bootstrap-bundle.js')}}"></script>
<script src="{{asset('assets/site/js/meanmenu.js')}}"></script>
<script src="{{asset('assets/site/js/swiper-bundle.js')}}"></script>
<script src="{{asset('assets/site/js/owl-carousel.js')}}"></script>
<script src="{{asset('assets/site/js/magnific-popup.js')}}"></script>
<script src="{{asset('assets/site/js/parallax.js')}}"></script>
<script src="{{asset('assets/site/js/backtotop.js')}}"></script>
<script src="{{asset('assets/site/js/nice-select.js')}}"></script>
<script src="{{asset('assets/site/js/counterup.js')}}"></script>
<script src="{{asset('assets/site/js/wow.js')}}"></script>
<script src="{{asset('assets/site/js/isotope-pkgd.js')}}"></script>
<script src="{{asset('assets/site/js/imagesloaded-pkgd.js')}}"></script>
<script src="{{asset('assets/site/js/ajax-form.js')}}"></script>
<script src="{{asset('assets/site/js/main.js')}}"></script>

@yield('scripts')
@livewireScripts


<x-livewire-alert::scripts />

</body>
</html>


