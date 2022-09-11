<div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{trans('about.Image')}}:</h4>
                <p class="card-title-desc"><span class="text-danger">  {{trans('about.Note')}} : </span>
                    {{trans('about.Note_Message')}}<br>
                    الأفضل لمقاس الصورة أن يكون 500px x 500px
                </p>
                <div class="d-flex py-3 ">
                    @if ($imageDB)
                        <div
                            class="mt-1 mx-1 d-flex rounded-md shadow-sm">
                              <span
                                  class="inline-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                   <img
                                       src="{{ asset('assets/images/admin/about/' . $imageDB) }}"
                                       width="200">
                              </span>
                        </div>
{{--                    @else--}}
{{--                        <div--}}
{{--                            class="mt-1 mx-1 d-flex rounded-md shadow-sm">--}}
{{--                              <span--}}
{{--                                  class="inline-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">--}}
{{--                                   <img--}}
{{--                                       src="{{ asset('assets/images/admin/about/f.png' ) }}"--}}
{{--                                       width="200">--}}
{{--                              </span>--}}
{{--                        </div>--}}
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
                    <input type="file" name="image" wire:model="image" accept="image/*"

                           class="form-control" id="customFile"><br>

                </div>
                @error('image')<span
                    class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>

    </div>

</div>

