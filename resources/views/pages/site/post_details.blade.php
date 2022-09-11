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
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="postbox__wrapper postbox__details pr-20">
                        <div class="postbox__item transition-3 mb-70">
                            <div class="postbox__thumb m-img">
                                <div class="postbox__thumb postbox__slider swiper-container w-img p-relative">
                                    <div class="swiper-wrapper">
                                        @if($posts->media)

                                            @foreach($posts->media as $media)
                                                <div class="postbox__slider-item swiper-slide">
                                                    <img
                                                        src="{{asset('assets/images/admin/posts/'.$media->file_name)}}"
                                                        alt="{{$posts->title}}" width="760" height="405">
                                                </div>
                                            @endforeach

                                        @else
                                            <img src="{{asset('assets/images/noImage.jpg')}}"
                                                 alt="{{$posts->title}}">
                                        @endif

                                    </div>
                                    @if($posts->media->count() > 1)
                                        <div class="postbox-nav">
                                            <button class="postbox-slider-button-next"><i
                                                    class="fal fa-arrow-right"></i></button>
                                            <button class="postbox-slider-button-prev"><i class="fal fa-arrow-left"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="postbox__content">
                                <div class="postbox__meta">
                                    <span><i class="far fa-calendar-check"></i> {{$posts->created_at->format('M d, Y h:i A')}} </span>
                                    <span><a href="#"><i class="far fa-user"></i> {{$posts->created_by}}</a></span>
                                </div>
                                <h3 class="postbox__title">{{$posts->title}}</h3>
                                <div class="postbox__text mb-40">
                                    <p>{!! $posts->content !!}</p>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="blog__sidebar pl-70">

                        <div class="sidebar__widget mb-55">
                            <div class="sidebar__widget-head mb-35">
                                <h3 class="sidebar__widget-title">Recent posts</h3>
                            </div>
                            <div class="sidebar__widget-content">
                                <div class="rc__post-wrapper">


                                    @forelse(\App\Models\Backend\Post::whereStatus(true)->latest()->take(5)->orderBy('id','DESC')->get() as $post )
                                        <div class="rc__post d-flex align-items-start">
                                            <div class="rc__thumb mr-20">
                                                <a href="{{route('site.blog.post',$post->slug)}}">
                                                    @if($post->firstMedia)
                                                        <img
                                                            src="{{asset('assets/images/admin/posts/'.$post->firstMedia->file_name)}}"
                                                            width="60" height="60" alt="{{$post->title}}">
                                                    @else
                                                        <img src="{{asset('assets/images/noImage.jpg')}}" width="60" height="60"
                                                             alt="{{$post->title}}">
                                                    @endif

                                                </a>
                                            </div>
                                            <div class="rc__content">
                                                <div class="rc__meta">
                                                    <span>{{$post->created_at->format('M d, Y h:i A')}}</span>
                                                </div>
                                                <h6 class="rc__title"><a href="{{route('site.blog.post',$post->slug)}}">{{$post->title}}</a></h6>
                                            </div>
                                        </div>

                                    @empty
                                        <h5><span class="text-center">لم يتم العثور على بوستات في المدونة</span></h5>
                                    @endforelse

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
