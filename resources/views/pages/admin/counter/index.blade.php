@extends('layouts.admin')

@section('title')
   {{trans('counter.Counters')}}
@endsection

@section('content')







            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0"> {{trans('counter.Counters')}}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active"> {{trans('counter.Counters')}}</li>
                                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('counter.Home')}}</a></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <livewire:admin.counter.counter/>
                </div>
            </div>








@endsection
