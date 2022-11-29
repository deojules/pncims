


<!-- ======Department/Service Section ======= -->
<section class="inner-page">
    <div class="container">
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="row">
                     <div class="col-lg-3" data-aos="fade-right">
                        <div class="survey-title">
                             <h2>Personnel and Services</h2>
                        </div>
                     </div>


                <div class="col-md-9" data-aos="fade-up" data-aos-delay="100">
                    <form action="{{route('survey.start')}}" method="post" id="approval-content">
                        @csrf

                        <input type="hidden" value="{{$department->idkey}}" id="dept" name="dept">
                            <div class="php-email-form mt-4" id="approval-content">
                                <h4>
                                    {{$department->name}}
                                </h4>
                                <hr>
                                <div class="form-group mt-3">
                                    <h6 class="mt-4 mb-3">Please select the personnel to be assessed.</h6>
                                    <select class="form-select mb-4" name="staff" id="staff">
                                        <option value="" disabled selected hidden></option>
                                        @foreach($employees as $employee)
                                            @if(!Auth::user() || $employee->p_id!=Auth::user()->p_id)
                                        <option value="{{$employee->idkey}}">{{$employee->fullname2}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3 items" id="service-div">
                                    <h6 class="mt-4 mb-3">Please enter the service being availed or requested.</h6>
                                    <select class="form-select mb-4" name="service" id="service" >
                                        <option value="" disabled selected hidden></option>
                                        @foreach($dept_serv as $ds)
                                        <option value="{{$ds->services}}">{{$ds->services}}</option>
                                        @endforeach
                                        <option value="0">Others</option>

                                    </select>

                                    <div class="items" id="service-others">
                                        <input id="others" type="text" class="form-control" name="service_others" id="service-others" maxlength="30" autocomplete="off">
                                        <span for="others"><small class="text-muted">&nbsp; Please specify.</small></span>
                                    </div>

                                    <div class="text-center mt-4">
                                        <button class="btn btn-success" id="next-btn" name="next-btn" type="submit">Next</button>
                                    </div>
                                </div>
                        </div>
                </div>
        </form>
            </div>
            <div style="margin-top:113px;"></div>
        </section><!-- End Contact Section -->
    </div>
</section> <!--End of Deparment Content-->


