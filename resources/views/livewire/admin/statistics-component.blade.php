



<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Earnings_from_orders_(current month)')}}</p>
                        <h4 class="mb-2">{{trans('dashboard.SR')}} {{ number_format($currentMonthEarning, 2) }}</h4>
                        <p class="text-muted mb-0"><span class="text-dark fw-bold font-size-12 me-2"><i class="ri-coupon-2-fill me-1 align-middle"></i> </span>{{trans('dashboard.Total_earnings_for_this_month')}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-danger rounded-3">
                                                    <i class="fas fa-shopping-cart font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2"> {{trans('dashboard.Earnings_from_orders_(current year)')}}</p>
                        <h4 class="mb-2">{{trans('dashboard.SR')}} {{ number_format($currentAnnualEarning, 2) }}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans('dashboard.Total_earnings_for_this_year')}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-info rounded-3">
                                                    <i class="fas fa-money-bill font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2"> {{trans('dashboard.New_orders_(current month)')}}</p>
                        <h4 class="mb-2">{{ $currentMonthOrderNew }}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans('dashboard.All_new_orders_this_month')}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-dark rounded-3">
                                                    <i class="fas fa-shopping-cart font-size-24"></i>
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
                        <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.All_service_requests')}}</p>
                        <h4 class="mb-2">{{ $currentMonthOrderFinished }}</h4>
                        <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"></span>{{trans('dashboard.All_finished_orders_(current month)')}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-warning rounded-3">
                                                    <i class="fas fa-shopping-basket font-size-24"></i>
                                                </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->

</div>
