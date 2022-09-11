<?php

namespace App\Http\Livewire\Site;

use App\Models\Backend\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class FeaturedServices extends Component
{
    use LivewireAlert;

    public function addToCart($id)
    {
        $service = Service::whereId($id)->whereStatus(true)->firstOrFail();
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($service) {
            return $cartItem->id === $service->id;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'الخدمة موجودة بالفعل !');
        } else {
            Cart::instance('default')->add($service->id, $service->name,1 ,$service->price)->associate(Service::class);
            $this->emit('updateCart');

            $this->alert('success', 'تم إضافة الخدمة في السلة بنجاح.');
        }
    }

    public function render()
    {


        return view('livewire.site.featured-services',[

            'services' => Service::with('firstMedia')->take(6)->orderBy('id','DESC')->get()
        ]);
    }
}
