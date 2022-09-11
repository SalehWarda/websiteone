<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/admin/images/logo-sm.png')}}" alt="logo-sm" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{asset('assets/admin/images/logo-dark.png')}}" alt="logo-dark" height="20">
                                </span>
                </a>

                <a href="{{route('admin.dashboard')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/hulla1.png')}}" alt="logo-sm-light" height="50">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{asset('assets/images/hulla1.png')}}" alt="logo-light" height="50">
                                </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>

            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (App::getLocale() == 'ar')
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                        <img src="{{ URL::asset('assets/admin/images/flags/sa.svg') }}" width="25" height="20" alt="">
                    @else
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                        <img src="{{ URL::asset('assets/admin/images/flags/us_flag.jpg') }}" width="25" height="20" alt="">
                    @endif                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" class="btn btn-country btn-lg btn-block {{$properties['native'] == App::getLocale() ? 'active' : ''}} " hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset($properties['image'])}}" class="me-1" width="25" height="20" alt="{{ $properties['name'] }}"> {{   $properties['name'] }}
                    </a>
                    @endforeach
                </div>
            </div>


            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="mt-4">
                <a href="{{route('site.index')}}"  class="noti-icon waves-effect" target="_blank" >
                    <i class="far fa-eye"></i>
                </a>
            </div>

            <div class="dropdown d-inline-block">
                 <livewire:admin.header.notification-component/>
            </div>




            <div class="dropdown d-inline-block">
                 <livewire:admin.header.mail-notification-component/>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    @if(auth('admin')->user()->firstMedia)
                        <img class="rounded-circle header-profile-user" src="{{asset('assets/images/admin/users/'.auth('admin')->user()->firstMedia->file_name)}}"
                             alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user" src="{{asset('assets/images/admin/users/avatar.png')}}"
                             alt="Header Avatar">

                    @endif



                    <span class="d-none d-xl-inline-block ms-1">{{auth('admin')->user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('admin.account_settings')}}"><i class="ri-user-line align-middle me-1"></i> {{trans('dashboard.Profile')}}</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger"  href="javascript:void(0);"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i>{{trans('dashboard.Logout')}} </a>
                    <form action="{{route('admin.logout')}}" method="post" id="logout-form" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div>

        </div>
    </div>
</header>
