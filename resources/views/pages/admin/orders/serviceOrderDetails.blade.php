@extends('layouts.admin')

@section('title')
    تفاصيل الخدمة
@endsection

@section('content')







    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">تفاصيل الخدمة</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">تفاصيل الخدمة</li>
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16"><strong>({{\Carbon\Carbon::parse( $service->dateService->serviceTiming->service_timings_from)->format('Y-m-d  h:i A')}}) </strong></h4>
                                        <h4 class="float-end font-size-16"><strong> ({{\Carbon\Carbon::parse( $service->dateService->serviceTiming->service_timings_to)->format('Y-m-d  h:i A')}})  -   </strong></h4>
                                        <h3>
                                            <p>{{$service->name}}</p>
                                        </h3>
                                    </div>
                                    <hr>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Service Info</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <td><strong>Question</strong></td>
                                                        <td class="text-center"><strong>Answer</strong></td>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                  @foreach($service->questions as $info)
                                                      <tr>
                                                          <td>{{$info->question}}</td>
                                                          <td class="text-center">{{$info->answer->answer}}</td>

                                                      </tr>


                                                  @endforeach


                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>








@endsection
