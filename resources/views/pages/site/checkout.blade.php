@extends('layouts.app')

@section('style')

    <style>
        p {
            word-wrap: break-word;
        }
    </style>

@endsection
@section('content')




    <!-- coupon-area start -->
    <section class="coupon-area pt-120 pb-30">
        <div class="container">
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="coupon-accordion">--}}
{{--                        <!-- ACCORDION START -->--}}
{{--                        <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>--}}
{{--                        <div id="checkout-login" class="coupon-content">--}}
{{--                            <div class="coupon-info">--}}
{{--                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est--}}
{{--                                    sit amet ipsum luctus.</p>--}}
{{--                                <form action="#">--}}
{{--                                    <p class="form-row-first">--}}
{{--                                        <label>Username or email <span class="required">*</span></label>--}}
{{--                                        <input type="text">--}}
{{--                                    </p>--}}
{{--                                    <p class="form-row-last">--}}
{{--                                        <label>Password <span class="required">*</span></label>--}}
{{--                                        <input type="text">--}}
{{--                                    </p>--}}
{{--                                    <p class="form-row">--}}
{{--                                        <button class="tp-btn" type="submit">Login</button>--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox">--}}
{{--                                            Remember me--}}
{{--                                        </label>--}}
{{--                                    </p>--}}
{{--                                    <p class="lost-password">--}}
{{--                                        <a href="#">Lost your password?</a>--}}
{{--                                    </p>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- ACCORDION END -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="coupon-accordion">--}}
{{--                        <!-- ACCORDION START -->--}}
{{--                        <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>--}}
{{--                        <div id="checkout_coupon" class="coupon-checkout-content">--}}
{{--                            <div class="coupon-info">--}}
{{--                                <form action="#">--}}
{{--                                    <p class="checkout-coupon">--}}
{{--                                        <input type="text" placeholder="Coupon Code">--}}
{{--                                        <button class="tp-btn" type="submit">Apply Coupon</button>--}}
{{--                                    </p>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- ACCORDION END -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    <!-- coupon-area end -->

    <!-- checkout-area start -->
    <section class="checkout-area pb-85">
        <div class="container">

               <livewire:site.checkout-component/>
        </div>
    </section>
    <!-- checkout-area end -->



@endsection
