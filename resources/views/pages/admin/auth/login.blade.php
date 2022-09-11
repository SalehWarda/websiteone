@extends('layouts.login')

@section('title')

    تسجيل الدخول

@endsection
@section('content')

    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">

                <div class="text-center mt-4">
                    <div class="mb-3">
                        <a href="index.html" class="auth-logo">
                            <img src="{{asset('assets/images/hulla.jpeg')}}" height="60" class="logo-dark mx-auto" alt="">
                            <img src="{{asset('assets/images/hulla.jpeg')}}" height="60" class="logo-light mx-auto" alt="">
                        </a>
                    </div>
                </div>

                <h4 class="text-muted text-center font-size-18"><b>تسجيل الدخول</b></h4>

                @include('partials.alert.alert')

                <div class="p-3">
                    <form class="form-horizontal mt-3" action="{{route('admin.login')}}" method="post">

                        @csrf
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="email" name="email" placeholder="البريد الإلكتروني">
                                @error('email')
                                   <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control" type="password" name="password" placeholder="كلمة المرور">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="form-label ms-1" for="customCheck1">تذكرني</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">دخول</button>
                            </div>
                        </div>

{{--                        <div class="form-group mb-0 row mt-2">--}}
{{--                            <div class="col-sm-7 mt-3">--}}
{{--                                <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> هل نسيت كلمة المرور ؟</a>--}}
{{--                            </div>--}}

{{--                        </div>--}}
                    </form>
                </div>
                <!-- end -->
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->
    </div>

@endsection
