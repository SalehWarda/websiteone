<?php

namespace App\services;

use App\Models\Backend\Course;
use App\Models\Backend\Service;
use App\Models\Order;
use App\Models\OrderTransaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

class OrderService
{


    public function createOrder($request)
    {


        $order = Order::create([
            'ref_id' => 'ORD-' . Str::random(15),
            'user_id' => auth()->id(),
            'payment_method_id' => $request['payment_method_id'],
            'subtotal' => getNumbers()->get('subtotal'),
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['code'] : null,
            'discount' => getNumbers()->get('discount'),
            'tax' => getNumbers()->get('productTaxes'),
            'total' => getNumbers()->get('total'),
            'currency' => 'USD',
            'order_status' => 0,
        ]);



           foreach (Cart::content() as $item) {


               if($item->options->type === 'course')
                   \App\Models\OrderCourse::create([
                       'order_id' => $order->id,
                       'course_id' =>$item->model->id,

                   ]);
               elseif($item->options->type === 'service')
               \App\Models\OrderService::create([
                   'order_id' => $order->id,
                   'service_id' => $item->model->id,

               ]);








               }

        $order->transactions()->create([
            'transaction' => OrderTransaction::NEW_ORDER
        ]);

        return $order;
    }

}
