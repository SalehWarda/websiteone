@extends('layouts.admin')

@section('title')
    {{trans('about.About_Me')}}
@endsection

@section('style')


@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{trans('about.About_Me')}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">{{trans('about.About_Me')}}</li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{trans('about.Home')}}</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{--                            <div class="d-block d-md-flex justify-content-between">--}}
                            {{--                                <div class="d-block">--}}
                            {{--                                    <a href=""--}}
                            {{--                                       class="btn btn-outline-success waves-effect waves-light btn-rounded"--}}
                            {{--                                    >رجوع <i class="fa fa-arrow-circle-right"></i>--}}
                            {{--                                    </a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <br>


                            <form action="{{route('admin.about.update')}}" method="post" enctype="multipart/form-data">

                                @csrf
                                @method('PATCH')
                                <input type="hidden" value="{{$about->id}}" name="about_id">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="name_ar"
                                               class="col-sm-2 col-form-label">{{trans('about.Name_In_Arabic')}}:</label>
                                        <input class="form-control" type="text"
                                               value="{{$about->getTranslation('name','ar')}}" name="name_ar"
                                               id="name_ar">
                                        @error('name_ar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="name_en"
                                               class="col-sm-2 col-form-label">{{trans('about.Name_In_English')}}:</label>
                                        <input class="form-control" type="text"
                                               value="{{$about->getTranslation('name','en')}}" name="name_en"
                                               id="name_en">
                                        @error('name_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="address_ar"
                                               class="col-sm-2 col-form-label"> {{trans('about.Address_In_Arabic')}}:</label>
                                        <input class="form-control" type="text"
                                               value="{{$about->getTranslation('address','ar')}}" name="address_ar"
                                               id="address_ar">
                                        @error('address_ar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="address_en"
                                               class="col-sm-2 col-form-label">{{trans('about.Address_In_English')}}:</label>
                                        <input class="form-control" type="text"
                                               value="{{$about->getTranslation('address','en')}}" name="address_en"
                                               id="address_en">
                                        @error('address_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>





                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="email" class="col-sm-2 col-form-label">{{trans('about.Email')}}:</label>
                                        <input class="form-control" type="email"
                                               value="{{$about->email}}" name="email"
                                               id="email">
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="mobile" class="col-sm-2 col-form-label">{{trans('about.Mobile')}}:</label>
                                        <input class="form-control" type="text"
                                               value="{{$about->mobile}}" name="mobile"
                                               id="mobile">
                                        @error('mobile')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-6">
                                        <label for="degree_ar" class="col-sm-2 col-form-label">

                                            {{trans('about.Degree_In_Arabic')}}:</label>
                                        <input class="form-control" type="text" name="degree_ar"
                                               value="{{$about->getTranslation('degree','ar')}}"
                                               id="degree_ar">
                                        @error('degree_ar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="degree_en" class="col-sm-2 col-form-label">
                                            {{trans('about.Degree_In_English')}}:</label>
                                        <input class="form-control" type="text" name="degree_en"
                                               value="{{$about->getTranslation('degree','en')}}"
                                               id="degree_en">
                                        @error('degree_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                </div>
                                <br>


                                <div class="row">

                                    <div class="col-6">
                                        <label for="bio_ar"> {{trans('about.Bio_In_Arabic')}}:</label>

                                        <textarea id="bio_ar" hidden name="bio_ar" class="body-content"
                                        >
                                                        {!! $about->getTranslation('bio','ar') !!}
                                                           </textarea>
                                        @error('bio_ar')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="bio_en">{{trans('about.Bio_In_English')}}:</label>

                                        <textarea id="bio_en" hidden name="bio_en" class="body-content2"
                                        >
                                                     {!! $about->getTranslation('bio','en') !!}
                                                           </textarea>
                                        @error('bio_en')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>


                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-6">
                                        <label for="education_ar"> {{trans('about.Education_In_Arabic')}}:</label>

                                        <textarea id="education_ar" hidden name="education_ar" class="body-content"
                                        >
                                                        {!! $about->getTranslation('education','ar') !!}
                                                           </textarea>
                                        @error('education_ar')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="education_en">{{trans('about.Education_In_English')}}:</label>

                                        <textarea id="education_en" hidden name="education_en" class="body-content2"
                                        >
                                                     {!! $about->getTranslation('education','en') !!}
                                                           </textarea>
                                        @error('education_en')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>


                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-6">
                                        <label for="experiences_ar"> {{trans('about.Experiences_In_Arabic')}}:</label>

                                        <textarea id="experiences_ar" hidden name="experiences_ar" class="body-content"
                                        >
                                                        {!! $about->getTranslation('experiences','ar') !!}
                                                           </textarea>
                                        @error('experiences_ar')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="experiences_en">{{trans('about.Experiences_In_English')}}:</label>

                                        <textarea id="experiences_en" hidden name="experiences_en" class="body-content2"
                                        >
                                                     {!! $about->getTranslation('experiences','en') !!}
                                                           </textarea>
                                        @error('experiences_en')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>


                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-6">
                                        <label for="goals_ar"> {{trans('about.Goals_In_Arabic')}}:</label>

                                        <textarea id="goals_ar" hidden name="goals_ar" class="body-content"
                                        >
                                                        {!! $about->getTranslation('goals','ar') !!}
                                                           </textarea>
                                        @error('goals_ar')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="goals_en">{{trans('about.Goals_In_English')}}:</label>

                                        <textarea id="goals_en" hidden name="goals_en" class="body-content2"
                                        >
                                                     {!! $about->getTranslation('goals','en') !!}
                                                           </textarea>
                                        @error('goals_en')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>


                                </div>
                                <br>

                                <livewire:admin.about.about-component :about="$about"/>


                                <button class="btn ripple btn-secondary m-lg-2" type="submit">
                                    {{trans('about.Saving_changes')}}<i
                                        class="fe fe-plus"></i></button>
                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@push('scripts')

{{--    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>--}}



    <script>



                $(function() {

                    $('#bio_ar').summernote({
                        height: 100,

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


                    });

                });

                $(function() {

                    $('#bio_en').summernote({
                        height: 100,

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


                    });

                });

                $(function() {

                    $('#education_ar').summernote({
                        height: 100,

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


                    });

                });

                $(function() {

                    $('#education_en').summernote({
                        height: 100,

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


                    });

                });

                $(function() {

                    $('#experiences_ar').summernote({
                        height: 100,

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


                    });

                });

                $(function() {

                    $('#experiences_en').summernote({
                        height: 100,

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


                    });

                });

                 $(function() {

                    $('#goals_ar').summernote({
                        height: 100,

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


                    });

                });

                $(function() {

                    $('#goals_en').summernote({
                        height: 100,

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


                    });

                });



        </script>


{{--    <script>--}}
{{--         if (document.querySelector('#bio_ar')) {--}}
{{--             ClassicEditor.create(document.querySelector('#bio_ar'), {})--}}
{{--                .then(editor => {--}}
{{--                    editor.model.document.on('change:data', () => {--}}
{{--                        document.querySelector('#bio_ar').value = editor.getData();--}}
{{--        --}}
{{--                     });--}}
{{--        --}}

{{--                })--}}
{{--               .catch(error => {--}}
{{--                  console.log(error.stack);--}}
{{--                 });--}}
{{--}--}}
{{--         if (document.querySelector('#bio_en')) {--}}
{{--             ClassicEditor.create(document.querySelector('#bio_en'), {})--}}
{{--                 .then(editor => {--}}
{{--                     editor.model.document.on('change:data', () => {--}}
{{--                        document.querySelector('#bio_en').value = editor.getData();--}}
{{--        --}}
{{--                     });--}}
{{--                      Livewire.on('createNewPostEmit', function () {--}}
{{--                        editor.setData('')--}}
{{--                      });--}}
{{--        --}}
{{--                })--}}
{{--                 .catch(error => {--}}
{{--                     console.log(error.stack);--}}
{{--                 });--}}
{{--         }--}}


{{--         if (document.querySelector('#education_ar')) {--}}
{{--             ClassicEditor.create(document.querySelector('#education_ar'), {})--}}
{{--                 .then(editor => {--}}
{{--                    editor.model.document.on('change:data', () => {--}}
{{--                         document.querySelector('#education_ar').value = editor.getData();--}}
{{--        --}}
{{--                    });--}}
{{--        --}}
{{--        --}}
{{--                 })--}}
{{--                 .catch(error => {--}}
{{--                     console.log(error.stack);--}}
{{--                 });--}}
{{--        }--}}
{{--        if (document.querySelector('#education_en')) {--}}
{{--            ClassicEditor.create(document.querySelector('#education_en'), {})--}}
{{--                 .then(editor => {--}}
{{--                    editor.model.document.on('change:data', () => {--}}
{{--                        document.querySelector('#education_en').value = editor.getData();--}}
{{--        --}}
{{--                    });--}}
{{--        --}}
{{--        --}}
{{--                 })--}}
{{--                 .catch(error => {--}}
{{--                    console.log(error.stack);--}}
{{--                });--}}
{{--         }--}}


{{--         if (document.querySelector('#experiences_ar')) {--}}
{{--             ClassicEditor.create(document.querySelector('#experiences_ar'), {})--}}
{{--                 .then(editor => {--}}
{{--                     editor.model.document.on('change:data', () => {--}}
{{--                         document.querySelector('#experiences_ar').value = editor.getData();--}}
{{--        --}}
{{--                    });--}}
{{--        --}}
{{--        --}}
{{--                 })--}}
{{--                .catch(error => {--}}
{{--                    console.log(error.stack);--}}
{{--                 });--}}
{{--         }--}}
{{--         if (document.querySelector('#experiences_en')) {--}}
{{--             ClassicEditor.create(document.querySelector('#experiences_en'), {})--}}
{{--                 .then(editor => {--}}
{{--                    editor.model.document.on('change:data', () => {--}}
{{--                        document.querySelector('#experiences_en').value = editor.getData();--}}
{{--        --}}
{{--                     });--}}
{{--        --}}
{{--        --}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.log(error.stack);--}}
{{--                 });--}}
{{--         }--}}


{{--        if (document.querySelector('#goals_ar')) {--}}
{{--             ClassicEditor.create(document.querySelector('#goals_ar'), {})--}}
{{--               .then(editor => {--}}
{{--                     editor.model.document.on('change:data', () => {--}}
{{--                         document.querySelector('#goals_ar').value = editor.getData();--}}

{{--                    });--}}
{{--        --}}
{{--        --}}
{{--                 })--}}
{{--                 .catch(error => {--}}
{{--                    console.log(error.stack);--}}
{{--                 });--}}
{{--         }--}}
{{--         if (document.querySelector('#goals_en')) {--}}
{{--            ClassicEditor.create(document.querySelector('#goals_en'), {})--}}
{{--                .then(editor => {--}}
{{--                    editor.model.document.on('change:data', () => {--}}
{{--                        document.querySelector('#goals_en').value = editor.getData();--}}
{{--        --}}
{{--                    });--}}
{{--        --}}
{{--        --}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.log(error.stack);--}}
{{--                });--}}
{{--         }--}}

{{--    </script>--}}

@endpush
