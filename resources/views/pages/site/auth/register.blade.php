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
{{--            <img class="man-1" src="{{asset('assets/site/img/icon/sign/man-3.png')}}" alt="">--}}
{{--            <img class="man-2 man-22" src="{{asset('assets/site/img/icon/sign/man-2.png')}}" alt="">--}}
{{--            <img class="circle" src="{{asset('assets/site/img/icon/sign/circle.png')}}" alt="">--}}
{{--            <img class="zigzag" src="{{asset('assets/site/img/icon/sign/zigzag.png')}}" alt="">--}}
{{--            <img class="dot" src="{{asset('assets/site/img/icon/sign/dot.png')}}" alt="">--}}
{{--            <img class="bg" src="{{asset('assets/site/img/icon/sign/sign-up.png')}}" alt="">--}}
{{--            <img class="flower" src="{{asset('assets/site/img/icon/sign/flower.png')}}" alt="">--}}
{{--        </div>--}}
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h3 class="section__title">{{trans('site/register.Register_a_new_user')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="sign__wrapper white-bg">
                        <div class="sign__form">
                            <form action="{{route('site.register.user')}}" method="post">
                                @csrf
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/register.First_name')}}</h5>
                                    <div class="sign__input">
                                        <input name="first_name" type="text" value="{{old('first_name')}}" placeholder="{{trans('site/register.First_name')}}">
                                        <i class="fal fa-user"></i>
                                        @error('first_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/register.Last_name')}}</h5>
                                    <div class="sign__input">
                                        <input name="last_name" type="text" value="{{old('last_name')}}" placeholder="{{trans('site/register.Last_name')}}">
                                        <i class="fal fa-user"></i>
                                        @error('last_name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/register.User_name')}}</h5>
                                    <div class="sign__input">
                                        <input name="username" type="text" value="{{old('username')}}" placeholder="{{trans('site/register.User_name')}}">
                                        <i class="fal fa-user"></i>
                                        @error('username')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/register.Email')}}</h5>
                                    <div class="sign__input">
                                        <input name="email" type="email" value="{{old('email')}}" placeholder="{{trans('site/register.Email')}}">
                                        <i class="fal fa-envelope"></i>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/register.Mobile')}}</h5>
                                    <div class="sign__input">
                                        <input name="mobile" type="text" value="{{old('mobile')}}" placeholder="{{trans('site/register.Mobile')}}">
                                        <i class="fal fa-mobile"></i>
                                        @error('mobile')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>{{trans('site/register.Password')}}</h5>
                                    <div class="sign__input">
                                        <input name="password" id="id_password" type="password" placeholder="{{trans('site/register.Password')}}">
                                        <i class="fal fa-lock"></i>
                                        <i class="far fa-eye" id="togglePassword" style="margin-right: 290px; cursor: pointer;"></i>

                                        @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-10">
                                    <h5>{{trans('site/register.Confirm_password')}}</h5>
                                    <div class="sign__input">
                                        <input type="password" id="id_passwordC" name="password_confirmation" placeholder="{{trans('site/register.Confirm_password')}}">
                                        <i class="fal fa-lock"></i>
                                        <i class="far fa-eye" id="toggleconfirm" style="margin-right: 290px; cursor: pointer;"></i>

                                        @error('password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="sign__action d-flex justify-content-between mb-30">--}}
{{--                                    <div class="sign__agree d-flex align-items-center">--}}
{{--                                        <input class="m-check-input" type="checkbox" id="m-agree">--}}
{{--                                        <label class="m-check-label" for="m-agree">I agree to the <a href="#">Terms & Conditions</a>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <button type="submit" class="tp-btn w-100"> <span></span> {{trans('site/register.Register')}}</button>
                                <div class="sign__new text-center mt-20">
                                    <p>{{trans('site/register.Do_you_have_an_account?')}} <a href="{{route('site.login')}}"> {{trans('site/register.Login')}}</a></p>
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
    <script>
        const toggleconfirm = document.querySelector('#toggleconfirm');
        const passwordc = document.querySelector('#id_passwordC');

        toggleconfirm.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = passwordc.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordc.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
