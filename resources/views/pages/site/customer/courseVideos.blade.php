@extends('layouts.app')

@section('style')

    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet"/>
    <style>

        .rotate-0 :before{
            content: 'R';
        }

        .rotate-90 :before{
            content: '90°';
        }

        .rotate-180 :before{
            content: '180°';
        }

        .rotate-270 :before{
            content: '270°';
        }
        .video-js .vjs-time-control {
            display: block;
        }
        .video-js .vjs-remaining-time {
            display: none;
        }
    </style>
@endsection
@section('content')

    <!-- breadcrumb area start -->

    <!-- blog area start -->
    <section class="blog__area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="course__wrapper">

                    @if($course->videos[0] )

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="video-container">
                                        <div class="video-container" >
                                            <video controls preload="auto" id="yt-video"
                                                   class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered"
                                                   data-setup="{}"
                                                   style="
                                                          position: relative;"
                                            >
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
                            <br>


                            <div class="page__title-content mb-10 ml-30">

                                <div class="course__meta-2 d-sm-flex align-items-center mb-10">
                                    <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">

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
                                <h3 class="breadcrumb__title-2">{{$course->title}}</h3>
                            </div>
                            <div class="course__tab-content mb-95">
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="course__description">
                                            <h3 class="ml-30">{{trans('site.Course_Description')}}:</h3>
                                            <p>{!! $course->description !!}</p>

                                        </div>
                                    </div>

                                </div>
                            </div>
                    @else

                    @endif

                    </div>
                </div>


                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="blog__sidebar pl-70">

                        <div class="sidebar__widget mb-55">
                            <div class="sidebar__widget-head mb-35">
                                <h3 class="sidebar__widget-title">{{trans('site.Course_Content')}}</h3>
                            </div>
                            <div class="sidebar__widget-content ">
                                <div class="rc__post-wrapper ">


                                    @forelse($course->videos->where('visibility','public') as $video )
                                        <div class="rc__post d-flex align-items-start mb-5">

                                            <div class="rc__title mr-20 mt-20"><a
                                                    href="{{route('videos',[$course->id,$video->id])}}">{{$loop->iteration}}</a><br>
{{--                                                <i class="fa fa-play"></i>--}}
                                            </div>
                                            <div class="rc__thumb mr-20" style="position: relative;">
                                                <a href="{{route('videos',[$course->id,$video->id])}}">
                                                    @if($video->thumbnail)
                                                        <img
                                                            src="{{asset($video->thumbnail)}}"
                                                            width="60" height="60" alt="{{$video->title}}">
                                                        <div class="badge bg-dark" style="position: absolute; bottom:1px; right:20px;">
                                                            {{$video->duration}}</div>                                                    @else
                                                        <img src="{{asset('assets/images/noImage.jpg')}}" width="60"
                                                             height="60"
                                                             alt="{{$video->title}}">
                                                        <div class="badge bg-dark" style="position: absolute; bottom:1px; right:20px;">
                                                            {{$video->duration}}</div>
                                                    @endif

                                                </a>
                                            </div>
                                            <div class="rc__content">
                                                <div class="rc__meta">
                                                    <span>{{$video->created_at->format('M d, Y h:i A')}}</span>
                                                </div>
                                                <h6 class="rc__title"><a
                                                        href="{{route('videos',[$course->id,$video->id])}}">{{$video->title}}</a><br>

                                                </h6>

                                            </div>
                                        </div>

                                    @empty
                                        <h5><span class="text-center">لم يتم العثور على فيديوهات</span></h5>
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

@section('scripts')
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>

    <script>
        var Player = (function(window, videojs) {
            var rotateBtn = videojs.extend(videojs.getComponent("Button"), {
                constructor: function(player) {
                    videojs.getComponent("Button").apply(this, arguments);
                    this.controlText("Rotate");
                    this.rotate = 0;
                    this.player = player;
                },
                handleClick: function() {
                    this.removeClass("rotate-" + this.rotate);
                    this.rotate += 90;
                    zoom = this.rotate % 180 === 0 ? 1 : 0.5;
                    this.rotate = this.rotate % 360 || 0;
                    this.player.zoomrotate({ rotate: this.rotate, zoom: zoom });
                    this.addClass("rotate-" + this.rotate);
                },
                buildCSSClass: function() {
                    return "rotate-0 vjs-control vjs-button";
                }
            });
            var zoomrotatePlugin = function(settings) {
                var defaults, extend;
                defaults = {
                    zoom: 1,
                    rotate: 0
                };
                extend = function() {
                    var args, target, i, object, property;
                    args = Array.prototype.slice.call(arguments);
                    target = args.shift() || {};
                    for (i in args) {
                        object = args[i];
                        for (property in object) {
                            if (object.hasOwnProperty(property)) {
                                if (typeof object[property] === "object") {
                                    target[property] = extend(target[property], object[property]);
                                } else {
                                    target[property] = object[property];
                                }
                            }
                        }
                    }
                    return target;
                };

                var options, player, video, poster;
                options = extend(defaults, settings);

                player = this.el();
                video = this.el().getElementsByTagName("video")[0];
                poster = this.el().getElementsByTagName("div")[1];

                var properties = [
                        "transform",
                        "WebkitTransform",
                        "MozTransform",
                        "msTransform",
                        "OTransform"
                    ],
                    prop = properties[0];

                var i, j;

                for (i = 0, j = properties.length; i < j; i++) {
                    if (typeof player.style[properties[i]] !== "undefined") {
                        prop = properties[i];
                        break;
                    }
                }

                player.style.overflow = "hidden";
                video.style[prop] =
                    "scale(" + options.zoom + ") rotate(" + options.rotate + "deg)";
                poster.style[prop] =
                    "scale(" + options.zoom + ") rotate(" + options.rotate + "deg)";
                if (options.debug) console.log("zoomrotate: Register end");
            };
            var createPlayer = function() {
                var vid = document.querySelector("#yt-video");
                vid.className = "video-js vjs-default-skin vjs-big-play-centered";
                var player = videojs(vid, {
                    controls: true,
                    playbackRates: [1, 1.2, 1.5, 1.8, 2],
                    controlBar: {
                        audioTrackButton: false,
                        subsCapsButton: false
                    }
                });
                // player.src({
                //     src: vid.src,
                //     type: vid.type || "application/x-mpegURL"
                // });
                player.width(vid.style.width || 750);
                player.height(vid.style.height || 350);
                player.getChild("controlBar").addChild("rotateButton", {});
                var seekBar = player.controlBar.progressControl.seekBar;
                window.addEventListener(
                    "keydown",
                    function(event) {
                        switch (event.keyCode) {
                            case 32: //Space
                                if (player.paused()) {
                                    player.play();
                                } else {
                                    player.pause();
                                }
                                break;
                            case 39: //ArrowRight
                                var cur = player.currentTime();
                                player.currentTime(cur + 5);
                                break;
                            case 37: //ArrowLeft
                                var cur = player.currentTime();
                                player.currentTime(cur - 5);
                                break;
                        }
                    },
                    false
                );
                window.onkeydown = function(e) {
                    return !(e.keyCode == 32);
                };
            };
            var init = function() {
                videojs.registerComponent("RotateButton", rotateBtn);
                videojs.registerPlugin("zoomrotate", zoomrotatePlugin);
                createPlayer();
            };

            return {
                init: init
            };
        })(window, videojs);

        Player.init();

    </script>

@endsection
