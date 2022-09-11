
@extends('layouts.admin')

@section('title')
   {{trans('dashboard.Holla_Company')}}
@endsection


@section('content')


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{trans('dashboard.Dashboard')}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('dashboard.Home')}}</a></li>
                                <li class="breadcrumb-item active">{{trans('dashboard.Dashboard')}}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_services')}}</p>
                                    <h4 class="mb-2">{{$services->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans('dashboard.The_full_number_of_services')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-award-fill font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_posts')}}</p>
                                    <h4 class="mb-2">{{$posts->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"></span>{{trans('dashboard.Active_posts_stats')}}ة</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-post font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_Courses')}}</p>
                                    <h4 class="mb-2">{{$courses->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-dark fw-bold font-size-12 me-2"><i class="fab fa-youtube me-1 align-middle"></i>({{$videos->count()}})</span>{{trans('dashboard.Total_videos')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-dark rounded-3">
                                                    <i class="ri-video-line font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_site_visits')}}</p>
                                    <h4 class="mb-2">{{$visits}}</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans('dashboard.Visits_the_home_page_of_the_site')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-danger rounded-3">
                                                    <i class="mdi mdi-eye font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_Control_Panel_Users')}}</p>
                                    <h4 class="mb-2">{{$admins->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans('dashboard.Users_with_different_permissions')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-dark rounded-3">
                                                    <i class="fa fa-users font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_incoming_mail')}}</p>
                                    <h4 class="mb-2">{{$mails->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"></span>{{trans('dashboard.Number_of_messages_received')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-warning rounded-3">
                                                    <i class="fa fa-message font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Total_discount_coupons')}}</p>
                                    <h4 class="mb-2">{{$coupons->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-dark fw-bold font-size-12 me-2"><i class="ri-coupon-2-fill me-1 align-middle"></i> ({{$coupons->count()}})</span>{{trans('dashboard.Total_activated_coupons')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-danger rounded-3">
                                                    <i class="ri-coupon-2-fill font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2"> {{trans('dashboard.Total_site_users')}}</p>
                                    <h4 class="mb-2">{{$users->count()}}</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans('dashboard.Registered_users_of_the_site')}}</p>
                                </div>
                                <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-info rounded-3">
                                                    <i class="fa fa-users font-size-24"></i>
                                                </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

          <livewire:admin.statistics-component/>

            <livewire:admin.visits-component/>

          <livewire:admin.chart-component/>
            <!-- end row -->


        </div>

    </div>


@endsection


