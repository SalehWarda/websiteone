@extends('layouts.app')

@section('style')

    <style>
        p{
            word-wrap:break-word;
        }
    </style>
@endsection
@section('content')



    <!-- sign up area start -->
    <section class="signup__area p-relative z-index-1 pt-100 pb-145">
{{--        <div class="sign__shape">--}}
{{--            <img class="man-1" src="{{asset('assets/site/img/icon/sign/man-1.png')}}" alt="">--}}
{{--            <img class="man-2" src="{{asset('assets/site/img/icon/sign/man-2.png')}}" alt="">--}}
{{--            <img class="circle" src="{{asset('assets/site/img/icon/sign/circle.png')}}" alt="">--}}
{{--            <img class="zigzag" src="{{asset('assets/site/img/icon/sign/zigzag.png')}}" alt="">--}}
{{--            <img class="dot" src="{{asset('assets/site/img/icon/sign/dot.png')}}" alt="">--}}
{{--            <img class="bg" src="{{asset('assets/site/img/icon/sign/sign-up.png')}}" alt="">--}}
{{--        </div>--}}
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">{{trans('site/login.Sign_in')}}</h2>
                        <p>{{trans('site/login.If_you_do_not_have_an_account_you_can')}} <a href="{{route('site.register')}}" class="text-primary">{{trans('site/login.Register_here!')}}</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="sign__wrapper white-bg">

                        @include('partials.alert.alert')
                        <div class="sign__form">
                            <form action="{{route('site.login.user')}}" method="post">
                                @csrf
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/login.User_name')}}</h5>
                                    <div class="sign__input">
                                        <input name="username" type="text" value="{{old('username')}}" placeholder="{{trans('site/login.User_name')}}">
                                        <i class="fal fa-user"></i>
                                       @error('username')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-10">
                                    <h5>{{trans('site/login.Password')}}</h5>
                                    <div class="sign__input">
                                        <input name="password" id="id_password" type="password" placeholder="{{trans('site/login.Password')}}">

                                        <i class="fal fa-lock"></i>
                                        <i class="far fa-eye" id="togglePassword" style="margin-right: 280px; cursor: pointer;"></i>
                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="sign__action d-sm-flex justify-content-between mb-30">
                                    <div class="sign__agree d-flex align-items-center">
                                        <input class="m-check-input" type="checkbox" id="m-agree">
                                        <label class="m-check-label" for="m-agree">{{trans('site/login.Remember_me')}}
                                        </label>
                                    </div>
                                    <div class="sign__forgot">
                                        <a href="#">{{trans('site/login.Did_you_forget_your_password?')}}</a>
                                    </div>
                                </div>
                                <button type="submit" class="tp-btn  w-100"> <span></span> {{trans('site/login.Login')}}</button>
                                <div class="sign__new text-center mt-20">
                                    <p>{{trans('site/login.New_user?')}} <a href="{{route('site.register')}}">{{trans('site/login.Register_here!')}}</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign up area end -->

@endsection
@section('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

@endsection
