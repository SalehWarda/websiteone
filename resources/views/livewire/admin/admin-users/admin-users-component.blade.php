<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">{{trans('users.Users_of_the_control_panel')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_user"
                                >{{trans('users.AddUser')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>

                    </div>


                    {{--                    @include('pages.admin.services.filter.filter')--}}

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('users.Image')}}</th>
                                <th>{{trans('users.Name')}}</th>
                                <th>{{trans('users.Email')}}</th>
                                <th>{{trans('users.Mobile')}}</th>
                                <th>{{trans('users.Role')}}</th>
                                <th>{{trans('users.Status')}}</th>
                                <th>{{trans('users.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($users as $key => $user)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        @if($user->firstMedia)
                                            <img
                                                src="{{asset('assets/images/admin/users/'.$user->firstMedia->file_name)}}"
                                                width="60" height="60" alt="{{$user->name}}">
                                        @else
                                            <img src="{{asset('assets/images/admin/users/avatar.png')}}" width="60"
                                                 height="60"
                                                 alt="{{$user->name}}">
                                        @endif

                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}} </td>
                                    <td>{{$user->mobile}} </td>

                                    <td>
                                        {{$user->role->name}}

                                    </td>
                                    <td>
                                        @if($user->status == 1)
                                            <span class="badge rounded-pill bg-success">{{$user->status()}}</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">{{$user->status()}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editUser({{$user->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_user" title="{{trans('users.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('users.Edit')}}
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_user({{$user->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_user" title="{{trans('users.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('users.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>



                                <!--  Edit User Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_user"
                                     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">
                                                    {{trans('users.Name')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">


                                                <input type="hidden" wire:model="user_id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="name_ar" class="col-sm-2 col-form-label">
                                                            {{trans('users.Name_In_Arabic')}}:</label>
                                                        <input class="form-control" type="text" name="name_ar"
                                                               wire:model="name_ar"
                                                               id="name_ar">
                                                        @error('name_ar')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="name_en" class="col-sm-2 col-form-label">
                                                            {{trans('users.Name_In_English')}}:</label>
                                                        <input class="form-control" type="text" name="name_en"
                                                               wire:model="name_en"
                                                               id="name_en">
                                                        @error('name_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>


                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="email" class="col-sm-2 col-form-label">
                                                            {{trans('users.Email')}}:</label>
                                                        <input class="form-control" type="email" name="email"
                                                               wire:model="email" id="email">
                                                        @error('email')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="mobile" class="col-sm-2 col-form-label">
                                                            {{trans('users.Mobile')}}:</label>
                                                        <input class="form-control" type="mobile" name="mobile"
                                                               wire:model="mobile" id="mobile">
                                                        @error('mobile')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="password" class="col-sm-2 col-form-label">
                                                            {{trans('users.Password')}}:</label>
                                                        <input class="form-control" type="password" name="password"
                                                               wire:model="password" id="password">
                                                        @error('password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="password_confirmation"
                                                               class="col-sm-2 col-form-label">{{trans('users.Password_Confirmation')}}:</label>
                                                        <input class="form-control" type="password"
                                                               name="password_confirmation"
                                                               wire:model="password_confirmation"
                                                               id="password_confirmation">
                                                        @error('password_confirmation')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>


                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('users.Status')}}:</label>
                                                        <div class="form-group">
                                                            <select name="status" wire:model="status"
                                                                    class="form-control select2">
                                                                <option value="" selected disabled="">{{trans('users.Choose')}}...</option>
                                                                <option
                                                                    value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                                                    {{trans('users.Active')}}
                                                                </option>
                                                                <option
                                                                    value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>
                                                                    {{trans('users.InActive')}}
                                                                </option>

                                                            </select>
                                                            @error('status')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">
                                                            {{trans('users.Role')}}:</label>
                                                        <div class="form-group">
                                                            <select name="role" wire:model="role"
                                                                    class="form-control select2">
                                                                <option value="" selected>{{trans('users.Choose')}}...</option>

                                                                @if($roles && $roles->count() > 0)
                                                                    @foreach($roles as $rolee)
                                                                        <option
                                                                            value="{{$rolee->id}}" {{$role == $rolee->id ? 'selected' : ''}} >{{$rolee->name}}
                                                                        </option>
                                                                    @endforeach
                                                                @endif


                                                            </select>
                                                            @error('role')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>


                                                    </div>
                                                </div>

                                                <br>


                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{trans('users.UserImage')}}:</h4>

                                                            <p class="card-title-desc"><span class="text-danger">  {{trans('users.Note')}} : </span>
                                                                {{trans('users.Note_Message')}}<br>
                                                                الأفضل لمقاس الصورة أن يكون 500px x 500px
                                                            </p>
                                                            <div class="d-flex py-3 ">

                                                                @if ($imageDB)

                                                                    <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                                                                 <span
                                                                                 class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                                                    <img src="{{ asset('assets/images/admin/users/'.$imageDB->file_name)}}" width="200">
                                                                                     </span>
                                                                    </div>

                                                                @endif


                                                                    @if ($image)

                                                                    <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                              <span
                                                  class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                               <img src="{{ $image->temporaryUrl() }}" width="200">
                                                </span>
                                                                    </div>

                                                                @endif
                                                            </div>
                                                            <div class="input-group">
                                                                <input type="file" name="image" wire:model="image"
                                                                       accept="image/*"
                                                                       class="form-control" id="customFile"><br>

                                                            </div>
                                                            @error('image')<span
                                                                class="text-danger">{{ $message }}</span>@enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button class="btn ripple btn-secondary m-lg-2" type="submit"
                                                        wire:click="updateUser"> {{trans('users.Saving_changes')}}<i
                                                        class="fe fe-plus"></i></button>
                                                <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                        type="button">{{trans('users.Close')}}
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <!-- Delete User Modal -->
                                    <div  wire:ignore.self  class="modal fade" tabindex="-1" role="dialog" id="delete_user" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h3 class="modal-title" id="myModalLabel">{{trans('users.User_Delete')}} </h3>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <input type="hidden" wire:model="user_id">

                                                                                <h4>{{trans('users.Delete_Message')}} </h4>

                                                                                <h5><span class="text-danger">{{$name}}</span></h5>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light waves-effect"  data-bs-dismiss="modal">{{trans('users.Close')}}</button>
                                                                                <button type="submit" wire:click="delete_user" class="btn btn-danger waves-effect waves-light">{{trans('users.Delete')}}</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                            @empty

                                <tr>
                                    <td colspan="8" class="text-center">{{trans('users.No_users_found')}}</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="float-right pagination-rounded">


                                        {{$users->links()}}

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


    <!--  Add User Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_user"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('users.Add_New_User')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="name_ar" class="col-sm-2 col-form-label">{{trans('users.Name_In_Arabic')}}:</label>
                            <input class="form-control" type="text" name="name_ar" wire:model="name_ar"
                                   id="name_ar">
                            @error('name_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name_en" class="col-sm-2 col-form-label">{{trans('users.Name_In_English')}}:</label>
                            <input class="form-control" type="text" name="name_en" wire:model="name_en"
                                   id="name_en">
                            @error('name_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="email" class="col-sm-2 col-form-label">{{trans('users.Email')}}:</label>
                            <input class="form-control" type="email" name="email" wire:model="email" id="email">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="mobile" class="col-sm-2 col-form-label">{{trans('users.Mobile')}}:</label>
                            <input class="form-control" type="mobile" name="mobile" wire:model="mobile" id="mobile">
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="password" class="col-sm-2 col-form-label">{{trans('users.Password')}}:</label>
                            <input class="form-control" type="password" name="password" wire:model="password"
                                   id="password">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">{{trans('users.Password_Confirmation')}}:</label>
                            <input class="form-control" type="password" name="password_confirmation"
                                   wire:model="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('users.Status')}}:</label>
                            <div class="form-group">
                                <select name="status" wire:model="status" class="form-control select2">
                                    <option value="" selected disabled="">{{trans('users.Choose')}}...</option>
                                    <option
                                        value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                        {{trans('users.Active')}}
                                    </option>
                                    <option
                                        value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>
                                        {{trans('users.InActive')}}
                                    </option>

                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('users.Role')}}:</label>
                            <div class="form-group">
                                <select name="role" wire:model="role" class="form-control select2">
                                    <option value="" selected>{{trans('users.Choose')}} ...</option>

                                    @if($roles && $roles->count() > 0)
                                        @foreach($roles as $role)
                                            <option
                                                value="{{$role->id}}">{{$role->name}}
                                            </option>
                                        @endforeach
                                    @endif


                                </select>
                                @error('role')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>


                        </div>
                    </div>

                    <br>


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{trans('users.UserImage')}}:</h4>
                                <p class="card-title-desc"><span class="text-danger">  {{trans('users.Note')}} : </span>
                                    {{trans('users.Note_Message')}}<br>
                                    الأفضل لمقاس الصورة أن يكون 500px x 500px
                                </p>
                                <div class="d-flex py-3 ">

                                    @if ($image)

                                        <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                              <span
                                                  class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                               <img src="{{ $image->temporaryUrl() }}" width="200">
                                                </span>
                                        </div>

                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="file" name="image" wire:model="image" accept="image/*"
                                           class="form-control" id="customFile"><br>

                                </div>
                                @error('image')<span
                                    class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="addUser"> {{trans('users.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('users.Close')}}</button>
                </div>


            </div>
        </div>
    </div>

</div>
@push('scripts')

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_user").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_user").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDelete', event => {
            $("#delete_user").click();
        });
    </script>

@endpush
