<div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <div class="d-block">
                            <h5 class="card-title pb-0 border-0"> {{trans('services.Servces_timings')}}</h5>
                        </div>

                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block">
                                <a class="btn btn-secondary waves-effect waves-light btn-rounded"

                                   data-bs-toggle="modal" data-bs-target="#addTime"
                                   wire:click="resetData"
                                > {{trans('services.Add_new_Time')}} <i class="fa fa-plus"></i>
                                </a>

                            </div>

                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{trans('services.Service')}}</th>
                                <th> {{trans('services.From')}}</th>
                                <th> {{trans('services.To')}}</th>
                                <th> {{trans('services.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($timings as $timing)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td><strong>{{$timing->service->name}}</strong><br>
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($timing->service_timings_from)->format('Y-m-d h:i A')}} </td>
                                    <td>{{\Carbon\Carbon::parse($timing->service_timings_to)->format('Y-m-d h:i A')}} </td>


                                    <td>
                                        <div class="btn-list btn-list-icon">


                                            <button type="button"
                                                    class="btn btn-info waves-effect waves-light btn-rounded"
                                                    data-bs-toggle="modal" data-bs-target="#editTime"
                                                    wire:click="editTime({{$timing->id}})"
                                                    title=" {{trans('services.Edit')}}">
                                                <i class="ri-edit-2-fill align-middle me-2"></i> {{trans('services.Edit')}}
                                            </button>
                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-light btn-rounded"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteTime"
                                                    wire:click="show_delete_time({{$timing->id}})"
                                                    title=" {{trans('services.Delete')}}">
                                                <i class="ri-delete-bin-2-line align-middle me-2"></i> {{trans('services.Delete')}}
                                            </button>

                                        </div>
                                    </td>
                                </tr>



                                <!--  Edit Timeings Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="editTime"
                                     aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel"> {{trans('services.Edit')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">


                                                <input type="hidden" wire:model="time_id">
                                                <div class="row">


                                                    <div class="col-md-12">

                                                        <label for="service_id" class=" col-form-label"> {{trans('services.Service')}}
                                                            : </label>

                                                        <select class="form-control" name="service_id"
                                                                wire:model="service_id">
                                                            <option value="" selected>  {{trans('services.Choose_Service')}}...</option>

                                                            @foreach($services as $service)
                                                                <option
                                                                    value="{{$service->id}}" {{old('service_id') == $service->id ?'selected' : null}}>
                                                                    {{$service->name}}
                                                                </option>
                                                            @endforeach


                                                        </select>
                                                        @error('service_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>





                                                </div>
                                                <br>


                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label for="service_timings_from" class="col-sm-2 col-form-label"> {{trans('services.From')}}:</label>
                                                        <input class="form-control" type="datetime-local" name="service_timings_from" wire:model="service_timings_from"  id="service_timings_from">

                                                        @error('service_timings_from')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror


                                                    </div>
                                                    <br>
                                                    <div class="col-md-6">
                                                        <label for="service_timings_to" class="col-sm-2 col-form-label"> {{trans('services.To')}}:</label>
                                                        <input class="form-control" type="datetime-local" name="service_timings_to" wire:model="service_timings_to"  id="service_timings_to">


                                                        @error('service_timings_to')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>




                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-secondary m-lg-2" type="submit"
                                                            wire:click="updateTime"> {{trans('services.Saving_changes')}}<i
                                                            class="fe fe-plus"></i></button>
                                                    <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                            type="button">
                                                        {{trans('services.Close')}}
                                                    </button>
                                                </div>
                                                </form>

                                            </div>


                                        </div>
                                    </div>
                                </div>



                                <!-- Delete Timeings Modal -->
                                <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog"
                                     id="deleteTime" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel"> {{trans('services.Delete')}} </h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <input type="hidden" name="coupon_id" value="{{$timing->id}}">

                                                <h4> {{trans('services.Delete_Message')}} </h4>

                                                <h5><span class="text-danger">{{$name}}</span></h5>
                                                <h6><span class="text-danger">{{$service_timings}}</span></h6>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light waves-effect"
                                                            data-bs-dismiss="modal"> {{trans('services.Close')}}
                                                    </button>
                                                    <button type="submit"
                                                            wire:click="deleteTime"
                                                            class="btn btn-danger waves-effect waves-light"> {{trans('services.Delete')}}
                                                    </button>
                                                </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">No Services Times found</td>
                                </tr>
                            @endforelse


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="float-right pagination-rounded">


                                        {{$timings->links()}}

                                    </div>

                                </td>
                            </tr>

                            </tfoot>
                        </table>
                    </div>

                    <!--  Add Timings Modal -->
                    <div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" id="addTime"
                         aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myExtraLargeModalLabel"> {{trans('services.Add_new_Time')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">


                                    <div class="row">


                                        <div class="col-md-12">

                                            <label for="service_id" class=" col-form-label"> {{trans('services.Service')}} : </label>

                                            <select class="form-control" name="service_id" wire:model="service_id">
                                                <option value="" selected>  {{trans('services.Choose_Service')}}...</option>

                                                @foreach($services as $service)
                                                    <option
                                                        value="{{$service->id}}" {{old('service_id') == $service->id ?'selected' : null}}>
                                                        {{$service->name}}
                                                    </option>
                                                @endforeach


                                            </select>
                                            @error('service_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="service_timings_from" class="col-sm-2 col-form-label"> {{trans('services.From')}}:</label>

                                            <input class="form-control" type="datetime-local" name="service_timings_from" wire:model="service_timings_from"  id="service_timings_from">

                                            @error('service_timings_from')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror


                                        </div>
                                        <br>
                                        <div class="col-md-6">
                                            <label for="service_timings_to" class="col-sm-2 col-form-label"> {{trans('services.To')}}:</label>

                                            <input class="form-control" type="datetime-local" name="service_timings_to" wire:model="service_timings_to"  id="service_timings_to">

                                            @error('service_timings_to')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                        </div>




                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-secondary m-lg-2" type="submit"
                                                wire:click="addServiceTimings">  {{trans('services.Save')}}<i
                                                class="fe fe-plus"></i></button>
                                        <button class="btn ripple btn-danger" data-bs-dismiss="modal"
                                                type="button">
                                            {{trans('services.Close')}}
                                        </button>
                                    </div>

                                    </form>

                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')

    <script>
        window.addEventListener('closeModalAdd', event => {
            $("#addTime").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalUpdate', event => {
            $("#editTime").click();
        });
    </script>

    <script>
        window.addEventListener('closeModalDelete', event => {
            $("#deleteTime").click();
        });
    </script>

@endpush
