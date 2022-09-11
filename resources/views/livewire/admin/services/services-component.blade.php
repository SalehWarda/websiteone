
@push('style')
<style>



</style>
@endpush

<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">{{trans('services.Services')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_service"
                                >{{trans('services.Add_Servuce')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>

                    </div>


                    @include('pages.admin.services.filter.filter')

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('services.Image')}}</th>
                                <th>{{trans('services.Service')}}</th>
                                <th>{{trans('services.Price')}}</th>
                                <th>{{trans('services.Description')}}</th>
                                <th>{{trans('services.Status')}}</th>
                                <th>{{trans('services.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($services as $service)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        @if($service->firstMedia)
                                            <img
                                                src="{{asset('assets/images/admin/services/'.$service->firstMedia->file_name)}}"
                                                width="60" height="60" alt="{{$service->name}}">
                                        @else
                                            <img src="{{asset('assets/images/noImage.jpg')}}" width="60" height="60"
                                                 alt="{{$service->name}}">
                                        @endif

                                    </td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}} {{trans('services.RS')}}</td>
                                    <td>{!! \Illuminate\Support\Str::limit($service->description, 30, '...')  !!}</td>
                                    <td>
                                        @if($service->status == 'open')
                                            <span class="badge rounded-pill bg-success">{{$service->status()}}</span>
                                        @elseif($service->status == 'closed')
                                            <span class="badge rounded-pill bg-danger">{{$service->status()}}</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">{{$service->status()}}</span>

                                        @endif

                                    </td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editService({{$service->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_service"
                                                    title="{{trans('services.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('services.Edit')}}
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_service({{$service->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_service"
                                                    title="{{trans('services.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('services.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                <!--  Edit Service Modal -->
                                <div wire:ignore.self class="modal fade "   role="dialog" id="edit_service"
                                     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="myExtraLargeModalLabel">{{trans('services.Service_Update')}}: {{$service_name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <input type="hidden" wire:model="service_id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="service_ar"
                                                               class="col-sm-2 col-form-label">{{trans('services.Service_In_Arabic')}}:</label>
                                                        <input class="form-control" type="text" name="service_ar"
                                                               wire:model="service_ar"
                                                               id="service_ar">
                                                        @error('service_ar')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="service_en"
                                                               class="col-sm-2 col-form-label">{{trans('services.Service_In_English')}}:</label>
                                                        <input class="form-control" type="text" name="service_en"
                                                               wire:model="service_en"
                                                               id="service_en">
                                                        @error('service_en')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>


                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="price"
                                                               class="col-sm-2 col-form-label">{{trans('services.Price')}}
                                                            :</label>
                                                        <input class="form-control" type="number" name="price"
                                                               wire:model="price" id="price">
                                                        @error('price')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="example-text-input"
                                                               class="col-sm-2 col-form-label">{{trans('services.Status')}}
                                                            :</label>
                                                        <div class="form-group">
                                                            <select name="status" wire:model="status"
                                                                    class="form-control select2">
                                                                <option value="open"
                                                                        selected="">{{trans('services.Choose')}}...
                                                                </option>
                                                                <option
                                                                    value="open" {{old('status',request()->input('status')) == 'open' ? 'selected' : ''}}>
                                                                    {{trans('services.Open')}}
                                                                </option>
                                                                <option
                                                                    value="closed" {{old('status',request()->input('status')) == 'closed' ? 'selected' : ''}}>
                                                                    {{trans('services.Closed')}}
                                                                </option>
                                                                <option
                                                                    value="futuristic" {{old('status',request()->input('status')) == 'futuristic' ? 'selected' : ''}}>
                                                                    {{trans('services.futuristic ')}}
                                                                </option>


                                                            </select>
                                                            @error('status')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>

                                                    </div>


                                                </div>
                                                <br>

                                                <div class="row">

                                                    <div class="col-md-6" >
                                                        <label
                                                            for="description_ar"> {{trans('services.Description_In_Arabic')}}:</label>

                                                        <div wire:ignore wire:key="myId">
                                                            <div id="description_arEdit" class="block mt-1 w-full">
                                                                {!! $description_ar !!}
                                                            </div>
                                                        </div>



                                                             <textarea id="description_arEdit" hidden  class="body-content"
                                                                       wire:model.debounce.2000ms="description_ar" name="description_ar">
                                                                           {!! $description_ar !!}
                                                           </textarea>
                                                            @error('description_ar')<span
                                                                class="text-danger">{{ $message }}</span>@enderror


                                                    </div>

                                                    <div class="col-md-6" wire:ignore>
                                                        <label
                                                            for="description_en">{{trans('services.Description_In_English')}}:</label>

{{--                                                        <div wire:ignore wire:key="myId2">--}}
{{--                                                            <div id="description_enEdit" class="block mt-1 w-full">--}}
{{--                                                                {!! $description_en !!}--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

                                                        <textarea id="description_enEdit" hidden class="body-content2"
                                                                  wire:model.debounce.2000ms="description_en">
                                                    {!! $description_en !!}
                                                           </textarea>
                                                        @error('description_en')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>


                                                </div>
                                                <br>


                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{trans('services.Service_Images')}}
                                                                :</h4>
                                                            <p class="card-title-desc"><span class="text-danger">  {{trans('services.Note')}} : </span>
                                                                {{trans('services.Note_Message')}}<br>
                                                                الأفضل لمقاس الصورة أن يكون 500px x 500px

                                                            </p>
                                                            <div class="d-flex py-3 ">

                                                                @if($service->media()->count() > 0)

                                                                    @if($imagesDB)

                                                                        @foreach($imagesDB as $media)
                                                                            <div
                                                                                class="mt-1 mx-1 d-flex rounded-md shadow-sm">
                                                                            <span
                                                                                class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">

                                                                                    <img
                                                                                        src="{{ asset('assets/images/admin/services/' . $media->file_name) }}"
                                                                                        width="100%" height="100px">

                                                                            </span>
                                                                            </div>
                                                                        @endforeach

                                                                    @endif

                                                                @endif

                                                                @if ($images)

                                                                    @foreach($images as $image)
                                                                        <div
                                                                            class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                              <span
                                                  class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                               <img src="{{ $image->temporaryUrl() }}" width="100%" height="100px">
                                                </span>
                                                                        </div>
                                                                    @endforeach

                                                                @endif
                                                            </div>
                                                            <div class="input-group">
                                                                <input type="file" name="images" wire:model="images"
                                                                       accept="image/*" multiple
                                                                       class="form-control" id="customFile">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button class="btn ripple btn-secondary m-lg-2" type="submit"
                                                        wire:click="updateService">{{trans('services.Saving_changes')}}
                                                    <i
                                                        class="fe fe-plus"></i></button>
                                                <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                        type="button">{{trans('services.Close')}}
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center">{{trans('services.No_services_found')}}</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="float-right pagination-rounded">


                                        {{$services->links()}}

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


    <!-- Delete Service Modal -->
    <div wire:ignore.self class="modal fade"  role="dialog" id="delete_service"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">{{trans('services.Service_Delete')}} </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" wire:model="service_id">

                    <h4>{{trans('services.Delete_Message')}} </h4>

                    <h5><span class="text-danger">{{$service_name}}</span></h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">{{trans('services.Close')}}</button>
                    <button type="submit" wire:click="delete_service"
                            class="btn btn-danger waves-effect waves-light">{{trans('services.Delete')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!--  Add Service Modal -->
    <div wire:ignore.self class="modal fade"  data-focus="false" role="dialog" id="add_service"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('services.Add_New_Service')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="service_ar"
                                   class="col-sm-2 col-form-label">{{trans('services.Service_In_Arabic')}}:</label>
                            <input class="form-control" type="text" name="service_ar" wire:model="service_ar"
                                   id="service_ar">
                            @error('service_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="service_en"
                                   class="col-sm-2 col-form-label">{{trans('services.Service_In_English')}}:</label>
                            <input class="form-control" type="text" name="service_en" wire:model="service_en"
                                   id="service_en">
                            @error('service_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="price" class="col-sm-2 col-form-label">{{trans('services.Price')}}:</label>
                            <input class="form-control" type="number" name="price" wire:model="price" id="price">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('services.Status')}}
                                :</label>
                            <div class="form-group">
                                <select name="status" wire:model="status" class="form-control select2">
                                    <option value="open" selected="">{{trans('services.Choose')}}...</option>
                                    <option
                                        value="open" {{old('status',request()->input('status')) == 'open' ? 'selected' : ''}}>
                                        {{trans('services.Open')}}
                                    </option>
                                    <option
                                        value="closed" {{old('status',request()->input('status')) == 'closed' ? 'selected' : ''}}>
                                        {{trans('services.Closed')}}
                                    </option>
                                    <option
                                        value="futuristic" {{old('status',request()->input('status')) == 'futuristic' ? 'selected' : ''}}>
                                        {{trans('services.futuristic ')}}
                                    </option>

                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>


                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="description_ar"> {{trans('services.Description_In_Arabic')}}:</label>

                            <div wire:ignore wire:key="myId">
                                <div id="description_ar" class="block mt-1 w-full">
                                    {!! $description_ar !!}
                                </div>
                            </div>

                            <textarea id="description_ar" hidden class="body-content"
                                      wire:model.debounce.2000ms="description_ar">
                                                        {!! $description_ar !!}
                                                           </textarea>
                            @error('description_ar')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="description_en">{{trans('services.Description_In_English')}}:</label>

                            <div wire:ignore wire:key="myId2">
                                <div id="description_en" class="block mt-1 w-full">
                                    {!! $description_en !!}
                                </div>
                            </div>

                            <textarea id="description_en" hidden class="body-content2"
                                      wire:model.debounce.2000ms="description_en">
                                                    {!! $description_en !!}
                                                           </textarea>
                            @error('description_en')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>


                    </div>
                    <br>


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{trans('services.Service_Images')}}:</h4>
                                <p class="card-title-desc"><span class="text-danger">  {{trans('services.Note')}} : </span>
                                    {{trans('services.Note_Message')}}<br>
                                    الأفضل لمقاس الصورة أن يكون 500px x 500px

                                </p>
                                <div class="d-flex py-3 ">

                                    @if ($images)

                                        @foreach($images as $image)
                                            <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                              <span
                                                  class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                               <img src="{{ $image->temporaryUrl() }}" width="100%" height="100px">
                                                </span>
                                            </div>
                                        @endforeach

                                    @endif
                                </div>
                                <div class="input-group">
                                    <input type="file" name="images" wire:model="images" accept="image/*" multiple
                                           class="form-control" id="customFile"><br>

                                </div>
                                @error('images')<span
                                    class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit"
                            wire:click="addService">{{trans('services.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                            type="button">{{trans('services.Close')}}</button>
                </div>


            </div>
        </div>
    </div>

</div>
@push('scripts')


{{--    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>--}}


    <script>
        $(function() {

            $('#description_ar').summernote({
                height: 100,
                dialogsInBody: false,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear',
                        'strikethrough', 'superscript', 'subscript',
                        'fontname','fontsize','table','ul', 'ol', 'paragraph',
                    ]],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', [ 'codeview', 'help']],
                    ['color', ['color']],
                    ['color', ['forecolor']],


                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description_ar', contents);
                    }

                }

            });
            Livewire.on('createDescription', function () {
                $('#description_ar').summernote('code', '')
            });
        });
        $(function() {
            $('#description_arEdit').summernote({
                height: 100,

                dialogsInBody: false,

                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear',
                        'strikethrough', 'superscript', 'subscript',
                        'fontname','fontsize','table','ul', 'ol', 'paragraph',
                    ]],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', [ 'codeview', 'help']],
                    ['color', ['color']],
                    ['color', ['forecolor']],


                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description_ar', contents);
                    }

                }

            });

            Livewire.on('showDescription', function () {
                $('#description_arEdit').summernote('code', document.querySelector('.body-content').value)
            });
        });


        $(function() {

            $('#description_en').summernote({
                height: 100,
                dialogsInBody: false,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear',
                        'strikethrough', 'superscript', 'subscript',
                        'fontname','fontsize','table','ul', 'ol', 'paragraph',
                    ]],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', [ 'codeview', 'help']],
                    ['color', ['color']],
                    ['color', ['forecolor']],


                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description_en', contents);
                    }

                }

            });
            Livewire.on('createDescription', function () {
                $('#description_en').summernote('code', '')
            });

        });
        $(function() {
            $('#description_enEdit').summernote({
                height: 100,

                dialogsInBody: false,

                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear',
                        'strikethrough', 'superscript', 'subscript',
                        'fontname','fontsize','table','ul', 'ol', 'paragraph',
                    ]],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', [ 'codeview', 'help']],
                    ['color', ['color']],
                    ['color', ['forecolor']],


                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description_en', contents);
                    }

                }

            });

            Livewire.on('showDescription', function () {
                $('#description_enEdit').summernote('code', document.querySelector('.body-content2').value)
            });
        });

    </script>



