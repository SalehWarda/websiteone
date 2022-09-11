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

    <!-- contact area start -->
    <section class="contact__area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-7 col-xl-7 col-lg-6" data-aos="fade-left">

                    <div class="contact__wrapper">
                        <div class="section__title-wrapper mb-40">
                            <h2 class="section__title">{{trans('site.Get_in_touch')}}</h2>
                            <p>{{trans('site.Get_in_touch_bellow')}}.</p>
                        </div>

                        @include('partials.alert.alert')
                        <div class="contact__form">
                            <form action="{{route('site.contact_store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-md-6">
                                        <div class="contact__form-input">
                                            <input type="text" name="name" placeholder="{{trans('site.Your_Name')}}">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-md-6">
                                        <div class="contact__form-input">
                                            <input type="text" name="company"
                                                   placeholder="{{trans('site.Your_Company')}}">
                                            @error('company')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-md-6">
                                        <div class="contact__form-input">
                                            <input type="email" name="email" placeholder="{{trans('site.Your_Email')}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-md-6">
                                        <div class="contact__form-input">
                                            <input type="text" name="mobile"
                                                   placeholder="{{trans('site.Your_Mobile')}}">
                                            @error('mobile')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="contact__form-input">
                                            <input name="subject" type="text" placeholder="{{trans('site.Subject')}}">
                                            @error('subject')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="contact__form-input">
                                            <textarea name="message"
                                                      placeholder="{{trans('site.Enter_Your_Message')}}"></textarea>
                                            @error('message')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--                                    <div class="col-xxl-12">--}}
                                    {{--                                        <div class="contact__form-agree  d-flex align-items-center mb-20">--}}
                                    {{--                                            <input class="e-check-input" type="checkbox" id="e-agree">--}}
                                    {{--                                            <label class="e-check-label" for="e-agree">I agree to the<a href="#">Terms & Conditions</a></label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="col-xxl-12">
                                        <div class="contact__btn">
                                            <button type="submit"
                                                    class="tp-btn">{{trans('site.Send_Your_Message')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 offset-xxl-1 col-xl-4 offset-xl-1 col-lg-5 offset-lg-1" data-aos="fade-right">

                    <div class="contact__info white-bg p-relative z-index-1">
                        <div class="contact__shape">
                            <img class="contact-shape-1" src="{{asset('assets/site/img/contact/contact-shape-1.png')}}"
                                 alt="">
                            <img class="contact-shape-2" src="{{asset('assets/site/img/contact/contact-shape-2.png')}}"
                                 alt="">
                            <img class="contact-shape-3" src="{{asset('assets/site/img/contact/contact-shape-3.png')}}"
                                 alt="">
                        </div>
                        <div class="contact__info-inner white-bg">
                            <ul>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <svg class="map" viewBox="0 0 24 24">
                                                <path class="st0"
                                                      d="M21,10c0,7-9,13-9,13s-9-6-9-13c0-5,4-9,9-9S21,5,21,10z"/>
                                                <circle class="st0" cx="12" cy="10" r="3"/>
                                            </svg>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>{{trans('site.Address')}}</h4>
                                            <p>{{$about->address}}</p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <svg class="mail" viewBox="0 0 24 24">
                                                <path class="st0"
                                                      d="M4,4h16c1.1,0,2,0.9,2,2v12c0,1.1-0.9,2-2,2H4c-1.1,0-2-0.9-2-2V6C2,4.9,2.9,4,4,4z"/>
                                                <polyline class="st0" points="22,6 12,13 2,6 "/>
                                            </svg>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>{{trans('site.Email_us_directly')}}</h4>
                                            <p><a href="mailto:{{$about->email}}">{{$about->email}}</a></p>

                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <svg class="call" viewBox="0 0 24 24">
                                                <path class="st0"
                                                      d="M22,16.9v3c0,1.1-0.9,2-2,2c-0.1,0-0.1,0-0.2,0c-3.1-0.3-6-1.4-8.6-3.1c-2.4-1.5-4.5-3.6-6-6  c-1.7-2.6-2.7-5.6-3.1-8.7C2,3.1,2.8,2.1,3.9,2C4,2,4.1,2,4.1,2h3c1,0,1.9,0.7,2,1.7c0.1,1,0.4,1.9,0.7,2.8c0.3,0.7,0.1,1.6-0.4,2.1  L8.1,9.9c1.4,2.5,3.5,4.6,6,6l1.3-1.3c0.6-0.5,1.4-0.7,2.1-0.4c0.9,0.3,1.8,0.6,2.8,0.7C21.3,15,22,15.9,22,16.9z"/>
                                            </svg>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>{{trans('site.Phone')}}</h4>
                                            <p><a href="tel:{{$about->mobile}}">{{$about->mobile}}</a></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="contact__social pl-30">
                                <h4>{{trans('site.Follow_Me')}}</h4>
                                <ul>
                                    @foreach($socials as $social)
                                        <li><a href="{{$social->link}}" style="display: inline-block;
    width: 29px;
    height: 33px;
    line-height: 35px;
    text-align: center;
    font-size: 16px;
    color: var(--tp-common-black);
    background: #ffffff;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -o-border-radius: 4px;
    -ms-border-radius: 4px;
    border-radius: 20px;"><i class="fa-brands fa-{{$social->name}}"></i></a></li>

                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact area end -->

@endsection
@section('scripts')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
