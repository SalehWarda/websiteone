<?php

namespace App\Http\Livewire\Site;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartItemComponent extends Component
{

    public $item;

    public function removeFromCart($rowId)
    {
        $this->emit('removeFromCart', $rowId);
    }


    public function render()
    {
        return view('livewire.site.cart-item-component', [
            'cartItem' => Cart::instance('default')->get($this->item)
        ]);
    }
}
