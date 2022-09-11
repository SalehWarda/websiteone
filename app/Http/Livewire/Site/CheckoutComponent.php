<?php

namespace App\Http\Livewire\Site;

use App\Models\Backend\Coupon;
use App\Models\Backend\PaymentMethod;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use LivewireAlert;

    public $cart_subtotal;
    public $cart_tax;
    public $cart_total;
    public $coupon_code;
    public $cart_coupon;
    public $cart_discount;
    public $payment_methods;
    public $payment_method_id = 0;
    public $payment_method_code;



    protected $listeners = [
        'updateCart' => 'mount'
    ];

    public function mount()
    {
        $this->payment_method_id = session()->has('saved_payment_method_id') ? session()->get('saved_payment_method_id') : '';


        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_tax = getNumbers()->get('tax');
        $this->cart_total = getNumbers()->get('total');
        $this->cart_discount = getNumbers()->get('discount');

        $this->payment_methods = PaymentMethod::whereStatus(true)->get();

    }


    public function applyDiscount()
    {
        if (getNumbers()->get('subtotal') > 0) {
            $coupon = Coupon::whereCode($this->coupon_code)->first();
            if(!$coupon) {
                $this->cart_coupon = '';
                $this->alert('error', 'هذا الكوبون غير متوفر!');
            } else {
                $couponValue = $coupon->discount($this->cart_subtotal);
                if ($couponValue > 0) {
                    session()->put('coupon', [
                        'code' => $coupon->code,
                        'value' => $coupon->value,
                        'discount' => $couponValue,
                    ]);
                    $this->coupon_code = session()->get('coupon')['code'];
                    $this->emit('updateCart');

                    $this->alert('success', 'تم الخصم بنجاح!');
                } else {
                    $this->alert('error', 'هذا الكوبون غير متوفر!');
                }

            }

        } else {
            $this->cart_coupon = '';
            $this->alert('error', 'لا يوجد منتجات في السلة الخاصة بك !');
        }
    }

    public function removeCoupon()
    {
        session()->remove('coupon');
        $this->coupon_code = '';
        $this->emit('updateCart');
        $this->alert('success', 'تم إزالة الكوبون بنجاح!');
    }

    public function updatePaymentMethod()
    {
        $payment_method = PaymentMethod::whereId($this->payment_method_id)->first();
        $this->payment_method_code = $payment_method->code;
    }
    public function render()
    {
        return view('livewire.site.checkout-component');
    }
}
