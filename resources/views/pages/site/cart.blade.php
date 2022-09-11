@extends('layouts.app')

@section('style')

    <style>
        p {
            word-wrap: break-word;
        }
    </style>

@endsection
@section('content')





    <!-- cart-area start -->
    <section class="cart-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">{{trans('site.Image')}}</th>
                                    <th class="cart-product-name">{{trans('site.Product')}}</th>
                                    <th class="product-price">{{trans('site.Price')}}</th>

                                    <th class="product-subtotal">{{trans('site.TOTAL')}}</th>
                                    <th class="product-remove">{{trans('site.Remove')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                                  <livewire:site.cart-item-component :item="$item->rowId" :key="$item->rowId"/>
                                @empty

                                    <tr>
                                        <td class="pl-0 border-light" colspan="6">
                                            <p class="text-center">لا يوجد طلبات في السلة.</p>
                                        </td>

                                    </tr>
                                @endforelse


                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                    <livewire:site.cart-total-componant/>

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- cart-area end -->



@endsection