{{--    <script>--}}


{{--         window.onload = function () {--}}
            {{--if (document.querySelector('#description_ar')) {--}}
            {{--    ClassicEditor--}}
            {{--        .create( document.querySelector( '#description_ar' ), {--}}



            {{--            ckfinder: {--}}
            {{--                uploadUrl: '{{ route('admin.images.store'). '?_token='.csrf_token() }}'--}}
            {{--            },--}}
            {{--        } )--}}
            {{--        .then(editor => {--}}
            {{--            editor.model.document.on('change:data', () => {--}}
            {{--                document.querySelector('#description_ar').value = editor.getData();--}}
            {{--                @this.--}}
            {{--                set('description_ar', document.querySelector('#description_ar').value);--}}
            {{--            });--}}
{{--                        Livewire.on('createDescription', function () {--}}
{{--                            editor.setData('')--}}
{{--                        });--}}

            {{--        })--}}
            {{--        .catch(error => {--}}
            {{--            console.log(error.stack);--}}
            {{--        });--}}


            {{--}--}}


            {{--if (document.querySelector('#description_arEdit')) {--}}
            {{--    ClassicEditor--}}
            {{--        .create( document.querySelector( '#description_arEdit' ), {--}}
            {{--            ckfinder: {--}}
            {{--                uploadUrl: '{{ route('admin.images.store'). '?_token='.csrf_token() }}'--}}
            {{--            },--}}
            {{--        } )--}}
            {{--        .then(editor => {--}}
            {{--            editor.model.document.on('change:data', () => {--}}
            {{--                document.querySelector('#description_arEdit').value = editor.getData();--}}
            {{--                @this.--}}
            {{--                set('description_ar', document.querySelector('#description_arEdit').value);--}}
            {{--            });--}}
{{--                      Livewire.on('createNewPostEmit', function () {--}}
{{--                             editor.setData('')--}}
{{--                        });--}}
{{--                           Livewire.on('showDescription', function () {--}}
{{--                            editor.setData(document.querySelector('.body-content').value)--}}
{{--                      });--}}
            {{--        })--}}
            {{--        .catch(error => {--}}
            {{--            console.log(error.stack);--}}
            {{--        });--}}
            {{--}--}}

            {{--if (document.querySelector('#description_en')) {--}}
            {{--    ClassicEditor--}}
            {{--        .create( document.querySelector( '#description_en' ), {--}}
            {{--            ckfinder: {--}}
            {{--                uploadUrl: '{{ route('admin.images.store'). '?_token='.csrf_token() }}'--}}
            {{--            },--}}
            {{--        } )--}}
            {{--        .then(editor => {--}}
            {{--            editor.model.document.on('change:data', () => {--}}
            {{--                document.querySelector('#description_en').value = editor.getData();--}}
            {{--                @this.--}}
            {{--                set('description_en', document.querySelector('#description_en').value);--}}
            {{--            });--}}
{{--                        Livewire.on('createDescription', function () {--}}
{{--                             editor.setData('')--}}
            {{--            });--}}

            {{--        })--}}
            {{--        .catch(error => {--}}
            {{--            console.log(error.stack);--}}
            {{--        });--}}


            {{--}--}}
            {{--if (document.querySelector('#description_enEdit')) {--}}
            {{--    ClassicEditor.create( document.querySelector( '#description_enEdit' ), {--}}
            {{--        ckfinder: {--}}
            {{--            uploadUrl: '{{ route('admin.images.store'). '?_token='.csrf_token() }}'--}}
            {{--        },--}}
            {{--    } )--}}
            {{--        .then(editor => {--}}
            {{--            editor.model.document.on('change:data', () => {--}}
            {{--                document.querySelector('#description_enEdit').value = editor.getData();--}}
            {{--                @this.--}}
            {{--                set('description_en', document.querySelector('#description_enEdit').value);--}}
            {{--            });--}}
            {{--            // Livewire.on('createNewPostEmit', function () {--}}
            {{--            //     editor.setData('')--}}
            {{--            // });--}}
            {{--            Livewire.on('showDescription', function () {--}}
            {{--                editor.setData(document.querySelector('.body-content2').value)--}}
            {{--            });--}}
            {{--        })--}}
            {{--        .catch(error => {--}}
            {{--            console.log(error.stack);--}}
            {{--        });--}}
            {{--}--}}
{{--         }--}}
{{--    </script>--}}

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_service").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_service").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDeleteService', event => {
            $("#delete_service").click();
        });
    </script>

@endpush
