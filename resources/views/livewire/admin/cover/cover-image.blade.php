<div>
    <div class="container">
        <div class="row">
            <div class="card col-md-6">
                <div class="card-body">
                    <h4 class="card-title">صورة الغلاف:</h4>
                    <p class="card-title-desc"><span class="text-danger">  {{trans('about.Note')}} : </span>
                        {{trans('about.Note_Message')}}
                        500px , 500px
                    </p>
                    <div class="input-group">
                        <input type="file" name="cover_image" wire:model="cover_image" accept="image/*"

                            class="form-control" id="customFile"><br>

                    </div>
                    @error('cover_image')<span
                        class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

        </div>
    </div>
</div>
