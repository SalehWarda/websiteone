<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="name_ar" class="col-sm-2 col-form-label">الإسم بالعربية:</label>
                                <input class="form-control" type="text"
                                        wire:model="name_ar" name="name_ar"
                                       id="name_ar">
                                @error('name_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name_en" class="col-sm-2 col-form-label">الإسم بالإنجليزية:</label>
                                <input class="form-control" type="text"
                                       wire:model="name_en" name="name_en"
                                       id="name_en">
                                @error('name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="email" class="col-sm-2 col-form-label">

                                    البريد الإلكتروني:</label>
                                <input class="form-control" type="email" wire:model="email" name="email"

                                       id="email">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="col-sm-2 col-form-label">
                                    الهاتف:</label>
                                <input class="form-control" type="text" wire:model="mobile" name="mobile"

                                       id="mobile">
                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="col-sm-2 col-form-label">كلمة السر:</label>
                                <input class="form-control" type="password" name="password" wire:model="password" id="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">تأكيد كلمة السر:</label>
                                <input class="form-control" type="password" name="password_confirmation" wire:model="password_confirmation" id="password_confirmation">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>



                        </div>
                        <br>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">صورة المستخدم:</h4>
                                    <div class="d-flex py-3 ">

                                      @if ($imageDB)

                                         <div class="mt-1 mx-1 d-flex rounded-md shadow-sm">

                                                <span
                                                      class="d-flex items-center p-3 rounded border border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                            <img src="{{ asset('assets/images/admin/users/'. $imageDB->file_name) }}" width="200">
                                                 </span>
                                         </div>

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

                        <button class="btn ripple btn-secondary m-lg-2" type="submit" wire:click="update">
                            حفظ التعديلات<i
                                class="fe fe-plus"></i></button>

                </div>


            </div>
        </div>
    </div>
</div>
