@extends('layouts.admin')

@section('title')
   بوابات الدفع
@endsection

@section('content')







    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">بوابات الدفع</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">بوابات الدفع</li>
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-block d-md-flex justify-content-between">
                                <div class="d-block">
                                    <h5 class="card-title pb-0 border-0"> بوابات الدفع</h5>
                                </div>

                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block">
                                        <a href="{{route('admin.payment_methods.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                                        >إضافة بوابة دفع<i class="fa fa-plus"></i>
                                        </a>

                                    </div>

                                </div>

                            </div>



                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>بوابة الدفع</th>
                                        <th>الكود</th>
                                        <th>الحالة التجريبية</th>
                                        <th>الحالة</th>
                                        <th >العمليات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($payment_methods as $payment_method)
                                        <tr>
                                            <td>{{ $payment_method->name }}</td>
                                            <td>{{ $payment_method->code }}</a></td>
                                            <td>{{ $payment_method->sandbox() }}</a></td>
                                            <td>{{ $payment_method->status() }}</td>
                                            <td>
                                                <div class="btn-list btn-list-icon">
                                                    <a href="{{route('admin.payment_methods.edit',$payment_method->id)}}"
                                                            class="btn btn-info waves-effect waves-light btn-rounded"


                                                            title="تعديل">
                                                        <i class="ri-edit-2-line align-middle me-2"></i>تعديل
                                                    </a>

                                                    <button type="button"
                                                            class="btn btn-danger waves-effect waves-light btn-rounded"

                                                            data-bs-toggle="modal" data-bs-target="#delete_payment{{$payment_method->id}}"
                                                            title="حذف">
                                                        <i class="ri-delete-bin-2-line align-middle me-2"></i>حذف
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete payment Modal -->
                                        <div  class="modal fade" tabindex="-1" role="dialog"
                                             id="delete_payment{{$payment_method->id}}" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="myModalLabel">حذف البوابة </h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('admin.payment_methods.destroy')}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">

                                                            <input type="hidden" name="payment_id" value="{{$payment_method->id}}">

                                                            <h4>هل انت متأكد من عملية الحذف ؟ </h4>

                                                            <h5><span class="text-danger">{{$payment_method->name}}</span></h5>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light waves-effect"
                                                                    data-bs-dismiss="modal">إغلاق
                                                            </button>
                                                            <button type="submit"
                                                                    class="btn btn-danger waves-effect waves-light">حذف
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No payment methods found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="5">
                                            <div class="float-right">
                                                {!! $payment_methods->appends(request()->input())->links() !!}
                                            </div>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








@endsection
