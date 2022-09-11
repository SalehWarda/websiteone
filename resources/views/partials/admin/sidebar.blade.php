<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">

            <div class="">
                @if(auth('admin')->user()->firstMedia)
                    <img class="avatar-md rounded-circle"
                         src="{{asset('assets/images/admin/users/'.auth('admin')->user()->firstMedia->file_name)}}"
                         alt="{{auth('admin')->user()->name}}">
                @else
                    <img class="avatar-md rounded-circle" src="{{asset('assets/images/admin/users/avatar.png')}}"
                         alt="{{auth('admin')->user()->name}}">

                @endif
            </div>
            <div class=" mt-3">
                    <h4 class="font-size-16 mb-1">{{auth('admin')->user()->name}}</h4>
                    <span class="text-muted"><i
                            class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">أقسام لوحة التحكم</li>

                <li>
                    <a href="{{route('admin.dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>{{trans('sidebar.Home')}}</span>
                    </a>
                </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-information-fill"></i>
                            <span>معلومات الغلاف</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.cover')}}">معلومات الغلاف</a></li>
                        </ul>
                    </li>


                @can('counter')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-numbers-fill"></i>
                            <span>{{trans('sidebar.Counter')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.counter')}}">{{trans('sidebar.Counter')}}</a></li>
                        </ul>
                    </li>
                @endcan

                @can('services')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-award-fill"></i>
                            <span>{{trans('sidebar.Services')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.services')}}">{{trans('sidebar.Services_list')}}</a></li>
                            <li><a href="{{route('admin.services.questions')}}">{{trans('sidebar.Services_questions')}}</a></li>
                            <li><a href="{{route('admin.services.service-timings')}}">{{trans('sidebar.Services_dates')}}</a></li>
                        </ul>
                    </li>
                @endcan

                @can('blog')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>{{trans('sidebar.Blog')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>


                            <li><a href="{{route('admin.posts')}}">{{trans('sidebar.Posts_list')}}</a></li>


                            </li>

                        </ul>
                    </li>
                @endcan

                @can('about')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-quill-pen-fill"></i>
                        <span>{{trans('sidebar.About_me')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>


                        <li><a href="{{route('admin.about')}}">{{trans('sidebar.About_me')}}</a></li>


                        </li>

                    </ul>
                </li>
                @endcan

                @can('coupons')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-coupon-2-fill"></i>
                            <span>{{trans('sidebar.Coupons')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>


                            <li><a href="{{route('admin.coupons')}}">{{trans('sidebar.Coupons_list')}}</a></li>


                            </li>

                        </ul>
                    </li>
                @endcan


                @can('socials')

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-account-circle-line"></i>
                            <span>{{trans('sidebar.Socials_media')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.socials')}}">{{trans('sidebar.Socials_media_list')}}</a></li>

                        </ul>
                    </li>
                @endcan


                @can('courses')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-youtube-fill"></i>
                            <span>{{trans('sidebar.Courses')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.courses')}}">{{trans('sidebar.Courses_list')}}</a></li>

                        </ul>
                    </li>
                @endcan

                @can('payment_methods')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-money-dollar-box-fill"></i>
                        <span>{{trans('sidebar.Payment_method')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.payment_methods.index')}}">{{trans('sidebar.Payment_method')}}</a></li>

                    </ul>
                </li>
                @endcan

                @can('orders')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-secure-payment-fill"></i>
                        <span>{{trans('sidebar.Orders')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.orders.index')}}">{{trans('sidebar.Orders_list')}}</a></li>

                    </ul>
                </li>
                @endcan


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-team-line"></i>
                        <span>{{trans('sidebar.Users')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('admin_users')
                        <li><a href="{{route('admin.users')}}">{{trans('sidebar.cPanel_users')}}</a></li>
                        @endcan
                            @can('customers')
                        <li><a href="{{route('admin.customers')}}">{{trans('sidebar.Site_users')}}</a></li>
                            @endcan

                    </ul>
                </li>

                @can('roles')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-vip-crown-2-line"></i>
                        <span>{{trans('sidebar.User_permissions')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.roles.index')}}">{{trans('sidebar.User_permissions')}}</a></li>

                    </ul>
                </li>
                @endcan




                @can('mail')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-mail-line"></i>
                            <span>{{trans('sidebar.Mail')}}</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('admin.mail')}}">{{trans('sidebar.Mail')}}</a></li>

                        </ul>
                    </li>
                @endcan

                @can('privacy_and_usage_policy')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-comment-dots"></i>
                        <span>{{trans('sidebar.Privacy_and_Usage_Policy')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.privacy')}}">{{trans('sidebar.Privacy_and_Usage_Policy')}}</a></li>

                    </ul>
                </li>
                @endcan

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line"></i>
                        <span>{{trans('sidebar.Settings')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('admin.account_settings')}}">{{trans('sidebar.Settings')}}</a></li>

                    </ul>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
