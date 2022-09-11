@extends('layouts.admin')

@section('title')
    {{trans('orders.Orders')}}
@endsection

@section('content')







    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{trans('orders.Orders')}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">{{trans('orders.Orders')}}</li>
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('orders.Home')}}</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

              @include('partials.alert.alert')


                            <div class="card  mb-4">

                                <div class="card-header py-3 d-flex justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{trans('orders.Order')}} ({{ $order->ref_id }})</h6>
                                    <div class="ml-auto">
                                        <form action="{{ route('admin.orders.update') }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{$order->id}}">
                                            <div class="form-row align-items-center">
                                                <label class="sr-only" for="inlineFormInputGroupUsername">{{trans('orders.User')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{trans('orders.Order_Status')}}</div>
                                                    </div>
                                                    <select class="form-control" name="order_status" style="outline-style: none;" onchange="this.form.submit()">
                                                        <option value=""> {{trans('orders.Choose_Status')}}... </option>
                                                        @foreach($order_status_array as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-8">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>{{trans('orders.Ref_id')}}</th>
                                                    <td>{{ $order->ref_id }}</td>
                                                    <th>{{trans('orders.User')}}</th>
                                                    <td><a href="">{{ $order->user->full_namee }}</a></td>
                                                </tr>

                                                <tr>
                                                    <th>{{trans('orders.Created_date')}}</th>
                                                    <td>{{ $order->created_at->format('d-m-Y h:i a') }}</td>
                                                    <th>{{trans('orders.Order_Status')}}</th>
                                                    <td>{!! $order->statusWithLabel() !!}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>{{trans('orders.Subtotal')}}</th>
                                                    <td>{{ $order->currency() . $order->subtotal }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{trans('orders.Discount_code')}}</th>
                                                    <td>{{ $order->discount_code }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{trans('orders.Discount')}}</th>
                                                    <td>{{ $order->currency() . $order->discount }}</td>
                                                </tr>

                                                <tr>
                                                    <th>{{trans('orders.Tax')}}</th>
                                                    <td>{{ $order->currency() . $order->tax }}</td>
                                                </tr>
                                                <tr>
                                                    <th>{{trans('orders.Amount')}}</th>
                                                    <td>{{ $order->currency() . $order->total }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card  mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{trans('orders.Transactions')}}</h6>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{trans('orders.Transaction')}}</th>
                                            <th>{{trans('orders.Transaction_Number')}}</th>
                                            <th>{{trans('orders.Transaction_Result')}}</th>
                                            <th>{{trans('orders.Transaction_Date')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($order->transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->status($transaction->transaction) }}</td>
                                                <td>{{ $transaction->transaction_number }}</td>
                                                <td>{{ $transaction->payment_result }}</td>
                                                <td>{{ $transaction->created_at->format('Y-m-d h:i a') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No transactions found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card  mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{trans('orders.Details')}}</h6>
                                </div>

                                <div class="table-responsive d-flex">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>الخدمات</th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($order->services as $service)
                                            <tr>
                                                <td><a href="{{route('admin.orders.service-order-details',$service->id)}}">{{ $service->name }}</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No Services found</td>
                                            </tr>
                                        @endforelse


                                        </tbody>
                                    </table>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>الدورات</th>



                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($order->courses as $course)
                                            <tr>
                                                <td><a href="#">{{ $course->title }}</a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2">No Courses found</td>
                                            </tr>
                                        @endforelse


                                        </tbody>
                                    </table>
                                </div>
                            </div>



        </div>
    </div>








@endsection
