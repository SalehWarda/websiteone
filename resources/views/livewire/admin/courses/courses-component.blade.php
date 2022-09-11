@push('style')

@endpush
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">{{trans('courses.Courses')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_course"
                                >{{trans('courses.Add_Course')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>

                    </div>
                    <br>   <br>

            @include('pages.admin.courses.filter.filter')
                    <div class="row">
                        @forelse($courses as $course)
                            <div class="col-md-6 col-xl-4">

                                <div class="card">

                                    @if($course->firstMedia)
                                        <img class="card-img-top img-fluid"
                                             src="{{asset('assets/images/admin/courses/'.$course->firstMedia->file_name)}}"
                                             alt="{{$course->title}}">
                                    @else
                                        <img class="card-img-top img-fluid" src="{{asset('assets/images/noImage.jpg')}}"
                                             alt="{{$course->title}}">
                                    @endif


                                    <div class="card-body">
                                        <h4 class="card-title">{{$course->title}}</h4>

                                    </div>
                                    <ul class="list-group mb-3 list-group-flush">

                                        <li class="list-group-item d-flex justify-content-between">

                                            <span class="mb-0 text-muted">{{$course->created_at->format('M d')}}</span>
                                            @if( $course->status == 1 )

                                                <span class="badge rounded-pill bg-success">{{$course->status()}}</span>

                                            @else
                                                <span class="badge rounded-pill bg-danger">{{$course->status()}}</span>

                                            @endif

                                        </li>


                                        <li class="list-group-item d-flex justify-content-between">

                                            <span class="mb-0 text-muted">{{trans('courses.Instructor')}} :</span>
                                            <strong>{{$course->instructor}}</strong>

                                        </li>


                                    </ul>
                                    <div class="card-body d-flex justify-content-between">
                                        <a type="button" href="{{route('admin.videos',$course->id)}}" class="btn btn-info waves-effect waves-light">
                                            {{trans('courses.Course_videos')}}
                                        </a>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                {{trans('courses.Actions')}}<i class="mdi mdi-chevron-down"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-dark">

                                                <a class="dropdown-item" href="#"
                                                   wire:click="editCourse({{$course->id}})"
                                                   data-bs-toggle="modal" data-bs-target="#edit_course" title="{{trans('courses.Edit')}}">
                                                    <i class="ri-edit-2-fill align-middle me-2"></i>{{trans('courses.Edit')}}</a>

                                                <a class="dropdown-item" href="#"
                                                   wire:click="show_delete_course({{$course->id}})"
                                                   data-bs-toggle="modal" data-bs-target="#delete_course" title="{{trans('courses.Delete')}}">
                                                    <i class="ri-delete-bin-2-fill align-middle me-2"></i>{{trans('courses.Delete')}}</a>



                                                <a class="dropdown-item" href="#"
                                                   wire:click="showCourse({{$course->id}})" data-bs-toggle="modal"
                                                   data-bs-target="#show_course">
                                                    <i class="ri-eye-fill align-middle me-2"></i>{{trans('courses.More_Details')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- end col -->

                        @empty

                            <div>
                                <p  class="text-center"><strong>{{trans('courses.No_courses_found')}}</strong></p>
                            </div>
                        @endforelse
                        <div class="float-right pagination-rounded">


                            {{$courses->links()}}

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!--  Edit Course Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_course"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('courses.Course_Update')}}:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="title_ar" class="col-sm-2 col-form-label">

                                {{trans('courses.Title_In_Arabic')}}:</label>
                            <input class="form-control" type="text" name="title_ar"
                                   wire:model="title_ar"
                                   id="title_ar">
                            @error('title_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="title_en" class="col-sm-2 col-form-label">
                                {{trans('courses.Title_In_English')}}:</label>
                            <input class="form-control" type="text" name="title_en"
                                   wire:model="title_en"
                                   id="title_en">
                            @error('title_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="instructor" class="col-sm-2 col-form-label">
                                {{trans('courses.Instructor')}}:</label>
                            <input class="form-control" type="text" name="instructor"
                                   wire:model="instructor"
                                   id="instructor">
                            @error('instructor')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="deadline" class="col-sm-2 col-form-label">
                                {{trans('courses.Deadline')}}:</label>
                            <input class="form-control" type="text" name="deadline"
                                   wire:model="deadline"
                                   id="deadline">
                            @error('deadline')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="price"
                                   class="col-sm-2 col-form-label">{{trans('courses.Price')}}:</label>
                            <input class="form-control" type="number" name="price"
                                   wire:model="price" id="price">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('courses.Status')}}:</label>
                            <div class="form-group">
                                <select name="status" wire:model="status"
                                        class="form-control select2">
                                    <option value="" selected disabled="">{{trans('courses.Choose')}}...</option>
                                    <option
                                        value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                        {{trans('courses.Active')}}
                                    </option>
                                    <option
                                        value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>
                                        {{trans('courses.InActive')}}
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
                            <label for="description_arEdit"> {{trans('courses.Description_In_Arabic')}}:</label>

                            <div wire:ignore wire:key="myId">
                                <div id="description_arEdit" class="block mt-1 w-full">
                                    {!! $description_ar !!}
                                </div>
                            </div>

                            <textarea id="description_arEdit" hidden class="body-content"
                                      wire:model.debounce.2000ms="description_ar">
                                                        {!! $description_ar !!}
                                                           </textarea>
                            @error('description_ar')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="description_enEdit">{{trans('courses.Description_In_English')}}:</label>

                            <div wire:ignore wire:key="myId2">
                                <div id="description_enEdit" class="block mt-1 w-full">
                                    {!! $description_en !!}
                                </div>
                            </div>

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
                                <h4 class="card-title">{{trans('courses.Course_Image')}}:</h4>

                                <p class="card-title-desc"><span class="text-danger">  {{trans('courses.Note')}} : </span>
                                    {{trans('courses.Note_Message')}}<br>
                                    الأفضل لمقاس الصورة أن يكون 500px x 500px
                                </p>
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
                            wire:click="updateCourse"> {{trans('courses.Saving_changes')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                            type="button">{{trans('courses.Close')}}
                    </button>
                </div>


            </div>
        </div>
    </div>


    <!-- Delete Courses Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="delete_course"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">{{trans('courses.Course_Delete')}} </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" wire:model="course_id">

                    <h4>{{trans('courses.Delete_Message')}}</h4>

                    <h5><span class="text-danger">{{$course_title}}</span></h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">{{trans('courses.Close')}}
                    </button>
                    <button type="submit" wire:click="delete_course"
                            class="btn btn-danger waves-effect waves-light">{{trans('courses.Delete')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--  Add Course Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_course"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('courses.Add_New_Course')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="title_ar" class="col-sm-2 col-form-label">{{trans('courses.Title_In_Arabic')}}:</label>
                            <input class="form-control" type="text" name="title_ar" wire:model="title_ar"
                                   id="title_ar">
                            @error('title_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="title_en" class="col-sm-2 col-form-label">{{trans('courses.Title_In_English')}}:</label>
                            <input class="form-control" type="text" name="title_en" wire:model="title_en"
                                   id="title_en">
                            @error('title_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="instructor" class="col-sm-2 col-form-label">{{trans('courses.Instructor')}}:</label>
                            <input class="form-control" type="text" name="instructor" wire:model="instructor"
                                   id="instructor">
                            @error('instructor')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="deadline" class="col-sm-2 col-form-label">{{trans('courses.Deadline')}}:</label>
                            <input class="form-control" type="text" name="deadline" wire:model="deadline"
                                   id="deadline">
                            @error('deadline')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="price" class="col-sm-2 col-form-label">{{trans('courses.Price')}}:</label>
                            <input class="form-control" type="number" name="price" wire:model="price" id="price">
                            @error('price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('courses.Status')}}:</label>
                            <div class="form-group">
                                <select name="status" wire:model="status" class="form-control select2">
                                    <option value="" selected >{{trans('courses.Choose')}}...</option>
                                    <option
                                        value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                        {{trans('courses.Active')}}
                                    </option>
                                    <option
                                        value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>
                                        {{trans('courses.InActive')}}
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
                            <label for="description_ar"> {{trans('courses.Description_In_Arabic')}}:</label>

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
                            <label for="description_en">{{trans('courses.Description_In_English')}}:</label>

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
                                <h4 class="card-title">{{trans('courses.Course_Image')}}:</h4>

                                <p class="card-title-desc"><span class="text-danger">  {{trans('courses.Note')}} : </span>
                                    {{trans('courses.Note_Message')}}<br>
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
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="addCourse"> {{trans('courses.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('courses.Close')}}</button>
                </div>


            </div>
        </div>
    </div>


    <!--  Show Course Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="show_course"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('courses.More_Details')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xl-3 col-xxl-4 col-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">

                                        @if ($imageDB)
                                            <div
                                                class="img-fluid">

                                                <img src="{{ asset('assets/images/admin/courses/' . $imageDB->file_name) }}"
                                                     width="100%">

                                            </div>

                                        @endif


                                        <div class="card-body">
                                            <h4 class="mb-0">{{$course_title}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h1 class="card-title">{{trans('courses.Course_information')}}</h1>
                                        </div>
                                        <div class="card-body pb-0">
                                            <p>{{trans('courses.Other_details_about_the_course')}} :</p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex px-0 justify-content-between">
                                                    <strong>{{trans('courses.Deadline')}} :</strong>
                                                    <span class="mb-0" wire:model="deadline">{{$deadline}}</span>
                                                </li>
                                                <li class="list-group-item d-flex px-0 justify-content-between">
                                                    <strong>{{trans('courses.Instructor')}} :</strong>
                                                    <span class="mb-0" wire:model="instructor">{{$instructor}} </span>
                                                </li>
                                                <li class="list-group-item d-flex px-0 justify-content-between">
                                                    <strong>{{trans('courses.Price')}} :</strong>
                                                    <span class="mb-0" wire:model="price">{{$price}} {{trans('courses.RS')}} </span>
                                                </li>
                                                <li class="list-group-item d-flex px-0 justify-content-between">
                                                    <strong>{{trans('courses.Created_at')}} :</strong>
                                                    <span class="mb-0" wire:model="created_at">{{$created_at}}</span>
                                                </li>
{{--                                                <li class="list-group-item d-flex px-0 justify-content-between">--}}
{{--                                                    <strong>{{trans('courses.Status')}} :</strong>--}}
{{--                                                    @if( $status == 1 )--}}

{{--                                                        <span class="mb-0 rounded-pill badge bg-success"--}}
{{--                                                              wire:model="status">{{$status}}</span>--}}

{{--                                                    @else--}}
{{--                                                        <span class="mb-0 rounded-pill badge bg-danger"--}}
{{--                                                              wire:model="status">{{$status}}</span>--}}

{{--                                                    @endif--}}
{{--                                                </li>--}}
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-xxl-8 col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="text-primary"> تفاصيل الدورة :</h4>
                                    <ul class="list-group mb-3 list-group-flush">
                                        <li class="list-group-item border-0 px-0">
                                            {!! $description !!}
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


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



{{--        window.onload = function () {--}}
{{--            if (document.querySelector('#description_ar')) {--}}
{{--                ClassicEditor.create(document.querySelector('#description_ar'), {--}}



{{--                })--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#description_ar').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('description_ar', document.querySelector('#description_ar').value);--}}
{{--                        });--}}
{{--                        Livewire.on('createDescription', function () {--}}
{{--                            editor.setData('')--}}
{{--                        });--}}

{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}
{{--            }--}}


{{--            if (document.querySelector('#description_arEdit')) {--}}
{{--                import Table from '@ckeditor/ckeditor5-table/src/table';--}}
{{--                import TableToolbar from '@ckeditor/ckeditor5-table/src/tabletoolbar';--}}
{{--                import TableCaption from '@ckeditor/ckeditor5-table/src/tablecaption';--}}
{{--                ClassicEditor.create(document.querySelector('#description_arEdit'), {--}}


{{--                    plugins: [ Table, TableToolbar, TableCaption, Bold],--}}
{{--                    toolbar: [ 'insertTable'],--}}
{{--                    table: {--}}
{{--                        contentToolbar: [--}}
{{--                            'toggleTableCaption'--}}
{{--                        ]--}}
{{--                    },--}}
{{--                    ckfinder: {--}}
{{--                        uploadUrl: '{{ route('admin.images.store'). '?_token='.csrf_token() }}'--}}
{{--                    },--}}
{{--                })--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#description_arEdit').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('description_ar', document.querySelector('#description_arEdit').value);--}}
{{--                        });--}}
{{--                        // Livewire.on('createNewPostEmit', function () {--}}
{{--                        //     editor.setData('')--}}
{{--                        // });--}}
{{--                        Livewire.on('showDescription', function () {--}}
{{--                            editor.setData(document.querySelector('.body-content').value)--}}
{{--                        });--}}
{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}
{{--            }--}}

{{--            if (document.querySelector('#description_en')) {--}}
{{--                ClassicEditor.create(document.querySelector('#description_en'), {})--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#description_en').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('description_en', document.querySelector('#description_en').value);--}}
{{--                        });--}}
{{--                        Livewire.on('createDescription', function () {--}}
{{--                            editor.setData('')--}}
{{--                        });--}}

{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}


{{--            }--}}
{{--            if (document.querySelector('#description_enEdit')) {--}}
{{--                ClassicEditor.create(document.querySelector('#description_enEdit'), {})--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#description_enEdit').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('description_en', document.querySelector('#description_enEdit').value);--}}
{{--                        });--}}
{{--                        // Livewire.on('createNewPostEmit', function () {--}}
{{--                        //     editor.setData('')--}}
{{--                        // });--}}
{{--                        Livewire.on('showDescription', function () {--}}
{{--                            editor.setData(document.querySelector('.body-content2').value)--}}
{{--                        });--}}
{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}
{{--            }--}}


{{--        }--}}
{{--    </script>--}}

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_course").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_course").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDeleteC', event => {
            $("#delete_course").click();
        });
    </script>

@endpush
