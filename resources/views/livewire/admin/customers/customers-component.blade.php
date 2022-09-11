<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">{{trans('users.Users_of_the_site')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_customer"
                                >{{trans('users.Add_New_User')}} <i class="fa fa-plus"></i>
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
                                <th>{{trans('users.Email')}},{{trans('users.Mobile')}}</th>
                                <th>{{trans('users.Status')}}</th>
                                <th>{{trans('users.Created_at')}}</th>
                                <th >{{trans('users.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($customers as $customer)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($customer->user_image != '')
                                            <img src="{{ asset('assets/images/customer/'. $customer->user_image) }}" width="60" height="60" alt="{{ $customer->full_namee }}">
                                        @else
                                            <img src="{{ asset('assets/images/customer/avatar.png') }}" width="60" height="60" alt="{{ $customer->full_namee }}">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $customer->full_namee }}<br>
                                        <strong>{{ $customer->username }}</strong>
                                    </td>
                                    <td>
                                        {{ $customer->email }}<br>
                                        {{ $customer->mobile }}
                                    </td>
                                    <td>
                                    @if($customer->status == 1)
                                        <span class="badge rounded-pill bg-success">{{$customer->status()}}</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">{{$customer->status()}}</span>
                                    @endif
                                    </td>
                                    <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editCustomer({{$customer->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_customer" title="{{trans('users.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('users.Edit')}}
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_customer({{$customer->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_customer" title="{{trans('users.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('users.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No users found </td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="float-right">
                                        {!! $customers->appends(request()->all())->links() !!}
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


    <!--  Add Customer Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_customer"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('users.Add_New_User')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first_name">{{trans('users.First_name')}}:</label>
                                <input type="text" wire:model="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="last_name">{{trans('users.Last_name')}}:</label>
                                <input type="text" wire:model="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="username">{{trans('users.User_name')}}:</label>
                                <input type="text" wire:model="username" name="username" value="{{ old('username') }}" class="form-control">
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>

                    <br>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="mobile"> {{trans('users.Mobile')}}:</label>
                                <input type="text" wire:model="mobile" name="mobile" value="{{ old('mobile') }}" class="form-control">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="password">{{trans('users.Password')}}:</label>
                                <input type="password" wire:model="password" name="password" value="{{ old('password') }}" class="form-control">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">{{trans('users.Email')}}:</label>
                                <input type="text" wire:model="email" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('users.Status')}}:</label>
                            <div class="form-group">
                                <select name="status" wire:model="status" class="form-control select2">
                                    <option value="" selected ="">{{trans('users.Choose')}}...</option>
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

                    </div><br>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{trans('users.UserImage')}}:</h4>
                                    <div class="d-flex py-3 ">

                                        @if ($user_image)

                                            <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                              <span
                                                  class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                               <img src="{{ $user_image->temporaryUrl() }}" width="200">
                                                </span>
                                            </div>

                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <input type="file" name="user_image" wire:model="user_image" accept="image/*"
                                               class="form-control" id="customFile"><br>

                                    </div>
                                    @error('user_image')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="addCustomer"> {{trans('users.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('users.Close')}}</button>
                </div>


            </div>
        </div>
    </div>

    <!--  Edit Customer Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_customer"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('users.Add_New_User')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" wire:model="customer_id"/>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="first_name">{{trans('users.First_name')}}:</label>
                                <input type="text" wire:model="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="last_name">{{trans('users.Last_name')}}:</label>
                                <input type="text" wire:model="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="username">{{trans('users.User_name')}}:</label>
                                <input type="text" wire:model="username" name="username" value="{{ old('username') }}" class="form-control">
                                @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>

                    <br>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="mobile"> {{trans('users.Mobile')}}:</label>
                                <input type="text" wire:model="mobile" name="mobile" value="{{ old('mobile') }}" class="form-control">
                                @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="password">{{trans('users.Password')}}:</label>
                                <input type="password" wire:model="password" name="password" value="{{ old('password') }}" class="form-control">
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="email">{{trans('users.Email')}}:</label>
                                <input type="text" wire:model="email" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('users.Status')}}:</label>
                            <div class="form-group">
                                <select name="status" wire:model="status" class="form-control select2">
                                    <option value="" selected ="">{{trans('users.Choose')}}...</option>
                                    <option
                                        value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                        {{trans('users.Status')}}
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

                    </div><br>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{trans('users.UserImage')}}:</h4>
                                    <div class="d-flex py-3 ">

                                        @if ($imageDB)

                                            <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                                                                 <span
                                                                                     class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                                                    <img src="{{ asset('assets/images/customer/'.$imageDB)}}" width="200">
                                                                                     </span>
                                            </div>

                                        @endif

                                    @if ($user_image)

                                            <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                              <span
                                                  class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                               <img src="{{ $user_image->temporaryUrl() }}" width="200">
                                                </span>
                                            </div>

                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <input type="file" name="user_image" wire:model="user_image" accept="image/*"
                                               class="form-control" id="customFile"><br>

                                    </div>
                                    @error('user_image')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="updateCustomer"> {{trans('users.Saving_changes')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('users.Close')}}</button>
                </div>


            </div>
        </div>
    </div>

    <!--  Delete Customer Modal -->
    <div  wire:ignore.self  class="modal fade" tabindex="-1" role="dialog" id="delete_customer" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">{{trans('users.User_Delete')}} </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" wire:model="customer_id">

                    <h4>{{trans('users.Delete_Message')}} </h4>

                    <h5><span class="text-danger">{{$name}}</span></h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"  data-bs-dismiss="modal">{{trans('users.Close')}}</button>
                    <button type="submit" wire:click="delete_customer" class="btn btn-danger waves-effect waves-light">{{trans('users.Delete')}}</button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_customer").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_customer").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDelete', event => {
            $("#delete_customer").click();
        });
    </script>

@endpush
