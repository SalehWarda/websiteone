<div class="card-body">
    <form action="{{ route('admin.orders.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request()->input('keyword')) }}" class="form-control" placeholder="{{trans('orders.Search_here')}}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">---</option>
                        <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>New order</option>
                        <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>Paid</option>
                        <option value="2" {{ old('status', request()->input('status')) == '2' ? 'selected' : '' }}>Under process</option>
                        <option value="3" {{ old('status', request()->input('status')) == '3' ? 'selected' : '' }}>Finished</option>
                        <option value="4" {{ old('status', request()->input('status')) == '4' ? 'selected' : '' }}>Rejected</option>
                        <option value="5" {{ old('status', request()->input('status')) == '5' ? 'selected' : '' }}>Canceled</option>
                        <option value="6" {{ old('status', request()->input('status')) == '6' ? 'selected' : '' }}>Refund requested</option>
                        <option value="7" {{ old('status', request()->input('status')) == '7' ? 'selected' : '' }}>Refunded</option>
                        <option value="8" {{ old('status', request()->input('status')) == '8' ? 'selected' : '' }}>Returned order</option>
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value="">---</option>
                        <option value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>{{trans('orders.Asc')}}</option>
                        <option value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>{{trans('orders.Desc')}}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value="">---</option>
                        <option value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <button type="submit" class="btn btn-light  btn-rounded ml-70 waves-effect waves-light">{{trans('orders.Search')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
