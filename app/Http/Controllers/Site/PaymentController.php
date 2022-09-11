<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Backend\Admin;
use App\Models\Backend\Coupon;
use App\Models\Backend\Service;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\User;
use App\Notifications\Site\Customer\OrderCreatedNotification;
use App\services\OmnipayService;
use App\services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function checkout_now(Request $request)
    {

        $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->purchase([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
        ]);

        if ($response->isRedirect()) {
            $response->redirect();
        }

        toastr($response->getMessage(), 'error');
        return redirect()->route('site.index');
    }


    public function cancelled($order_id)
    {
        $order = Order::find($order_id);
        $order->update([
            'order_status' => Order::CANCELED
        ]);


       toastr('You have cancelled your order payment!','error');
        return redirect()->route('site.index');


    }

    public function completed($order_id)
    {
        $order = Order::with('services', 'user', 'payment_method')->find($order_id);

        $omniPay = new OmnipayService('PayPal_Express');
        $response = $omniPay->complete([
            'amount' => $order->total,
            'transactionId' => $order->ref_id,
            'currency' => $order->currency,
            'cancelUrl' => $omniPay->getCancelUrl($order->id),
            'returnUrl' => $omniPay->getReturnUrl($order->id),
            'notifyUrl' => $omniPay->getNotifyUrl($order->id),
        ]);

        if ($response->isSuccessful()) {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                'transaction_number' => $response->getTransactionReference(),
                'payment_result' => 'success'
            ]);

            if (session()->has('coupon')) {
                $coupon = Coupon::whereCode(session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }

            Cart::instance('default')->destroy();

            session()->forget([
                'coupon',
                'saved_payment_method_id',
            ]);

           Admin::whereStatus(true)->each(function ($admin, $key) use ($order) {
               $admin->notify(new OrderCreatedNotification($order));
           });

//
//
//            $data = $order->toArray();
//            $data['currency_symbol'] = $order->currency == 'USD' ? '$' : $order->currency;
//            $pdf = PDF::loadView('layouts.invoice', $data);
//            $saved_file = storage_path('app/pdf/files/' . $data['ref_id'] . '.pdf');
//            $pdf->save($saved_file);
//
//            $customer = User::find($order->user_id);
//            $customer->notify(new OrderThanksNotification($order, $saved_file));


            toastr('Your recent payment is successful with reference code: ' . $response->getTransactionReference(), 'success');
            return redirect()->route('site.index');
        }
    }

    public function webhook($order, $env)
    {
        //
    }



}
