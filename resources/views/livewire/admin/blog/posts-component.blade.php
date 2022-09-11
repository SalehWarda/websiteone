<div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">{{trans('posts.Blog')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_post"
                                >{{trans('posts.Add_Post')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                    @include('pages.admin.posts.filter.filter')

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('posts.Image')}}</th>
                                <th>{{trans('posts.Title')}}</th>
                                <th>{{trans('posts.Content')}}</th>
                                <th>{{trans('posts.Created_by')}}</th>
                                <th>{{trans('posts.Status')}}</th>
                                <th>{{trans('posts.Date_of_publication')}}</th>
                                <th>{{trans('posts.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($posts as $post)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        @if($post->firstMedia)
                                            <img
                                                src="{{asset('assets/images/admin/posts/'.$post->firstMedia->file_name)}}"
                                                width="60" height="60" alt="{{$post->title}}">
                                        @else
                                            <img src="{{asset('assets/images/noImage.jpg')}}" width="60" height="60"
                                                 alt="{{$post->title}}">
                                        @endif

                                    </td>
                                    <td><strong>{{$post->title}}</strong><br>
                                    <small>{{$post->created_at->format('Y M d')}}</small>
                                    </td>
                                    <td>{!! \Illuminate\Support\Str::limit($post->content, 30, '...')  !!}</td>
                                    <td>{{$post->created_by}}<br>

                                    </td>

                                    <td  @if($post->status == 0) wire:poll.keep-alive @endif>


                                                 {{ $post->date_of_publication->format('Y-m-d h:i') == now()->format('Y-m-d H:i') ? $post->date_of_publication_status() : '' }}

                                            @if($post->status == 1)
                                                <span class="badge rounded-pill bg-success">{{$post->status()}}</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">{{$post->status()}}</span>
                                            @endif
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($post->date_of_publication)->format('Y-m-d h:i A')}}</td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editPost({{$post->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_post"
                                                    title="{{trans('posts.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('posts.Edit')}}
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_post({{$post->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_post"
                                                    title="{{trans('posts.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('posts.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>


                                <!-- Edit Social Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_post"
                                     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('posts.Post_Update')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <input type="hidden" wire:model="post_id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="title_ar" class="col-sm-2 col-form-label">{{trans('posts.Title_In_Arabic')}}</label>
                                                        <input class="form-control" type="text" name="title"
                                                               wire:model="title_ar"
                                                               id="title_ar">
                                                        @error('title_ar')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="title_en" class="col-sm-2 col-form-label">

                                                            {{trans('posts.Title_In_English')}}:</label>
                                                        <input class="form-control" type="text" name="title"
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
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('posts.Status')}}:</label>
                                                        <div class="form-group">
                                                            <select name="status" wire:model="status"
                                                                    class="form-control select2">
                                                                <option value="" selected>{{trans('posts.Choose')}}...</option>
                                                                <option
                                                                    value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                                                    {{trans('posts.Active')}}
                                                                </option>
                                                                <option
                                                                    value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>
                                                                    {{trans('posts.InActive')}}
                                                                </option>

                                                            </select>
                                                            @error('status')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="example-datetime-local-input" class="col-sm-2 col-form-label">{{trans('posts.Date_of_publication')}}:</label>
                                                        <div class="form-group">
                                                            <div class="row mb-3">

                                                                <input class="form-control" type="datetime-local" wire:model="date_of_publication"  id="example-datetime-local-input">

                                                            </div>
                                                            @error('date_of_publication')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror

                                                        </div>

                                                    </div>



                                                </div>
                                                <br>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label for="content_arEdit"> {{trans('posts.Content_In_Arabic')}}:</label>

                                                        <div wire:ignore wire:key="myId">
                                                            <div id="content_arEdit" class="block mt-1 w-full">
                                                                {!! $content_ar !!}
                                                            </div>
                                                        </div>

                                                        <textarea id="content_arEdit" hidden class="body-content"
                                                                  wire:model.debounce.2000ms="content_ar">
                                                        {!! $content_ar !!}
                                                           </textarea>
                                                        @error('content_ar')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="content_enEdit">{{trans('posts.Content_In_English')}}:</label>

                                                        <div wire:ignore wire:key="myId2">
                                                            <div id="content_enEdit" class="block mt-1 w-full">
                                                                {!! $content_en !!}
                                                            </div>
                                                        </div>

                                                        <textarea id="content_enEdit" hidden class="body-content2"
                                                                  wire:model.debounce.2000ms="content_en">
                                                    {!! $content_en !!}
                                                           </textarea>
                                                        @error('content_en')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>


                                                </div>
                                                <br>


                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{trans('posts.Post_Images')}}:</h4>
                                                            <p class="card-title-desc"><span class="text-danger">  {{trans('posts.Note')}} : </span>
                                                                {{trans('posts.Note_Message')}}<br>
                                                                الأفضل لمقاس الصورة أن يكون 500px x 500px
                                                            </p>
                                                            <div class="d-flex py-3 ">
                                                                @if($post->media()->count() > 0)

                                                                    @if($imagesDB)

                                                                        @foreach($imagesDB as $media)
                                                                            <div
                                                                                class="mt-1 mx-1 d-flex rounded-md shadow-sm">
                                                                            <span
                                                                                class="inline-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">

                                                                                    <img
                                                                                        src="{{ asset('assets/images/admin/posts/' . $media->file_name) }}"
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
                                                        wire:click="updatePost"> {{trans('posts.Saving_changes')}}<i
                                                        class="fe fe-plus"></i></button>
                                                <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                        type="button">{{trans('posts.Close')}}
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>



                                <!-- Delete Social Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog"
                                     id="delete_post" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel">{{trans('posts.Post_Delete')}} </h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" wire:model="post_id">

                                                <h4>{{trans('posts.Delete_Message')}} </h4>

                                                <h5><span class="text-danger">{{$title}}</span></h5>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                        data-bs-dismiss="modal">{{trans('posts.Close')}}
                                                </button>
                                                <button type="submit" wire:click="deletePost"
                                                        class="btn btn-danger waves-effect waves-light">{{trans('posts.Delete')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                                <tr>
                                    <td colspan="8" class="text-center">{{trans('posts.No_posts_found')}}</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="float-right pagination-rounded">


                                        {{$posts->links()}}

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


    <!--  Add ServiceQuestion Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_post"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('posts.Add_New_Post')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <label for="title_ar" class="col-sm-2 col-form-label">{{trans('posts.Title_In_Arabic')}}:</label>
                            <input class="form-control" type="text" name="title" wire:model="title_ar"
                                   id="title_ar">
                            @error('title_ar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="title_en" class="col-sm-2 col-form-label">{{trans('posts.Title_In_English')}}:</label>
                            <input class="form-control" type="text" name="title" wire:model="title_en"
                                   id="title_en">
                            @error('title_en')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                    </div>
                    <br>

                    <div class="row">


                        <div class="col-md-6">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('posts.Status')}}:</label>
                            <div class="form-group">
                                <select name="status" wire:model="status" class="form-control select2">
                                    <option value="" selected >{{trans('posts.Choose')}}...</option>
                                    <option
                                        value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>
                                        {{trans('posts.Active')}}
                                    </option>
                                    <option
                                        value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>
                                        {{trans('posts.InActive')}}
                                    </option>

                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>

                        <div class="col-md-6">
                            <label for="example-datetime-local-input" class="col-sm-2 col-form-label">{{trans('posts.Date_of_publication')}}:</label>
                            <div class="form-group">
                                <div class="row mb-3">

                                        <input class="form-control" type="datetime-local" name="date_of_publication" wire:model="date_of_publication" value="" id="example-datetime-local-input">

                                </div>
                                @error('date_of_publication')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>


                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="content_ar"> {{trans('posts.Content_In_Arabic')}}:</label>

                            <div wire:ignore wire:key="myId">
                                <div id="content_ar" class="block mt-1 w-full">
                                    {!! $content_ar !!}
                                </div>
                            </div>

                            <textarea id="content_ar" hidden class="body-content"
                                      wire:model.debounce.2000ms="content_ar">
                                                        {!! $content_ar !!}
                                                           </textarea>
                            @error('content_ar')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="content_en">{{trans('posts.Content_In_English')}}:</label>

                            <div wire:ignore wire:key="myId2">
                                <div id="content_en" class="block mt-1 w-full">
                                    {!! $content_en !!}
                                </div>
                            </div>

                            <textarea id="content_en" hidden class="body-content2"
                                      wire:model.debounce.2000ms="content_en">
                                                    {!! $content_en !!}
                                                           </textarea>
                            @error('content_en')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>


                    </div>
                    <br>


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{trans('posts.Post_Images')}}:</h4>
                                <p class="card-title-desc"><span class="text-danger">  {{trans('posts.Note')}} : </span>
                                    {{trans('posts.Note_Message')}}<br>
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
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="addPost"> {{trans('posts.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('posts.Close')}}</button>
                </div>


            </div>
        </div>
    </div>

</div>
@push('scripts')
{{--    <script>--}}
{{--        $(document).ready(--}}
{{--            function() {--}}
{{--                setInterval(function() {--}}
{{--                    var randomnumber = Math.floor(Math.random() * 100);--}}
{{--                    $('#sss').text(--}}
{{--                        'I am getting refreshed every 3 seconds..! Random Number ==> '--}}
{{--                        + randomnumber);--}}
{{--                }, 3000);--}}
{{--            });--}}
{{--    </script>--}}

{{--    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>--}}


<script>
    $(function() {

        $('#content_ar').summernote({
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
                    @this.set('content_ar', contents);
                }

            }

        });
        Livewire.on('createContent', function () {
            $('#content_ar').summernote('code', '')
        });
    });
    $(function() {
        $('#content_arEdit').summernote({
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
                    @this.set('content_ar', contents);
                }

            }

        });

        Livewire.on('showContent', function () {
            $('#content_arEdit').summernote('code', document.querySelector('.body-content').value)
        });
    });


    $(function() {

        $('#content_en').summernote({
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
                    @this.set('content_en', contents);
                }

            }

        });
        Livewire.on('createContent', function () {
            $('#content_en').summernote('code', '')
        });

    });
    $(function() {
        $('#content_enEdit').summernote({
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
                    @this.set('content_en', contents);
                }

            }

        });

        Livewire.on('showContent', function () {
            $('#content_enEdit').summernote('code', document.querySelector('.body-content2').value)
        });
    });

