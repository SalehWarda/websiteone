@extends('layouts.app')

@section('style')

    <style>
        p {
            word-wrap: break-word;
        }
    </style>
@endsection
@section('content')

    <!-- course area start -->
    <section class="course__area pt-115 pb-90 grey-bg-3">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="section__title-wrapper text-center mb-60">
                        <span class="section__title-pre">{{trans('site.Top_Courses')}}</span>
                        <h2 class="section__title section__title-44">{{trans('site.My_Special_Courses')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12">

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="course__tab-conent">
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade show active" id="grid" role="tabpanel"
                                         aria-labelledby="grid-tab">
                                        <div class="row">
                                            @forelse($courses as $course)
                                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                    <div class="course__item-2 transition-3 white-bg mb-30 fix">
                                                        <div class="course__thumb-2 w-img fix">
                                                            <a href="{{route('site.course-details',$course->slug)}}">

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
                                                                <a href="{{route('site.course-details',$course->slug)}}">{{$course->title}}</a>
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
                                                                                <div class="course__price-2">
                                                                                    <span>{{trans('site.SR')}} {{$course->price}}</span>
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
                                                <div class="align-center">
                                                    {!! $courses->appends(request()->all())->links() !!}
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- course area end -->

@endsection
