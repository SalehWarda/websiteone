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
    <section class="breadcrumb__area include-bg pt-20 pb-20 breadcrumb__overlay" style="top: 100px; background: black;">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content text-center p-relative z-index-1">
                        <h3 class="breadcrumb__title">{{trans('site.My_Courses')}}</h3>
                        <div class="breadcrumb__list">
                            <span><a href="{{route('site.index')}}">{{trans('site.Home')}}</a></span>
                            <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                            <span>{{trans('site.My_Courses')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br>

    <!-- breadcrumb area end -->

    <!-- my course area start -->
    <section class="my__course pt-120 pb-90">
        <div class="container">
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="course__item-2 transition-3 white-bg mb-30 fix">
                            <div class="course__thumb-2 w-img fix">
                                <a href="{{route('course.videos',$course->id)}}">

                                    @if($course->firstMedia)
                                        <img
                                            src="{{asset('assets/images/admin/courses/'.$course->firstMedia->file_name)}}"
                                            width="320" height="220"
                                            alt="{{$course->name}}">

                                    @endif
                                </a>
                            </div>
                            <div class="course__content-2">
                                <div
                                    class="course__top-2 d-flex align-items-center justify-content-between">
                                    <div class="course__tag-2">
                                        <a href="#">{{$course->instructor}}</a>
                                    </div>

                                </div>
                                <h3 class="course__title-2">
                                    <a href="{{route('course.videos',$course->id)}}">{{$course->title}}</a>
                                </h3>
                                <div
                                    class="course__bottom-2 d-flex align-items-center justify-content-between">
                                    <div class="course__action">
                                        <ul>
                                            <li>
                                                <div
                                                    class="course__action-item d-flex align-items-center">
                                                    <div class="course__action-icon mr-5">
                                                                  <span>
                                                                   <i class="fa fa-money-check"></i>
                                                                  </span>
                                                    </div>

                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="course__lesson">
                                        <a href="#">
                                            <i class="fab fa-youtube"></i>
                                            {{$course->videos->count()}} {{trans('site.Lessons')}}
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="section__title-wrapper text-center mb-60">

                                <h2 class="section__title section__title-44">No Courses Found ....</h2>

                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
    <!-- my course area end -->

@endsection
