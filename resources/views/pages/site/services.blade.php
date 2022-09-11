@extends('layouts.app')

@section('style')

    <style>
        p{
            word-wrap:break-word;
        }
    </style>
@endsection
@section('content')



    <!-- services area start -->
    <section class="course__area pt-115 pb-90 grey-bg-3">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="section__title-wrapper text-center mb-60">
                        <span class="section__title-pre">{{trans('site.Top_Services')}}</span>
                        <h2 class="section__title section__title-44">{{trans('site.My_Special_Services')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @forelse($services as $service)

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
                                        <a href="#"><strong><span class="text-success">{{$service->status()}}</span></strong> </a>
                                    @elseif($service->status == 'closed')
                                        <a href="#"><strong> <span class="text-danger">{{$service->status()}}</span></strong></a>
                                    @else
                                        <a href="#"> <strong><span class="text-warning">{{$service->status()}}</span></strong></a>

                                    @endif
                                </div>
                                <h3 class="course__title">
                                    <a href="{{route('site.service-details',$service->slug)}}">{{$service->name}}.</a>
                                </h3>
                                <p>{!! \Illuminate\Support\Str::limit($service->description, 70, '...') !!} </p>

                                <div class="course__bottom d-sm-flex align-items-center justify-content-between">
                                    <div class="course__tutor">
                                        <a href="{{route('site.service-details',$service->slug)}}"><i class="fa fa-arrow-circle-right"></i> {{trans('site.More_Details')}}</a>
                                    </div>
                                    <div class="course__tutor">
                                     <a><i class="fa fa-money-bill"></i> <span> {{trans('site.SR')}} {{$service->price}}</span></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="section__title-wrapper text-center mb-60">

                                <h2 class="section__title section__title-44">{{trans('site.No_Services_Found')}} ...</h2>

                            </div>
                        </div>
                    </div>
                @endforelse
                    <div class="align-center">
                        {!! $services->appends(request()->all())->links() !!}
                    </div>
            </div>
        </div>
    </section>
    <!-- services area end -->


@endsection