</script>


{{--    <script>--}}
{{--        window.onload = function () {--}}
{{--            if (document.querySelector('#content_ar')) {--}}
{{--                ClassicEditor.create(document.querySelector('#content_ar'), {})--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#content_ar').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('content_ar', document.querySelector('#content_ar').value);--}}
{{--                        });--}}
{{--                        Livewire.on('createContent', function () {--}}
{{--                            editor.setData('')--}}
{{--                        });--}}

{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}
{{--            }--}}


{{--            if (document.querySelector('#content_arEdit')) {--}}
{{--                ClassicEditor.create(document.querySelector('#content_arEdit'), {})--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#content_arEdit').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('content_ar', document.querySelector('#content_arEdit').value);--}}
{{--                        });--}}
{{--                        // Livewire.on('createNewPostEmit', function () {--}}
{{--                        //     editor.setData('')--}}
{{--                        // });--}}
{{--                        Livewire.on('showContent', function () {--}}
{{--                            editor.setData(document.querySelector('.body-content').value)--}}
{{--                        });--}}
{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}
{{--            }--}}

{{--            if (document.querySelector('#content_en')) {--}}
{{--                ClassicEditor.create(document.querySelector('#content_en'), {})--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#content_en').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('content_en', document.querySelector('#content_en').value);--}}
{{--                        });--}}
{{--                        Livewire.on('createContent', function () {--}}
{{--                            editor.setData('')--}}
{{--                        });--}}

{{--                    })--}}
{{--                    .catch(error => {--}}
{{--                        console.log(error.stack);--}}
{{--                    });--}}


{{--            }--}}
{{--            if (document.querySelector('#content_enEdit')) {--}}
{{--                ClassicEditor.create(document.querySelector('#content_enEdit'), {})--}}
{{--                    .then(editor => {--}}
{{--                        editor.model.document.on('change:data', () => {--}}
{{--                            document.querySelector('#content_enEdit').value = editor.getData();--}}
{{--                            @this.--}}
{{--                            set('content_en', document.querySelector('#content_enEdit').value);--}}
{{--                        });--}}
{{--                        // Livewire.on('createNewPostEmit', function () {--}}
{{--                        //     editor.setData('')--}}
{{--                        // });--}}
{{--                        Livewire.on('showContent', function () {--}}
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
            $("#add_post").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_post").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDelete', event => {
            $("#delete_post").click();
        });
    </script>

@endpush
