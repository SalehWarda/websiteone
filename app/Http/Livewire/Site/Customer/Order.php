<?php

namespace App\Http\Livewire\Site\Customer;

use App\Models\OrderTransaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Order extends Component
{
    use LivewireAlert;
    public $showOrder = false;
    public $order;

    public function displayOrder($id)
    {
        $this->order = \App\Models\Order::with('services')->find($id);

        $this->showOrder = true;
    }

    public function requestReturnOrder($id)
    {
        $order = \App\Models\Order::whereId($id)->first();

        $order->update([
            'order_status' => \App\Models\Order::REFUNDED_REQUEST
        ]);

        $order->transactions()->create([
            'transaction' => OrderTransaction::REFUNDED_REQUEST,
            'transaction_number' => $order->transactions()->whereTransaction(OrderTransaction::PAYMENT_COMPLETED)->first()->transaction_number,
        ]);

        $this->alert('success', 'Your request is sent successfully');
    }

    public function render()
    {
        return view('livewire.site.customer.order', [
            'orders' => auth()->user()->orders,
        ]);
    }
}
