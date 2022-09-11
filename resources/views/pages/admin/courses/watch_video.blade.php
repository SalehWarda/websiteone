@extends('layouts.admin')

@section('title')
    {{trans('videos.Videos')}}
@endsection
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







    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">الفيديوهات</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">{{trans('videos.Videos')}}</li>
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('videos.Home')}}</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>



            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="video-container">
                            <div class="video-container">
                                <video id="yt-video"
                                       class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered"
                                       data-setup='{
                                       "controls": true,
                                        "autoplay": false,
                                         "preload": "auto"



                                        }'>
                                    <source src="{{ asset('videos/'. $video->uid . '/' . $video->processed_file)}}"
                                            type="application/x-mpegURL" />
                                    <p class="vjs-no-js">
                                        To view this video please enable JavaScript, and consider upgrading to a
                                        web browser that
                                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                            video</a>
                                    </p>
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>








@endsection

@push('scripts')
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
                player.width(vid.style.width || 1000);
                player.height(vid.style.height || 500);
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


@endpush
