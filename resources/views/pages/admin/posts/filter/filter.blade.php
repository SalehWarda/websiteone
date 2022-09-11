<div class="card-body">

        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <input type="text" name="keyword" wire:model="keyword"  value="{{old('keyword',request()->input('keyword'))}}" class="form-control" placeholder="{{trans('posts.Search_here')}}">

                </div>

            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" wire:model="statusS" class="form-control select2">
                        <option value="">{{trans('posts.Status')}}</option>
                        <option value="1" {{old('status',request()->input('status')) == '1' ? 'selected' : ''}}>{{trans('posts.Active')}}</option>
                        <option value="0" {{old('status',request()->input('status')) == '0' ? 'selected' : ''}}>{{trans('posts.InActive')}}</option>

                    </select>

                </div>

            </div>


            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" wire:model="order_by" class="form-control select2">
                        <option value="desc" selected >{{trans('posts.Sort_By_Time')}}</option>
                        <option value="asc" {{old('order_by',request()->input('order_by')) == 'desc' ? 'selected':''}}>{{trans('posts.Desc')}}</option>
                        <option value="desc" {{old('order_by',request()->input('order_by')) == 'asc' ? 'selected':''}}>{{trans('posts.Asc')}}</option>
                    </select>

                </div>

            </div>

            <div class="col-2">
                <div class="form-group">
                    <select name="limit_by" wire:model="limit_by" class="form-control select2">
                        <option value="">{{trans('posts.Sort_By_pages')}}</option>
                        <option value="10" {{old('limit_by',request()->input('limit_by')) == '10' ? 'selected':''}}>10</option>
                        <option value="20" {{old('limit_by',request()->input('limit_by')) == '20' ? 'selected':''}}>20</option>
                        <option value="50" {{old('limit_by',request()->input('limit_by')) == '50' ? 'selected':''}}>50</option>
                        <option value="100" {{old('limit_by',request()->input('limit_by')) == '100' ? 'selected':''}}>100</option>
                    </select>

                </div>

            </div>

            <div class="col-2">
                <div class="form-group ">
                    <button type="submit" name="submit" wire:click="render" class="btn btn-light  btn-rounded ml-70 waves-effect waves-light"><i class="fa fa-search"></i> {{trans('posts.Search')}}</button>
                </div>
            </div>
        </div>




</div>
