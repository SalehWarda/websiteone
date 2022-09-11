<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0"> {{trans('counter.Counters')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_counter"
                                > {{trans('counter.Add_Counter')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>

                    </div>


                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{trans('counter.Title')}}</th>
                                <th> {{trans('counter.Ratio')}}</th>
                                <th> {{trans('counter.Icon')}}</th>
                                <th>{{trans('counter.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($counters as $counter)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
{{--                                    <td align="center">--}}
{{--                                        <a target="_blank" href="{{$social->link}}">--}}
{{--                                            <i class="fab fa-{{$social->name}}"></i>--}}
{{--                                        </a>--}}

{{--                                    </td>--}}
                                    <td>{{ $counter->title }}</td>
                                    <td>{{ $counter->counter }}</td>
                                    <td>{{ $counter->icon }}</td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editCounter({{$counter->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_counter"
                                                    title="{{trans('counter.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('counter.Edit')}}
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_counter({{$counter->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_counter"
                                                    title="{{trans('counter.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('counter.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>


                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">No counter found</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="float-right pagination-rounded">


                                        {{$counters->links()}}

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

    <!-- Edit Counter Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_counter"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel"> {{trans('counter.Edit')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <input type="hidden" wire:model="counter_id">
                        <div class="col-6">
                            <label for="title_ar" class="col-sm-2 col-form-label">{{trans('counter.Title_in_Arabic')}}:</label>
                            <input class="form-control" type="text" name="title_ar" wire:model="title_ar"
                                   id="name">
                            @error('title_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="title_en" class="col-sm-2 col-form-label">{{trans('counter.Title_in_English')}}:</label>
                            <input class="form-control" type="text" name="title_en" wire:model="title_en"
                                   id="name">
                            @error('title_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="counter" class="col-sm-2 col-form-label">{{trans('counter.Ratio')}} :</label>
                            <input class="form-control" type="text" name="counter" wire:model="counter"
                                   id="counter">
                            @error('counter')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="icon" class="col-sm-2 col-form-label">{{trans('counter.Icon')}} :</label>
                            <input class="form-control" type="text" name="icon" wire:model="icon"
                                   id="icon1">
                            @error('icon')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="updateCounter"> {{trans('counter.Save_Changes')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('counter.Close')}}</button>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title"><span class="text-danger">  ملاحظة : </span>
                                    إذا أردت البحث عن أيقون بالأسفل تريده يمكنك البحث بواسطة الضغط على (CTRL+F) و وضع إسم الأيقون

                                </h4><br>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">Solid</h4>
                                <p class="card-title-desc mb-2">Use <code>&lt;i class="fas fa-ad"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                <div class="row icon-demo-content" id="solid">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Regular</h4>
                                <p class="card-title-desc mb-2">Use <code>&lt;i class="far fa-address-book"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                <div class="row icon-demo-content" id="regular">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Brands</h4>
                                <p class="card-title-desc mb-2">Use <code>&lt;i class="fab fa-500px"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                <div class="row icon-demo-content" id="brand">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>

            </div>
        </div>
    </div>



    <!-- Delete Counter Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog"
         id="delete_counter" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">{{trans('counter.Delete')}} </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" wire:model="counter_id">

                    <h4>{{trans('counter.Delete_Message')}} </h4>

                    <h5><span class="text-danger">{{$title}}</span></h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">{{trans('counter.Close')}}
                    </button>
                    <button type="submit" wire:click="deleteCounter"
                            class="btn btn-danger waves-effect waves-light">{{trans('counter.Delete')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--  Add ServiceQuestion Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_counter"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel"> {{trans('counter.Add_New_Counter')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6">
                            <label for="title_ar" class="col-sm-2 col-form-label">{{trans('counter.Title_in_Arabic')}}:</label>
                            <input class="form-control" type="text" name="title_ar" wire:model="title_ar"
                                   id="name">
                            @error('title_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="title_en" class="col-sm-2 col-form-label">{{trans('counter.Title_in_English')}}:</label>
                            <input class="form-control" type="text" name="title_en" wire:model="title_en"
                                   id="name">
                            @error('title_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="counter" class="col-sm-2 col-form-label">{{trans('counter.Ratio')}} :</label>
                            <input class="form-control" type="text" name="counter" wire:model="counter"
                                   id="counter">
                            @error('counter')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="icon" class="col-sm-2 col-form-label">{{trans('counter.Icon')}} :</label>
                            <input class="form-control" type="text" name="icon" wire:model="icon"
                                   id="icon">
                            @error('icon')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="addCounter"> {{trans('counter.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('counter.Close')}}</button>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title"><span class="text-danger">  ملاحظة : </span>
                                    إذا أردت البحث عن أيقون بالأسفل تريده يمكنك البحث بواسطة الضغط على (CTRL+F) و وضع إسم الأيقون

                                </h4><br>
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-body">


                                <h4 class="card-title">Solid</h4>
                                <p class="card-title-desc mb-2">Use <code>&lt;i class="fas fa-ad"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                <div class="row icon-demo-content" id="solids">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Regular</h4>
                                <p class="card-title-desc mb-2">Use <code>&lt;i class="far fa-address-book"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                <div class="row icon-demo-content" id="regulars">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Brands</h4>
                                <p class="card-title-desc mb-2">Use <code>&lt;i class="fab fa-500px"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                <div class="row icon-demo-content" id="brands">
                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>

            </div>
        </div>
    </div>

</div>
@push('scripts')
    <script src="{{asset('assets/admin/js/pages/fontawesome.init.js')}}"></script>
    <script src="{{asset('assets/admin/js/pages/fontawesome.initt.js')}}"></script>
    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_counter").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_counter").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDelete', event => {
            $("#delete_counter").click();
        });
    </script>

@endpush
