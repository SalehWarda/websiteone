<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">{{trans('dashboard.Website_visits_(this today)')}}</p>
                        <h4 class="mb-2">{{$currentDayVisits}}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans("dashboard.Today's_visits_so_far")}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3">
                                                    <i class="ri-eye-2-line font-size-24"></i>
                                                </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">{{trans("dashboard.Website_visits_(this month)")}}</p>
                        <h4 class="mb-2">{{$currentMonthVisits}}</h4>
                        <p class="text-muted mb-0"><span class="text-dark fw-bold font-size-12 me-2"></span>{{trans("dashboard.Visits_this_month_so_far")}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-dark rounded-3">
                                                    <i class="ri-eye-line font-size-24"></i>
                                                </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">{{trans("dashboard.Website_visits_(this year)")}}</p>
                        <h4 class="mb-2">{{$currentYarlyEarning}}</h4>
                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"></span>{{trans("dashboard.Visits_this_year_so_far")}}</p>
                    </div>
                    <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3">
                                                    <i class="mdi mdi-eye font-size-24"></i>
                                                </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->
