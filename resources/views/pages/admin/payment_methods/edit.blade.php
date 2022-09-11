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
                                    <a href="{{route('admin.payment_methods.index')}}"
                                       class="btn btn-outline-success waves-effect waves-light btn-rounded"
                                    >الخلف <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <br>


                            <form action="{{route('admin.payment_methods.update')}}" method="post">
                                @csrf
                                @method('PATCH')

                                <input type="hidden" name="payment_id" value="{{$payment_method->id}}">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="{{ old('name', $payment_method->name) }}" class="form-control">
                                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="code">code</label>
                                            <input type="text" name="code" value="{{ old('code', $payment_method->code) }}" class="form-control">
                                            @error('code')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="sandbox">Sandbox</label>
                                            <select name="sandbox" class="form-control">
                                                <option value="1" {{ old('sandbox', $payment_method->sandbox) == '1' ? 'selected' : null }}>Sandbox</option>
                                                <option value="0" {{ old('sandbox', $payment_method->sandbox) == '0' ? 'selected' : null }}>Live</option>
                                            </select>
                                            @error('sandbox')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ old('status', $payment_method->status) == '1' ? 'selected' : null }}>Active</option>
                                                <option value="0" {{ old('status', $payment_method->status) == '0' ? 'selected' : null }}>Inactive</option>
                                            </select>
                                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="merchant_email">Merchant Email</label>
                                            <input type="text" name="merchant_email" value="{{ old('merchant_email', $payment_method->merchant_email) }}" class="form-control">
                                            @error('merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="client_id">Client ID</label>
                                            <input type="text" name="client_id" value="{{ old('client_id', $payment_method->client_id) }}" class="form-control">
                                            @error('client_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="client_secret">Client secret</label>
                                            <input type="text" name="client_secret" value="{{ old('client_secret', $payment_method->client_secret) }}" class="form-control">
                                            @error('client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="sandbox_merchant_email">Sandbox Merchant Email</label>
                                            <input type="text" name="sandbox_merchant_email" value="{{ old('sandbox_merchant_email', $payment_method->sandbox_merchant_email) }}" class="form-control">
                                            @error('sandbox_merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="sandbox_client_id">Sandbox client id</label>
                                            <input type="text" name="sandbox_client_id" value="{{ old('sandbox_client_id', $payment_method->sandbox_client_id) }}" class="form-control">
                                            @error('sandbox_client_id')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="sandbox_client_secret">Sandbox client secret</label>
                                            <input type="text" name="sandbox_client_secret" value="{{ old('sandbox_client_secret', $payment_method->sandbox_client_secret) }}" class="form-control">
                                            @error('sandbox_client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group pt-4">
                                    <button type="submit" name="submit" class="btn btn-primary">Update Payment method</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
