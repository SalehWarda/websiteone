@extends('layouts.admin')

@section('title')
    {{trans('roles.User_Permissions')}}
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{trans('roles.User_Permissions')}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">{{trans('roles.User_Permissions')}}</li>
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('roles.Home')}}</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block">
                                    <a href="{{route('admin.roles.index')}}"
                                       class="btn btn-outline-success waves-effect waves-light btn-rounded"
                                    >{{trans('roles.Back')}} <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <br>


                            <form action="{{route('admin.roles.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">

                                                <h4 class="card-title">{{trans('roles.User_Permissions')}}</h4>


                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">
                                                        {{trans('roles.User_Role')}}: </label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" name="name" type="text" placeholder="{{trans('roles.User_Role')}}"
                                                               id="example-text-input">
                                                        @error('name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">{{trans('roles.Permissins')}}</h4>
                                                @error('permissions')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                                <div class="row">

                                                    @foreach(config('permission.permissions') as $name => $value)
                                                        <div class="col-md-6">
                                                            <div>

                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" value="{{$name}}" name="permissions[]"
                                                                           type="checkbox" id="formCheck{{$loop->iteration}}">
                                                                    <label class="form-check-label" for="formCheck{{$loop->iteration}}">
                                                                        {{$value}}
                                                                    </label>

                                                                </div>
                                                            </div>

                                                        </div>

                                                    @endforeach


                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <button class="btn btn-primary" type="submit">{{trans('roles.Save')}}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
