<div>

        <div class="course__video">
            <div class="course__video-thumb w-img mb-25">

                    @if($course->firstMedia())
                        <img
                            src="{{asset('assets/images/admin/courses/'.$course->firstMedia->file_name)}}"
                            width="240" height="100" alt="{{$course->title}}">

                    @endif


            </div>
            <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
                <div class="course__video-price">
                    <h5>{{trans('site.SR')}} {{$course->price}} </h5>
                </div>

            </div>
            <div class="course__video-content mb-35">
                <ul>
                    <li class="d-flex align-items-center ">
                        <div class="course__video-icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="course__video-info">
                            <h5 class="ml-5" ><span >{{trans('site.Instructor')}} :</span>{{$course->instructor}}</h5>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <div class="course__video-icon">
                            <i class="fab fa-youtube"></i>
                        </div>
                        <div class="course__video-info">
                            <h5 class="ml-5"><span>{{trans('site.Lessons')}} :</span>{{$course->videos->count()}}</h5>
                        </div>
                    </li>
                    <li class="d-flex align-items-center">
                        <div class="course__video-icon">
                            <i class="fa fa-clock"></i>
                        </div>
                        <div class="course__video-info">
                            <h5 class="ml-5"><span>{{trans('site.Deadline')}} :</span>{{$course->deadline}} Day</h5>
                        </div>
                    </li>
{{--                    <li class="d-flex align-items-center">--}}
{{--                        <div class="course__video-icon">--}}
{{--                            <i class="fa fa-users"></i>--}}
{{--                        </div>--}}
{{--                        <div class="course__video-info">--}}
{{--                            <h5 class="ml-5"><span>{{trans('site.Studens')}} :</span>{{$course->orders()->user->count()}} students</h5>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                    <li class="d-flex align-items-center">--}}
{{--                        <div class="course__video-icon">--}}
{{--                            <i class="fa fa-globe"></i>--}}
{{--                        </div>--}}
{{--                        <div class="course__video-info">--}}
{{--                            <h5 class="ml-5"><span>اللغة :</span>English</h5>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                </ul>
            </div>
                                           {{-- <div class="course__payment mb-35">--}}
            {{--                                    <h3>Payment:</h3>--}}
            {{--                                    <a href="#">--}}
            {{--                                        <img src="{{asset('assets/site/img/course/payment/payment-1.png')}}" alt="">--}}
            {{--                                    </a>--}}
            {{--                                </div> --}}
            <div class="course__enroll-btn">
                <button type="button" class="tp-btn w-100 text-center" wire:click.prevent="addToCart('{{$course->id}}')">طلب الدورة <i class="fa fa-cart-shopping"></i></button>
            </div>
        </div>

</div>
