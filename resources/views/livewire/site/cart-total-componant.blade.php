<div class="row justify-content-end">
    <div class="col-md-5">
        <div class="cart-page-total">
            <h2>{{trans('site.Cart_Total')}}</h2>
            <ul class="mb-20">
                @if ($cart_total != 0)
                    <li>{{trans('site.Subtotal')}} <span>{{trans('site.SR')}} {{$cart_subtotal}}</span></li>

                    @if(session()->has('coupon'))

                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">{{trans('site.Discount')}} <small>({{ getNumbers()->get('discount_code') }})</small></strong>
                            <span class="text-muted small">- {{trans('site.SR')}} {{ $cart_discount }}</span>
                        </li>

                    @endif
                    <li>{{trans('site.Tax')}} <span>{{trans('site.SR')}} {{$cart_tax}}</span></li>
                    <li>{{trans('site.TOTAL')}} <span>{{trans('site.SR')}} {{$cart_total}}</span></li>
                @else

                    <li class="align-items-center justify-content-center mb-4">
                        <span>السلة الخاصة بك فارغة!</span>
                    </li>
                    
                @endif
            </ul>
            @if (Cart::instance('default')->count() > 0)
            <a class="tp-btn" href="{{route('site.checkout')}}">{{trans('site.Proceed_to_checkout')}}</a>
            @endif
        </div>
    </div>
</div>

