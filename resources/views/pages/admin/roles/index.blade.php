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
                                    <h5 class="card-title pb-0 border-0"> {{trans('roles.User_Permissions')}}</h5>
                                </div>

                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block">
                                        <a href="{{route('admin.roles.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                                        >{{trans('roles.Add_Role')}} <i class="fa fa-plus"></i>
                                        </a>

                                    </div>

                                </div>

                            </div>



                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('roles.User_Role')}}</th>
                                        <th>{{trans('roles.Permissins')}}</th>
                                        <th>{{trans('roles.Actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($roles as $role)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{ $role->name}}</td>
                                            <td>
                                                @foreach((array)$role->permissions as $permission)
                                                    {{ $permission}} ,
                                                @endforeach


                                            </td>
                                            <td>
                                                <div class="btn-list btn-list-icon">
                                                    <a href="{{route('admin.roles.edit',$role->id)}}" type="button"
                                                            class="btn btn-info waves-effect waves-light btn-rounded"
                                                             title="{{trans('roles.Edit')}}">
                                                        <i class="ri-edit-2-line align-middle me-2"></i>{{trans('roles.Edit')}}
                                                    </a>

                                                    <button type="button"
                                                            class="btn btn-danger waves-effect waves-light btn-rounded"
                                                            data-bs-toggle="modal" data-bs-target="#delete_role{{$role->id}}" title="{{trans('roles.Delete')}}">
                                                        <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('roles.Delete')}}
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>





                                        <!-- Delete ServiceQuestion Modal -->
                                        <div    class="modal fade" tabindex="-1" role="dialog" id="delete_role{{$role->id}}" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="myModalLabel">{{trans('roles.Permission_Delete')}} </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('admin.roles.destroy',$role->id)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="role_id" value="{{$role->id}}">

                                                            <h4>{{trans('roles.Delete_Message')}}</h4>

                                                            <h5><span class="text-danger">{{$role->name}}</span></h5>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect"  data-bs-dismiss="modal">{{trans('roles.Close')}}</button>
                                                        <button type="submit"  class="btn btn-danger waves-effect waves-light">{{trans('roles.Delete')}}</button>
                                                    </div>
                                                        </form>

                                                </div>
                                            </div>
                                        </div>
                                    @empty

                                        <tr>
                                            <td colspan="3" class="text-center">لم يتم العثورعلى صلاحيات للمستخدمين</td>
                                        </tr>
                                    @endforelse


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <div class="float-right pagination-rounded">


                                                {{$roles->links()}}

                                            </div>

                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection
