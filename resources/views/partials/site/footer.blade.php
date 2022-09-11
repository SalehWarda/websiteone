<footer>
    <div class="footer__area">
        <div class="footer__top grey-bg-4 pt-95 pb-45">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7">
                        <div class=" row text-center footer__widget footer__widget-2 footer-col-2-1 mb-50">
                            <div class="footer__logo ">
                                <div>
                                    <a href="{{route('site.index')}}">
                                        <img src="{{asset('assets/site/img/logo/lo.png')}}" width="150" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="footer__widget-content">
                                <div class="footer__widget-info">
                                    <h5>{{$about->degree}}</h5>
                                    <br>
                                    <div class="footer__social">
                                        <h4>{{trans('site.Follow_Me')}}:</h4>

                                        <ul>
                                            @foreach($socials as $social)
                                                <li><a href="{{ $social->link}}"><i class="fa-brands fa-{{ $social->name}}"></i></a></li>

                                            @endforeach


                                        </ul>
                                    </div>
                                    <div class="footer__copyright text-center " >
                                        <p class="text-center  md:text-right mb-4 p-text"> جميع حقوق محفوظة للدتر
                                            <a href="/">

                                                <strong style="color: #526b77"> فؤاد الشري </strong> <span
                                                    id="c"> © </span> </a>
                                        </p>
                                    </div>
                                    <div class="footer__logo">
                                        <div class="row text-center" >
                                            <p class="text-center  md:text-right mb-4 p-text" >تم التطوير بواسطة مؤسسة
                                                <a href="https://holla.sa/ar" target="_blank">
        
                                                    <strong style="color: #526b77">حلة  </strong>  <span id="c"> © </span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5">
                        <div class="  footer__widget footer__widget-2 mb-50 footer-col-2-2" style="color: #000000;">
                            <h3 class=" text-center footer__widget-title">{{trans('site.Explore')}}</h3>
                            <div class="footer__widget-content ">
                                <ul class="row text-center">
                                    <li class="pb-1 col-6">
                                        <a href="{{route('site.index')}}">{{trans('site.Home')}}</a>
                                    </li>
                                    <li class=" pb-1 col-6">
                                        <a href="{{route('site.about')}}">{{trans('site.About')}}</a>
                                    </li>

                                    <li class="pb-1 col-6">
                                        <a href="{{route('site.courses')}}">{{trans('site.Courses')}}</a>
                                    </li>
                                    <li class="pb-1 col-6">
                                        <a href="{{route('site.services')}}">{{trans('site.Services')}}</a>
                                    </li>

                                    <li class="pb-1 col-6">
                                        <a href="{{route('site.blog')}}">{{trans('site.Blog')}}</a>
                                    </li>
                                    <li class="pb-1 col-6">
                                        <a href="{{route('site.contact')}}">{{trans('site.Contact')}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer__widget footer__widget-2 mb-50 footer-col-2-2" style="color: #000000;">
                            <h3 class=" text-center footer__widget-title">{{trans('site.Privacy_and_Usage_Policy')}}</h3>
                            <div class="footer__widget-content">
                                <ul class="row text-center">
                                    <li class="pb-1">
                                        <a href="{{route('site.privacyAndPolicy')}}">{{trans('privacy_policy.Privacy_Policy')}}</a>
                                    </li>
                                    <li class="pb-1">
                                        <a href="{{route('site.termOfUse')}}">{{trans('privacy_policy.Term_of_usage')}}</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="footer__widget footer__widget-2 footer-col-2-1 mb-50 ">
                            <div class="footer__logo">
                                <div>
                                    <a  href="https://holla.sa/ar" target="_blank">
                                        <img class="mr-25" src="" width="150" alt="">
                                    </a>
                                    <p class="text-center  md:text-right mb-4 p-text">
                                        <a href="https://holla.sa/ar" target="_blank">

                                            <strong style="color: #526b77">  </strong>  <span id="c">  </span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="footer__logo">
                                <div>
                                    <a  href="https://holla.sa/ar" target="_blank">
                                        <img class="mr-25" src="" width="150" alt="">
                                    </a>
                                    <p class="text-center  md:text-right mb-4 p-text">
                                        <a href="https://holla.sa/ar" target="_blank">

                                            <strong style="color: #526b77">  </strong>  <span id="c">  </span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
