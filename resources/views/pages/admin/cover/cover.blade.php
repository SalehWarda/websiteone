@extends('layouts.admin')

@section('title')
    معلومات الغلاف
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">معلومات الغلاف</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">معلومات الغلاف</li>
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">الرئيسية</a></li>
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


                            <form action="{{route('admin.cover.update')}}" method="post" enctype="multipart/form-data">

                                @csrf
                                @method('PATCH')
                                <input type="hidden" value="{{$cover->id}}" name="cover_id">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="field_one_ar"
                                               class="col-sm-2 col-form-label">الحقل الأول بالعربية:</label>
                                        <input class="form-control" type="text"
                                               value="{{$cover->getTranslation('field_one','ar')}}" name="field_one_ar"
                                               id="field_one_ar">
                                        @error('field_one_ar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="field_one_en"
                                               class="col-sm-2 col-form-label">الحقل الأول بالإنجليزية:</label>
                                        <input class="form-control" type="text"
                                               value="{{$cover->getTranslation('field_one','en')}}" name="field_one_en"
                                               id="field_one_en">
                                        @error('field_one_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="field_tow_ar"
                                               class="col-sm-2 col-form-label">الحقل الثاني بالعربية:</label>
                                        <input class="form-control" type="text"
                                               value="{{$cover->getTranslation('field_tow','ar')}}" name="field_tow_ar"
                                               id="field_tow_ar">
                                        @error('field_tow_ar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="field_tow_en"
                                               class="col-sm-2 col-form-label">الحقل الثاني بالإنجليزية:</label>
                                        <input class="form-control" type="text"
                                               value="{{$cover->getTranslation('field_tow','en')}}" name="field_tow_en"
                                               id="field_one_en">
                                        @error('field_tow_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="field_three_ar"
                                               class="col-sm-2 col-form-label">الحقل الثالث بالعربية:</label>
                                        <input class="form-control" type="text"
                                               value="{{$cover->getTranslation('field_three','ar')}}" name="field_three_ar"
                                               id="field_three_ar">
                                        @error('field_three_ar')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="field_three_en"
                                               class="col-sm-2 col-form-label">الحقل الثالث بالإنجليزية:</label>
                                        <input class="form-control" type="text"
                                               value="{{$cover->getTranslation('field_three','en')}}" name="field_three_en"
                                               id="field_three_en">
                                        @error('field_three_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <livewire:admin.cover.cover-image :cover="$cover"/>


                                <button class="btn ripple btn-secondary m-lg-2" type="submit">
                                    حفظ التعديلات<i
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
