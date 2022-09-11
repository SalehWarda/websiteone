@extends('layouts.app')

@section('style')

    <style>
        p{
            word-wrap:break-word;
        }
    </style>
@endsection
@section('content')


    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-150 pb-150 breadcrumb__overlay" data-background="assets/img/breadcrumb/breadcrumb-bg-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content text-center p-relative z-index-1">
                        <h3 class="breadcrumb__title">{{trans('site.My_profile')}}</h3>
                        <div class="breadcrumb__list">
                            <span><a href="{{route('site.index')}}">{{trans('site.Home')}}</a></span>
                            <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                            <span>{{trans('site.My_profile')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- profile area start -->
    <section class="profile__area pt-120 pb-50 grey-bg-2">
        <div class="container">
            <div class="profile__basic-inner pb-20 white-bg">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-md-6">
                        <div class="profile__basic d-md-flex align-items-center">
                            <div class="profile__basic-thumb mr-30">
                                @if (auth()->user()->user_image != '')
                                    <img src="{{ asset('assets/images/customer/' . auth()->user()->user_image) }}" alt="{{ auth()->user()->full_name }}" class="img-thumbnail" width="120">

                                @else
                                    <img src="{{ asset('assets/images/customer/avatar.png') }}" alt="{{ auth()->user()->full_namee }}" class="img-thumbnail" width="120">
                                @endif

                            </div>
                            <div class="profile__basic-content">
                                <h3 class="profile__basic-title">
                                    {{trans('site.Welcome_back')}} <span>{{auth()->user()->full_namee}}</span>
                                </h3>
                                <p>({{$courses->count()}}) {{trans('site.My_Courses')}} <a href="{{route('customer.courses')}}">{{trans('site.View_Course')}}</a></p>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-xxl-6 col-md-6">--}}
{{--                        <div class="profile__basic-cart d-flex align-items-center justify-content-md-end">--}}
{{--                            <div class="cart-info mr-10">--}}
{{--                                <a href="cart.html">{{trans('site.View_Cart')}}</a>--}}
{{--                            </div>--}}
{{--                            <div class="cart-item">--}}
{{--                                <a href="cart.html">--}}
{{--                                    <i class="fa-regular fa-basket-shopping"></i>--}}
{{--                                    <span class="cart-quantity">2</span>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <!-- profile area end -->

    <!-- profile menu area start -->
    <section class="profile__menu pb-70 grey-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-md-4">
                    <div class="profile__menu-left white-bg mb-50">
                        <h3 class="profile__menu-title"><i class="fa-regular fa-square-list"></i> {{trans('site.Your_menu')}}</h3>
                        <div class="profile__menu-tab">
                            <div class="nav nav-tabs flex-column justify-content-start text-start" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-account-tab" data-bs-toggle="tab" data-bs-target="#nav-account" type="button" role="tab" aria-controls="nav-account" aria-selected="true"> <i class="fa-regular fa-user"></i> {{trans('site.My_account')}}</button>
                                <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order" type="button" role="tab" aria-controls="nav-order" aria-selected="false"><i class="fa-regular fa-file-lines"></i>{{trans('site.Orders')}}</button>
{{--                                <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa-regular fa-lock"></i>Change Password</button>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-md-8">
                    <div class="profile__menu-right">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
                                <div class="profile__info">

                                    <div class="profile__info-top d-flex justify-content-between align-items-center">
                                        <h3 class="profile__info-title">{{trans('site.Profile_Information')}}</h3>
                                        <button class="profile__info-btn" type="button" data-bs-toggle="modal" data-bs-target="#profile_edit_modal{{auth()->user()->id}}"><i class="fa-regular fa-pen-to-square"></i> {{trans('site.Edit_profile')}}</button>
                                    </div>

                                    <div class="profile__info-wrapper white-bg">
                                        <div class="profile__info-item">
                                            <p>{{trans('site.First_name')}}</p>
                                            <h4>{{auth()->user()->first_name}}</h4>
                                        </div>
                                        <div class="profile__info-item">
                                            <p>{{trans('site.Last_name')}}</p>
                                            <h4>{{auth()->user()->last_name}}</h4>
                                        </div>
                                        <div class="profile__info-item">
                                            <p>{{trans('site.User_name')}}</p>
                                            <h4>{{auth()->user()->username}}</h4>
                                        </div>
                                        <div class="profile__info-item">
                                            <p>{{trans('site.Email')}}</p>
                                            <h4>{{auth()->user()->email}}</h4>
                                        </div>
                                        <div class="profile__info-item">
                                            <p>{{trans('site.Mobile')}}</p>
                                            <h4>{{auth()->user()->mobile}}</h4>
                                        </div>
                                        <div class="profile__info-item">
                                            <p>{{trans('site.Status')}}</p>
                                            <h4>{{auth()->user()->status()}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                                <div class="order__info">

                                    <livewire:site.customer.order/>

                                </div>
                            </div>
{{--                            <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">--}}
{{--                                <div class="password__change">--}}
{{--                                    <div class="password__change-top">--}}
{{--                                        <h3 class="password__change-title">Change Password</h3>--}}
{{--                                    </div>--}}
{{--                                    <div class="password__form white-bg">--}}
{{--                                        <form action="#">--}}
{{--                                            <div class="password__input">--}}
{{--                                                <p>Old Password</p>--}}
{{--                                                <input type="password" placeholder="Enter Old Password">--}}
{{--                                            </div>--}}
{{--                                            <div class="password__input">--}}
{{--                                                <p>New Password</p>--}}
{{--                                                <input type="password" placeholder="Enter New Password">--}}
{{--                                            </div>--}}
{{--                                            <div class="password__input">--}}
{{--                                                <p>Confirm Password</p>--}}
{{--                                                <input type="password" placeholder="Confirm Password">--}}
{{--                                            </div>--}}
{{--                                            <div class="password__input">--}}
{{--                                                <button type="submit" class="tp-btn">Update password</button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- profile menu area end -->

    <div class="profile__edit-modal">
        <!-- Modal -->
        <div class="modal fade" id="profile_edit_modal{{auth()->user()->id}}" tabindex="-1" aria-labelledby="profile_edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="profile__edit-wrapper">
                        <div class="profile__edit-close">
                            <button type="button" class="profile__edit-close-btn" data-bs-toggle="modal" data-bs-target="#course_enroll_modal"><i class="fa-light fa-xmark"></i></button>
                        </div>
                        <form action="{{ route('customer.update_profile') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('patch')
                            <div class="col-lg-12 text-center mb-4">
                                @if (auth()->user()->user_image != '')
                                    <img src="{{ asset('assets/images/customer/' . auth()->user()->user_image) }}" alt="{{ auth()->user()->full_name }}" class="img-thumbnail" width="120">
                                    <div class="mt-2">
                                        <a href="{{ route('customer.remove_profile_image') }}" class="btn btn-sm btn-outline-danger">Remove image</a>
                                    </div>
                                @else
                                    <img src="{{ asset('assets/images/customer/avatar.png') }}" alt="{{ auth()->user()->full_namee }}" class="img-thumbnail" width="120">
                                @endif
                            </div>
                            <div class="profile__edit-input">
                                <p>{{trans('site.First_name')}}</p>
                                <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" placeholder="Your First Name">
                                @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="profile__edit-input">
                                <p>{{trans('site.Last_name')}}</p>
                                <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" placeholder="Your Last Name">
                                @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="profile__edit-input">
                                <p>{{trans('site.Email')}}</p>
                                <input name="email" type="email" value="{{ old('email', auth()->user()->email) }}" placeholder="e.g. Jason@example.com" >
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="profile__edit-input">
                                <p>{{trans('site.Mobile')}}</p>
                                <input name="mobile" type="tel"  value="{{ old('mobile', auth()->user()->mobile) }}" placeholder="e.g. 966512345678">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="profile__edit-input">
                                <p>{{trans('site/login.Password')}}<small class="ml-auto text-danger"> ({{trans('site.Optional')}})</small></p>
                                <input name="password" type="password" >
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="profile__edit-input">
                                <p>{{trans('site/register.Confirm_password')}}<small class="ml-auto text-danger"> ({{trans('site.Optional')}})</small></p>
                                <input name="password_confirmation" type="password" >
                                @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="profile__edit-input">
                                <input  type="file" class="form-control" id="customFile" name="user_image">
                                @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="profile__edit-input">
                                <button type="submit" class="tp-btn w-100">{{trans('site.Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
