<?php

namespace App\Http\Livewire\Site\Header;

use Illuminate\Contracts\Queue\ShouldQueue;
use Livewire\Component;

class NotificationComponent extends Component
{

    public $unReadNotificationsCount = '';
    public $unReadNotifications;



    public function mount()
    {
        $this->unReadNotificationsCount = auth('web')->user()->unreadNotifications()->count();
        $this->unReadNotifications = auth('web')->user()->unreadNotifications()->get();
    }

    public function markAsRead($id)
    {

        $notification = auth('web')->user()->unreadNotifications()->where('id', $id)->first();
        $notification->markAsRead();


        return redirect()->route('customer.profile');
    }
    public function render()
    {
        return view('livewire.site.header.notification-component');
    }
}
