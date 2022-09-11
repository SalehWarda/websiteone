<div>

    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-message-2-line"></i>

        @if ($unReadNotifications)

        <span class="badge rounded-pill bg-danger float-end" style="padding-left: 0.2em;
                    padding-right: 0.4em; left: 10px">{{ $unReadNotificationsCount }}</span>
        @endif

    </button>


    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
         aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0"> البريد الوارد </h6>
                </div>

            </div>
        </div>
        <div data-simplebar style="max-height: 230px;">


            @forelse($unReadNotifications as $notification)
                @if ($notification->type == 'App\Notifications\Site\Customer\MailCreateNotification')
            <a wire:click="markAsRead('{{ $notification->id }}')" class="text-reset notification-item">
                <div class="d-flex">
                    <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-mail-line"></i>
                                                </span>
                    </div>
                    <div class="flex-1">
                        <h6 class="mb-1">لديك بريد وارد من {{$notification->data['customer_name']}} </h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{$notification->data['created_date']}}</p>
                        </div>
                    </div>
                </div>
            </a>

                @endif
                                    @empty
                                        <div class="p-2 border-top">
                                            <div class="d-grid">
                                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                                    {{trans('dashboard.No_Notifications_Found!')}}
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse

        </div>
        {{--        <div class="p-2 border-top">--}}
        {{--            <div class="d-grid">--}}
        {{--                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">--}}
        {{--                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..--}}
        {{--                </a>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</div>
