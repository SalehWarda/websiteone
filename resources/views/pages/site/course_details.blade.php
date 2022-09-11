@extends('layouts.app')

@section('style')

    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet"/>
    <style>
        p {
            word-wrap: break-word;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

@endsection

@section('content')

    <!-- course area start -->
    <section class="course__area pt-115 pb-90">
        <div class="container" >
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8" >
                    <div class="course__wrapper">
                        <div class="page__title-content mb-25 ">
                            <div class="breadcrumb__list breadcrumb__list-2 mb-10">
                                <span><a href="{{route('site.index')}}">{{trans('site.Home')}}</a></span>
                                <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                <span>{{trans('site.Courses')}}</span>
                            </div>
                            <h5 class="breadcrumb__title-2">{{$course->title}}</h5>
                        </div>
                        <div class="course__meta-2 d-sm-flex align-items-center mb-30">
                            <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                                <div class="course__teacher-thumb-3 mr-15">

                                </div>
                                <div class="course__teacher-info-3">
                                    <h5>{{trans('site.Instructor')}}</h5>
                                    <p><a href="#">{{$course->instructor}}</a></p>
                                </div>
                            </div>
                            <div class="course__update mr-80 mb-30">
                                <h5>{{trans('site.Last_Update')}}:</h5>
                                <p>{{$course->updated_at->format('M d, Y')}}</p>
                            </div>

                            <div class="course__update mr-80 mb-30">
                                <h5>{{trans('site.Created_at')}}:</h5>
                                <p>{{$course->created_at->format('M d, Y')}}</p>
                            </div>
                        </div>
                        
                        <div class="course__img w-img mb-30">

                            @if($course->videos)

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <p><strong>There is no introductory video for this course yet.</strong></p>

                                        </div>
                                    </div>
                                </div>
                            
                            @else
                            
                                <div class="container-fluid" >

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="video-container">
                                                <div class="video-container"
                                                     style="width: 100%;
                                                                                    height: 350px;
                                                                                    position: relative;">
                                                    <video controls preload="auto" id="yt-video"
                                                           class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered"
                                                           data-setup='{"fluid": true}'>
                                                        <source
                                                            src="{{ asset('videos/'. $course->videos[0]->uid . '/' . $course->videos[0]->processed_file)}}"
                                                            type="application/x-mpegURL"/>
                                                        <p class="vjs-no-js">
                                                            To view this video please enable JavaScript, and
                                                            consider upgrading to a
                                                            web browser that
                                                            <a href="https://videojs.com/html5-video-support/"
                                                               target="_blank">supports HTML5
                                                                video</a>
                                                        </p>
                                                    </video>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        </div>

                        <div class="course__tab-2 mb-45">
                            <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true"><i class="fa-regular fa-medal"></i> <span>{{trans('site.Course_Description')}}</span> </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false"><i class="fa-regular fa-book-blank"></i> <span>{{trans('site.Course_Content')}}</span> </button>
                                </li>


                            </ul>
                        </div>
                        <div class="course__tab-content mb-95">
                            <div class="tab-content" id="courseTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <div class="course__description">
                                        <h3>{{trans('site.Course_Description')}}</h3>
                                        <p>{!! $course->description !!} </p>


                                    </div>
                                </div>
                                <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                                    <div class="course__curriculum">
                                        <div class="accordion" id="course__accordion">
                                            <div class="accordion-item mb-50">
                                                <h2 class="accordion-header" id="week-01">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#week-01-content" aria-expanded="true" aria-controls="week-01-content">
                                                        {{trans('site.Course_Content')}}
                                                    </button>
                                                </h2>
                                                <div id="week-01-content" class="accordion-collapse collapse show" aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                    <div class="accordion-body">

                                                        @foreach($course->videos as $video)
                                                            <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                <div class="course__curriculum-info">

                                                                    <h3> <i class="fa fa-video-handheld"></i> <span>({{$loop->iteration}}) <strong>{{ $video->title}} :</strong> </span> {!!  $video->description !!}</h3>
                                                                </div>
                                                                <div class="course__curriculum-meta">
                                                                    <span class="time"> <i class="icon_clock_alt"></i> {{$video->duration}}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach

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
                <div class="col-xxl-4 col-xl-4 col-lg-4" >
                    <div class="course__sidebar pl-70 p-relative">
                        <div class="course__shape">
                            <img class="course-dot" src="{{asset('assets/img/course/course-dot.png')}}" alt="">
                        </div>
                        <div class="course__sidebar-widget-2 white-bg mb-20">
                            <livewire:site.course-details-component :course="$course" />

                        </div>
                        <div class="course__sidebar-widget-2 white-bg mb-20">
                            <div class="course__sidebar-course">
                                <h3 class="course__sidebar-title">{{trans('site.Related_courses')}}</h3>
                                <ul>
                                    @forelse(\App\Models\Backend\Course::latest()->whereStatus(true)->take(5)->orderBy('id', 'DESC')->get() as $course )
                                    <li>
                                        <div class="course__sm d-flex align-items-center mb-30">
                                            <div class="course__sm-thumb mr-20">
                                                <a href="{{route('site.course-details',$course->slug)}}">
                                                    @if($course->firstMedia)
                                                        <img
                                                            src="{{asset('assets/images/admin/courses/'.$course->firstMedia->file_name)}}"
                                                            width="60" height="60" alt="{{$course->title}}">
                                                    @else
                                                        <img src="{{asset('assets/images/noImage.jpg')}}" width="60" height="60"
                                                             alt="{{$course->title}}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="course__sm-content">

                                                <h5><a href="{{route('site.course-details',$course->slug)}}">{{$course->title}}</a></h5>
                                                <div class="course__sm-price">
                                                    <span>{{trans('site.SR')}} {{$course->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                        <h5><span class="text-center">لم يتم العثور على دورات </span></h5>
                                    @endforelse

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- course area end -->




@endsection
@section('scripts')
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
