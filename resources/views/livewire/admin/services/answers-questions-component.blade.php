<div>

    <div class="event__sidebar pl-70">
        <div class="event__sidebar-widget white-bg mb-20">
            <div class="event__sidebar-shape">
                <img class="event-sidebar-img-2" src="{{asset('assets/site/img/events/event-shape-2.png')}}" alt="">
                <img class="event-sidebar-img-3" src="{{asset('assets/site/img/events/event-shape-3.png')}}" alt="">
            </div>
            <div class="event__info">
                <div class="event__info-meta mb-25 d-flex align-items-center justify-content-between">
                    <div class="event__info-price">
                        <h5><span>{{trans('site.SR')}} {{$service->price}}</span></h5>

                    </div>

                </div>
                <div class="event__info-content mb-35">
                    <ul>
                        <li class="d-flex align-items-center">
                            <div class="event__info-icon">
                                <i class="fa fa-toggle-on"></i>
                            </div>
                            <div class="event__info-item">
                                <h5 class="ml-5"><span>{{trans('site.Status')}}: </span> {{$service->status()}}</h5>
                            </div>
                        </li>


                        <li class="d-flex align-items-center">
                            <div class="event__info-icon">
                                <i class="fa fa-notes"></i>
                            </div>
                            <div class="event__info-item">
                                <h5 class="ml-5"><span>{{trans('site.Note')}}: </span>
                                   يجب عليك إختيار موعد بالأسفل, إن لم يتوفر مواعيد بالأسفل عليك التواصل مع المسؤل حتى تتمكن من طلب الخدمة</h5>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="event__info-icon">
                                <i class="fa fa-notes"></i>
                            </div>
                            <div class="event__info-item">
                                <h5 class="ml-5"><span>{{trans('site.Note')}}: </span>
                                    {{trans('site.Note_content')}}</h5>
                            </div>
                        </li>

                        <br>


                        @if($questions->count() > 0)
                            <li class="d-flex align-items-center">
                                <div class="event__info-icon">
                                    <h4><i class="fa fa-question-circle"></i></h4>
                                </div>
                                <div class="event__info-item">
                                    <h4 class="ml-5"><span>  {{trans('site.Questions_about_this_service')}}:  </span></h4>
                                </div>

                            </li>
                        @endif




                    @foreach($questions as $question)
                            <h4>{{$loop->iteration}}<span>  {{$question->question}} </span></h4>


                            @if($question->sort == 'input')
                                <div class="col-12">
                                    @error('answer')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="contact__form-input">
                                        <input name="answer" wire:model="answer.{{$question->id}}"
                                               placeholder="Enter Your Answer">

                                    </div>

                                </div>
                            @else

                                <div class="col-12">

                                    @error('answer')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="file" class="form-control" id="customFile" name="answer"
                                           wire:model="answer.{{$question->id}}">



                                </div><br>

                            @endif

                        @endforeach

                        @if($timings->count() > 0)
                        <li class="d-flex align-items-center">
                            <div class="event__info-icon">
                                <h4><i class="fa fa-clock"></i></h4>
                            </div>
                            <div class="event__info-item">
                                <h4 class="ml-5"><span>  {{trans('site.Available_appointments')}}:  </span></h4>
                            </div>

                        </li>
                        @endif
                        @foreach($timings as $timing)

                            <li class="d-flex align-items-center">
                                <div class="event__info-icon">
                                    <i class="fas fa-user-clock"></i>
                                </div>
                                <div class="event__info-item">
                                    <div class="form-check mt-5 ml-5">
                                        <input class="form-check-input mt-5" value="{{$timing->id}}"
                                               wire:model="service_date" name="service_date"
                                               type="radio" id="formRadios{{$loop->iteration}}">
                                        <label class="form-check-label" for="formRadios{{$loop->iteration}}">
                                            ({{\Carbon\Carbon::parse( $timing->service_timings_from)->format('Y-m-d h:i A') }}) - ({{\Carbon\Carbon::parse( $timing->service_timings_to)->format('Y-m-d h:i A')}})
                                        </label>

                                    </div>

                                </div>
                            </li>

                        @endforeach
                        @error('service_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror


                    </ul>


                </div>

                @if(  $timings->count() > 0)
                <div class="event__join-btn">
                    <button type="submit" wire:click.prevent="addToCart('{{$service->id}}')"  class="tp-btn text-center w-100">{{trans('site.Service_Request')}} <i
                            class="fa fa-cart-shopping"></i></button>
                </div>
                @endif
            </div>

        </div>

    </div>

</div>
