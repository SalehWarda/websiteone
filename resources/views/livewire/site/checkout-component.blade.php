<div class="row">
    <div class="col-lg-6">
        <div class="checkbox-form">

            <h2 class="h5 text-uppercase mb-4">{{trans('site.Payment_Way')}}</h2>
            <div class="row">
                @forelse($payment_methods as $payment_method)
                    <div class="col-6 form-group">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="payment-method-{{ $payment_method->id }}"
                                class="custom-control-input"
                                wire:model="payment_method_id"
                                wire:click="updatePaymentMethod()"
                                {{ intval($payment_method_id) == $payment_method->id ? 'checked' : '' }}
                                value="{{ $payment_method->id }}">
                            <label for="payment-method-{{ $payment_method->id }}" class="custom-control-label text-small">
                                <b>{{ $payment_method->name }}</b>
                            </label>
                        </div>
                    </div>
                @empty
                    <p>No payment way found</p>
                @endforelse
            </div><br>
            @if ($payment_method_id != 0)
                @if (\Str::lower($payment_method_code) == 'ppex')
                    <form action="{{route('checkout.payment')}}" method="post">
                        @csrf
                        <input type="hidden" name="payment_method_id" value="{{ old('payment_method_id', $payment_method_id) }}" class="form-control">
                        <button type="submit" name="submit" class="btn btn-dark btn-sm btn-block">
                           {{trans('site. Continue_to_checkout_with_PayPal')}}
                        </button>
                    </form>
                @endif
            @endif

        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 rounded-0 p-lg-4 bg-light">
            <div class="card-body">
                <h5 class="text-uppercase mb-4">{{trans('site.Your_Order')}}</h5>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="small font-weight-bold">{{trans('site.Subtotal')}}</strong>
                        <span class="text-muted small">{{trans('site.SR')}} {{$cart_subtotal}}</span>
                    </li>

                    @if(session()->has('coupon'))
                        <li class="border-bottom my-2"></li>
                        <li class="d-flex align-items-center justify-content-between">
                            <strong class="small font-weight-bold">{{trans('site.Discount')}} <small>({{ getNumbers()->get('discount_code') }})</small></strong>
                            <span class="text-muted small">- {{trans('site.SR')}} {{ $cart_discount }}</span>
                        </li>
                    @endif



                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="small font-weight-bold">{{trans('site.Tax')}}</strong>
                        <span class="text-muted small">{{trans('site.SR')}} {{$cart_tax}}</span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between">
                        <strong class="text-uppercase small font-weight-bold">{{trans('site.TOTAL')}}</strong>
                        <span>{{trans('site.SR')}} {{$cart_total}}</span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li>
                        <form wire:submit.prevent="applyDiscount()">

                            @if (!session()->has('coupon'))
                                <input type="text" wire:model="coupon_code" class="form-control" placeholder="{{trans('site.Enter_your_coupon')}}">
                            @endif
                            <br>
                                @if(session()->has('coupon'))
                                    <button type="button" wire:click.prevent="removeCoupon()" class="btn btn-danger btn-sm btn-block">
                                        <i class="fas fa-gift mr-2"></i> {{trans('site.Remove_coupon')}}
                                    </button>
                                @else

                                    <button type="submit" class="btn btn-dark btn-sm btn-block">
                                        <i class="fas fa-gift mr-2"></i> {{trans('site.Apply_coupon')}}
                                    </button>
                                @endif

                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
