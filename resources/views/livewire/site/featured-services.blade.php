<div>
    <section class="course__area pt-115 pb-90 grey-bg-3">
        <div class="container" data-aos="fade-left">

            <div class="row">
                <div class="col-xxl-12">
                    <div class="section__title-wrapper text-center mb-60">
                        <span class="section__title-pre">{{trans('site.Top_Services')}}</span>
                        <h2 class="section__title section__title-44">{{trans('site.My_Special_Services')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($services as $service)

                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
                        <div class="course__item white-bg transition-3 mb-30">
                            <div class="course__thumb w-img fix">
                                <a href="{{route('site.service-details',$service->slug)}}">
                                    @if($service->firstMedia)
                                        <img
                                            src="{{asset('assets/images/admin/services/'.$service->firstMedia->file_name)}}"
                                            width="320" height="220" alt="{{$service->name}}">

                                    @endif
                                </a>
                            </div>
                            <div class="course__content p-relative">

                                <div class="course__tag">
                                    @if($service->status == 'open')
                                        <a href="#"><strong><span
                                                    class="text-success">{{$service->status()}}</span></strong> </a>
                                    @elseif($service->status == 'closed')
                                        <a href="#"><strong> <span
                                                    class="text-danger">{{$service->status()}}</span></strong></a>
                                    @else
                                        <a href="#"> <strong><span
                                                    class="text-warning">{{$service->status()}}</span></strong></a>

                                    @endif
                                </div>
                                <h3 class="course__title">
                                    <a href="{{route('site.service-details',$service->slug)}}">{{$service->name}}.</a>
                                </h3>
                                <p>{!! \Illuminate\Support\Str::limit($service->description, 70, '...') !!} </p>

                                <div class="course__bottom d-sm-flex align-items-center justify-content-between">
                                    <div class="course__tutor">
                                        <a href="{{route('site.service-details',$service->slug)}}"><i
                                                class="fa fa-arrow-circle-right"></i> {{trans('site.More_Details')}}</a>
                                    </div>
                                    <div class="course__tutor">
{{--                                        <a wire:click.prevent="addToCart({{$service->id}})" class="btn btn-sm"><i--}}
{{--                                                class="fa fa-cart-shopping"></i> إضافة إلى السلة</a>--}}
                                        <a class="btn btn-sm" ><i class="fa fa-money-bill"></i> <strong>{{$service->price}}  {{trans('site.SR')}}</strong></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </section>

</div>
