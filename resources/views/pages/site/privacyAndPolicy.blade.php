@extends('layouts.app')

@section('style')

    <style>
        p {
            word-wrap: break-word;
        }
    </style>
@endsection
@section('content')

    <!-- blog area start -->
    <section class="blog__area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12">
                    <div class="postbox__wrapper postbox__details pr-20">
                        <div class="postbox__item transition-3 mb-70">
                            <div class="postbox__thumb m-img">
                                <div class="postbox__thumb postbox__slider swiper-container w-img p-relative">


                                </div>
                            </div>
                            <div class="postbox__content">
                                <div class="postbox__meta">
                                    <span><i class="far fa-calendar-check"></i> {{$privacyP->updated_at->format('M d, Y ')}} </span>
                                </div>
                                <h3 class="postbox__title">{{trans('privacy_policy.Privacy_Policy')}}</h3>
                                <div class="postbox__text mb-40">
                                    <p>{!! $privacyP->privacy_policy !!}</p>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- blog area end -->

@endsection
