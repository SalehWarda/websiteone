@push('style')



@endpush


<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0">{{trans('videos.Videos')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_video"
                                >{{trans('videos.Add_Video')}} <i class="ri-video-upload-fill align-middle me-2"></i>
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
                                <th>{{trans('videos.Image')}}</th>
                                <th>{{trans('videos.Title')}}</th>
                                <th>{{trans('videos.Status')}}</th>
                                <th>{{trans('videos.Created_at')}}</th>
                                <th>{{trans('videos.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($videos as $video)
                                <tr @if($video->processing_percentage < 100) wire:poll @endif>

                                    <th scope="row">{{$loop->iteration}}</th>


                                    <td>
                                        @if($video->processing_percentage < 100)
                                            <div class="spinner-border text-dark m-1" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        @else

                                            @if($video->thumbnail)
                                                <img
                                                    src="{{asset($video->thumbnail)}}"
                                                    width="60" height="60" alt="{{$video->title}}">
                                            @else
                                                <img src="{{asset($video->thumbnail)}}" width="60" height="60"
                                                     alt="{{$video->title}}">
                                            @endif
                                        @endif
                                    </td>


                                    <td>
                                        @if($video->processing_percentage < 100)
                                            {{trans('videos.Processing_video')}}...({{$video->processing_percentage}}%)
                                        @else
                                            {{$video->title}}
                                            <br>
                                            {!!\Illuminate\Support\Str::limit($video->description, 50, '....')  !!}
                                        @endif

                                    </td>
                                    <td>{{$video->visibility()}}</td>
                                    <td>{{$video->created_at->format('Y M d') }} </td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editVideo({{$video->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_video" title="{{trans('videos.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('videos.Edit')}}
                                            </button>
                                            <a type="button" href="{{route('admin.videos.watch',$video->id)}}"
                                                    class="btn btn-dark waves-effect waves-light btn-rounded"
                                                    title="{{trans('videos.Play')}}">

                                                <i class="ri-video-fill align-middle me-2"></i>{{trans('videos.Play')}}
                                            </a>
                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_video({{$video->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_video" title="{{trans('videos.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('videos.Delete')}}
                                            </button>


                                        </div>
                                    </td>
                                </tr>



                                <!--  Edit Service Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_video"
                                     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('videos.Video_Update')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" wire:model="video_id" name="video_id">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="title" class="col-sm-2 col-form-label">
                                                            {{trans('videos.Title')}}:</label>
                                                        <input class="form-control" type="text" name="title"
                                                               wire:model="title"
                                                               id="title">
                                                        @error('title')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <br>

                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('videos.Status')}}:</label>
                                                        <div class="form-group">
                                                            <select name="visibility" wire:model="visibility"
                                                                    class="form-control select2">
                                                                <option value="" selected disabled="">{{trans('videos.Choose')}}...</option>
                                                                <option
                                                                    value="public" {{old('visibility',request()->input('visibility')) == 'public' ? 'selected' : ''}}>
                                                                    {{trans('videos.Public')}}
                                                                </option>
                                                                <option
                                                                    value="private" {{old('visibility',request()->input('visibility')) == 'private' ? 'selected' : ''}}>
                                                                    {{trans('videos.Private')}}
                                                                </option>



                                                            </select>


                                                        </div>
                                                        @error('visibility')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>


                                                </div>
                                                <br>


                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label for="descriptionEdit"> {{trans('videos.Description')}} :</label>

                                                        <div wire:ignore wire:key="myId">
                                                            <div id="descriptionEdit" class="block mt-1 w-full">
                                                                {!! $description !!}
                                                            </div>
                                                        </div>

                                                        <textarea id="descriptionEdit" hidden class="body-content2"
                                                                  wire:model.debounce.2000ms="description">
                                                        {!! $description !!}
                                                           </textarea>
                                                        @error('description')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>


                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">


                                                        <img class="img-thumbnail" alt="200x200" width="200"
                                                             src="{{asset($thumbnail)}}" data-holder-rendered="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button class="btn ripple btn-secondary m-lg-2" type="submit"
                                                        wire:click="updateVideo"> {{trans('videos.Save')}}<i
                                                        class="fe fe-plus"></i></button>
                                                <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                        type="button">{{trans('videos.Close')}}
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>




                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">{{trans('videos.No_videos_found')}}</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="float-right pagination-rounded">


                                        {{$videos->links()}}

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
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="delete_video"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">{{trans('videos.Video_Delete')}} </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" wire:model="video_id">

                    <h4>{{trans('videos.Delete_Message')}}</h4>

                    <h5><span class="text-danger">{{$title}}</span></h5>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect"
                            data-bs-dismiss="modal">{{trans('videos.Close')}}
                    </button>
                    <button type="submit" wire:click="delete_video"
                            class="btn btn-danger waves-effect waves-light">{{trans('videos.Delete')}}
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!--  Add Video Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_video"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('videos.Add_New_Video')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="{{$course->id}}" name="course_id">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title" class="col-sm-2 col-form-label">{{trans('videos.Title')}}:</label>
                            <input class="form-control" type="text" name="title" wire:model="title"
                                   id="title">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                    <br>

                    <div class="row">

                        <div class="col-md-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">{{trans('videos.Status')}}:</label>
                            <div class="form-group">
                                <select name="visibility" wire:model="visibility" class="form-control select2">
                                    <option value="" selected disabled="">{{trans('videos.Choose')}}...</option>
                                    <option
                                        value="public" {{old('visibility',request()->input('visibility')) == 'public' ? 'selected' : ''}}>
                                        {{trans('videos.Public')}}
                                    </option>
                                    <option
                                        value="private" {{old('visibility',request()->input('visibility')) == 'private' ? 'selected' : ''}}>
                                        {{trans('videos.Private')}}
                                    </option>

                                </select>
                                @error('visibility')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>

                        </div>


                    </div>
                    <br>


                    <div class="row">

                        <div class="col-md-12">
                            <label for="description"> {{trans('videos.Description')}} :</label>

                            <div wire:ignore wire:key="myId">
                                <div id="description" class="block mt-1 w-full">
                                    {!! $description !!}
                                </div>
                            </div>

                            <textarea id="description" hidden class="body-content"
                                      wire:model.debounce.2000ms="description">
                                                        {!! $description !!}
                                                           </textarea>
                            @error('description')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>


                    </div>
                    <br>


                    <div class="col-lg-12">
                        <div class="card" x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false, $wire.fileCompleted()"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="card-body">
                                <h4 class="card-title">{{trans('videos.Video_Upload')}}:</h4>


                                <div class="progress my-4" x-show="isUploading" style="height: 20px;">

                                    <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`"></div>
                                </div>

                                <div class="input-group" x-show="!isUploading">


                                    <input type="file" name="fileVideo" wire:model="fileVideo"
                                           class="form-control" id="customFile"><br>

                                </div>
                                @error('fileVideo')<span
                                    class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="fileCompleted"> {{trans('videos.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('videos.Close')}}</button>
                </div>


            </div>
        </div>
    </div>


</div>
@push('scripts')

    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>


    <script>
        window.onload = function () {


            if (document.querySelector('#description')) {
                ClassicEditor.create(document.querySelector('#description'), {})
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            document.querySelector('#description').value = editor.getData();
                            @this.
                            set('description', document.querySelector('#description').value);
                        });
                        Livewire.on('createDescription', function () {
                            editor.setData('')
                        });

                    })
                    .catch(error => {
                        console.log(error.stack);
                    });


            }

            if (document.querySelector('#descriptionEdit')) {
                ClassicEditor.create(document.querySelector('#descriptionEdit'), {})
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            document.querySelector('#descriptionEdit').value = editor.getData();
                            @this.
                            set('description', document.querySelector('#descriptionEdit').value);
                        });
                        // Livewire.on('createNewPostEmit', function () {
                        //     editor.setData('')
                        // });
                        Livewire.on('showDescription', function () {
                            editor.setData(document.querySelector('.body-content2').value)
                        });
                    })
                    .catch(error => {
                        console.log(error.stack);
                    });
            }

        }
    </script>

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_video").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_video").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDelete', event => {
            $("#delete_video").click();
        });
    </script>

@endpush
