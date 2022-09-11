@extends('layouts.app')

@section('style')

    <style>
        p {
            word-wrap: break-word;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

@endsection
@section('content')

    <!-- event area start -->
    <section class="event__area pt-115 p-relative">
        {{--        <div class="page__title-shape">--}}
        {{--            <img class="page-title-shape-5 d-none d-sm-block" src="{{asset('assets/site/img/breadcrumb/page-title-shape-1.png')}}" alt="">--}}
        {{--            <img class="page-title-shape-6" src="{{asset('assets/site/img/breadcrumb/page-title-shape-2.png')}}" alt="">--}}
        {{--            <img class="page-title-shape-7" src="{{asset('assets/site/img/breadcrumb/page-title-shape-4.png')}}" alt="">--}}
        {{--            <img class="page-title-shape-8" src="{{asset('assets/site/img/breadcrumb/page-title-shape-5.png')}}" alt="">--}}
        {{--        </div>--}}
        <div class="container" data-aos="fade-right">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-8">
                            <div class="event__wrapper">
                                <div class="page__title-content mb-25">
                                    <div class="breadcrumb__list breadcrumb__list-2 mb-10">
                                        <span><a href="{{route('site.index')}}">{{trans('site.Home')}}</a></span>
                                        <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                        <span>{{trans('site.Services')}}</span>
                                    </div>
                                    <h5 class="breadcrumb__title-2">{{$service->name}}</h5>
                                </div>
                                <div class="course__meta-2 d-sm-flex align-items-center mb-30">
                                    <div class="course__update mr-80 mb-30">
                                        <h5>{{trans('site.Created_at')}}:</h5>
                                        <p>{{$service->created_at->format('M d, Y h:i A')}}</p>
                                    </div>
                                    <div class="course__update mr-80 mb-30">
                                        <h5>{{trans('site.Last_Update')}}:</h5>
                                        <p>{{$service->updated_at->format('M d, Y h:i A')}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
    </section>
    <!-- event area end -->

    <!-- event details area start -->
    <section class="event__area pb-110">
        <div class="container" data-aos="fade-right">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="event_wrapper">
                        <div class="postbox__thumb postbox__slider swiper-container w-img p-relative">
                            <div class="swiper-wrapper">
                                @if($service->media)

                                    @foreach($service->media as $media)
                                        <div class="postbox__slider-item swiper-slide">
                                            <img
                                                src="{{asset('assets/images/admin/services/'.$media->file_name)}}"
                                                alt="{{$service->name}}" width="760" height="405">
                                        </div>
                                    @endforeach

                                @else
                                    <img src="{{asset('assets/images/noImage.jpg')}}"
                                         alt="{{$service->name}}">
                                @endif

                            </div>
                            @if($service->media->count() > 1)
                                <div class="postbox-nav">
                                    <button class="postbox-slider-button-next"><i class="fal fa-arrow-right"></i>
                                    </button>
                                    <button class="postbox-slider-button-prev"><i class="fal fa-arrow-left"></i>
                                    </button>
                                </div>
                            @endif

                        </div>
                        <br>
                        <div class="event__details mb-35">
                            <h3>{{trans('site.Service_Description')}}</h3>
                            <p> {!! $service->description !!}</p>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6">

                    <livewire:admin.services.answers-questions-component :service="$service"/>


                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
