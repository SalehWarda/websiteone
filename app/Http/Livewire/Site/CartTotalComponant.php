<?php

namespace App\Http\Livewire\Site;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartTotalComponant extends Component
{

    public $cart_subtotal;
    public $cart_discount;
    public $cart_tax;
    public $cart_shipping;
    public $cart_total;

    protected $listeners = [
        'updateCart' => 'mount'
    ];

    public function mount()
    {
        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_discount = getNumbers()->get('discount');
        $this->cart_tax = getNumbers()->get('tax');
        $this->cart_total = getNumbers()->get('total');
    }
    public function render()
    {
        return view('livewire.site.cart-total-componant');
    }
}
