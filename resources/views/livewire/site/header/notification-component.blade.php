

<div>


    <a   class=" btn header-item waves-effect rounded-circle"
         data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="badge bg-danger rounded-circle ml-20" style="top: 8px;
                                                  ">{{ $unReadNotificationsCount }}</span>
        <i class="fas fa-bell"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        @forelse($unReadNotifications as $notification)

            <a wire:click="markAsRead('{{ $notification->id }}')"  class="dropdown-item d-flex align-items-center" >
                <div class="mr-15">
                    <div class="icon-circle bg-dark">
                        <i class="fa fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ $notification->data['created_date'] }}</div>
                    <span class="font-weight-bold">Order {{ $notification->data['order_ref'] }} status is {{ $notification->data['last_transaction'] }}</span>
                </div>
            </a>


        @empty
            <div class="dropdown-item text-center">No notifications found!</div>
        @endforelse

    </div>


</div>








