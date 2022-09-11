<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0"> {{trans('socialMedia.Social_Media')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"
                                   wire:click="resetData"
                                   data-bs-toggle="modal" data-bs-target="#add_social"
                                > {{trans('socialMedia.Add_Social_Media')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>

                    </div>


                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{trans('socialMedia.Site')}}</th>
                                <th> {{trans('socialMedia.Link')}}</th>
                                <th>{{trans('socialMedia.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($socials as $social)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td align="center">
                                            <a target="_blank" href="{{$social->link}}">
                                                <i class="fab fa-{{$social->name}}"></i>
                                            </a>

                                        </td>
                                    <td>{{ $social->link }}</td>
                                    <td>
                                        <div class="btn-list btn-list-icon">
                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    wire:click="editSocial({{$social->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#edit_social"
                                                    title="{{trans('socialMedia.Edit')}}">
                                                <i class="ri-edit-2-line align-middle me-2"></i>{{trans('socialMedia.Edit')}}
                                            </button>

                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    wire:click="show_delete_social({{$social->id}})"
                                                    data-bs-toggle="modal" data-bs-target="#delete_social"
                                                    title="{{trans('socialMedia.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i>{{trans('socialMedia.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>


                                <!-- Edit Social Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="edit_social"
                                     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('socialMedia.Social_Media_Update')}} : {{$name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <input type="hidden" wire:model="social_id">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="name" class="col-sm-2 col-form-label">{{trans('socialMedia.Site')}} :</label>
                                                        <input class="form-control" type="text" name="name" wire:model="name"
                                                               id="name">
                                                        @error('name')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="link" class="col-sm-2 col-form-label">{{trans('socialMedia.Link')}} :</label>
                                                        <input class="form-control" type="text" name="link" wire:model="link"
                                                               id="link">
                                                        @error('link')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>


                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="updateSocial"> {{trans('socialMedia.Saving_changes')}}<i
                                                        class="fe fe-plus"></i></button>
                                                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('socialMedia.Close')}}</button>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                <!-- Delete Social Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog"
                                     id="delete_social" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel">{{trans('socialMedia.Social_Media_Delete')}} </h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" wire:model="social_id">

                                                <h4>{{trans('socialMedia.Delete_Message')}} </h4>

                                                <h5><span class="text-danger">{{$name}}</span></h5>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                        data-bs-dismiss="modal">{{trans('socialMedia.Close')}}
                                                </button>
                                                <button type="submit" wire:click="deleteSocial"
                                                        class="btn btn-danger waves-effect waves-light">{{trans('socialMedia.Delete')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty

                                <tr>
                                    <td colspan="3" class="text-center">{{trans('socialMedia.No_social_media_found')}}</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div class="float-right pagination-rounded">


                                        {{$socials->links()}}

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
    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="add_social"
         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">{{trans('socialMedia.Add_New_Social_Media')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="col-sm-2 col-form-label">{{trans('socialMedia.Site')}} :</label>
                            <input class="form-control" type="text" name="name" wire:model="name"
                                   id="name">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <label for="link" class="col-sm-2 col-form-label">{{trans('socialMedia.Link')}} :</label>
                            <input class="form-control" type="text" name="link" wire:model="link"
                                   id="link">
                            @error('link')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>


                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="addSocial"> {{trans('socialMedia.Save')}}<i
                            class="fe fe-plus"></i></button>
                    <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">{{trans('socialMedia.Close')}}</button>
                </div>


            </div>
        </div>
    </div>

</div>
@push('scripts')

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#add_social").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#edit_social").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDeleteS', event => {
            $("#delete_social").click();
        });
    </script>

@endpush
