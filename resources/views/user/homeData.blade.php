

<div class="row">
  @foreach($departments as $department)
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
        <a href="{{$department->acronym}}">
          <div class="icon-box" data-aos="fade-up">
              <div class="icon"><i class="{{$icons[$department->acronym]}}"></i></div>
              <h4><a href="{{$department->acronym}}">{{$department->name}} ({{$department->acronym}})</a></h4>
          </div>
        </a>
      </div>
  @endforeach
</div>