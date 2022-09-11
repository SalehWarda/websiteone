<div class="card-body">

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <input type="text" name="keyword" wire:model.debounce.500ms="keyword"  value="{{old('keyword',request()->input('keyword'))}}" class="form-control" placeholder="{{trans('services.Search_here')}}">

                </div>

            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" wire:model.debounce.500ms="statusS" class="form-control select2">
                        <option value="">{{trans('services.Status')}}</option>
                        <option value="open" {{old('status',request()->input('status')) == 'open' ? 'selected' : ''}}>{{trans('services.Open')}}</option>
                        <option value="closed" {{old('status',request()->input('status')) == 'closed' ? 'selected' : ''}}>{{trans('services.Closed')}}</option>
                        <option value="futuristic" {{old('status',request()->input('status')) == 'futuristic' ? 'selected' : ''}}>{{trans('services.futuristic ')}}</option>

                    </select>

                </div>

            </div>


            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" wire:model.debounce.500ms="order_by" class="form-control select2">
                        <option value="desc" selected >{{trans('services.Sort_By_Time')}}</option>
                        <option value="asc" {{old('order_by',request()->input('order_by')) == 'desc' ? 'selected':''}}>{{trans('services.Desc')}}</option>
                        <option value="desc" {{old('order_by',request()->input('order_by')) == 'asc' ? 'selected':''}}>{{trans('services.Asc')}}</option>
                    </select>

                </div>

            </div>

            <div class="col-2">
                <div class="form-group">
                    <select name="limit_by" wire:model.debounce.500ms="limit_by" class="form-control select2">
                        <option value="">{{trans('services.Sort_By_pages')}}</option>
                        <option value="10" {{old('limit_by',request()->input('limit_by')) == '10' ? 'selected':''}}>10</option>
                        <option value="20" {{old('limit_by',request()->input('limit_by')) == '20' ? 'selected':''}}>20</option>
                        <option value="50" {{old('limit_by',request()->input('limit_by')) == '50' ? 'selected':''}}>50</option>
                        <option value="100" {{old('limit_by',request()->input('limit_by')) == '100' ? 'selected':''}}>100</option>
                    </select>

                </div>

            </div>

            <div class="col-2">
                <div class="form-group ">
                    <button type="submit" name="submit" wire:click="render" class="btn btn-light  btn-rounded ml-70 waves-effect waves-light"><i class="fa fa-search"></i> {{trans('services.Search')}}</button>
                </div>
            </div>
        </div>




</div>
