
<section id="contact" class="contact">
  <div class="container">
      <div class="row">
          <div class="col-lg-7 mt-4 " id="summary" data-aos="fade-right">
              <div class="info w-100 mt-1">
                <i class="bi bi-person-check"></i>
                <h4 id="cell-staff">{{$employee->fullname}}</h4>
                <p style="font-size:13px;">{{$department->name}}</p>
              </div>

              <div class="info w-100 mt-4">
                <i  class="bi bi-pencil-square"></i>
                <h4 id="cell-service">{{$service}}</h4>
                <p style="font-size:13px;">Service being availed/requested</p>
              </div>
          </div>
            <div class="col-lg-5 mt-4" data-aos="fade-up" data-aos-delay="100">
              <div class="card card-body border-0 shadow mb-3" id="scale">
                <b>Instruction:</b>
                <i class="mb-3">Kindly indicate your level of satisfaction by tapping the icon of your choice using the following scale:</i>
                <table>
                    <tr class="text-success">
                        <th>5</th>
                        <td>
                         <i class="bi bi-star-fill"></i>
                         <i class="bi bi-star-fill"></i>
                         <i class="bi bi-star-fill"></i>
                         <i class="bi bi-star-fill"></i>
                         <i class="bi bi-star-fill"></i>
                         </i> 
                            - High Satisfactory
                        </td>
                    </tr> 

                    <tr class="text-success">
                        <th>4</th>
                        <td><i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i> - Satisfactory</td>
                    </tr>
                    <tr class="text-success">
                        <th>3</th>
                        <td><i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star">
                            <i class="bi bi-star">
                              </i> - Neutral</td>
                    </tr>
                    <tr class="text-success">
                        <th>2</th>
                        <td> <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star">
                            <i class="bi bi-star">
                              <i class="bi bi-star"></i> - Unsatisfactory</td>
                    </tr>
                    <tr class="text-success">
                        <th>1</th>
                        <td> <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star">
                          <i class="bi bi-star">
                            <i class="bi bi-star">
                              <i class="bi bi-star"></i> - Highly Unsatisfactory</td>
                    </tr>
                </table>
              </div>
          </div>
        </div>
   

  <form  action="{{route('survey.save')}}" method="post" id="save-content">
      @csrf
        <input type="hidden" value="{{$service}}" name="service">
        <input type="hidden" value="{{$department->idkey}}" name="dept">
        <input type="hidden" value="{{$employee->idkey}}" name="employee">

        @if(Auth::guard('student')->user())
          <input type="hidden" name="client" value="{{Auth::guard('student')->user()->idkey}}">
          <input type="hidden" name="name"  value="{{Auth::guard('student')->user()->info->fullname}}">
          <input type="hidden" name="category"  value="2">
          <input type="hidden" name="type" value="0">

        @elseif(Auth::user())
          <input type="hidden" name="client"  value="{{Auth::user()->idkey}}">
          <input type="hidden" name="name"  value="{{Auth::user()->info->fullname}}">
          <input type="hidden" name="category"  value="1">
          <input type="hidden" name="type" value="0">

        @elseif(session('guest'))
          <input type="hidden" name="client"  value={{session('client')}}>
          <input type="hidden" name="name"  value="{{session('fname').' '.session('lname')}}">
          <input type="hidden" name="type" value="{{session('type')}}">
          <input type="hidden" name="category"  value="0">
        @endif

@foreach($items as $key => $item)
      <div class="card card-body border-0 shadow mb-3 mt-5 items" id="card-{{$key}}"  data-aos="fade-up">
          <div class="mb-4">
              <b>{{$loop->index+1}}. &nbsp;</b> {{$item->english}}<br>
              <i>({{$item->tagalog}})</i>
          </div>

                  <fieldset>
                      <span class="star-cb-group">

                      <input type="radio" name="items_{{$key}}"  class="btn-check" id="items-{{$key}}-5" autocomplete="off" value="5" required>
                      <label for="items-{{$key}}-5">5</label>

                        <input type="radio" name="items_{{$key}}"  class="btn-check" id="items-{{$key}}-4" autocomplete="off" value="4" required>
                        <label for="items-{{$key}}-4">4</label>


                        <input type="radio" name="items_{{$key}}"  class="btn-check" id="items-{{$key}}-3" autocomplete="off" value="3" required>
                        <label for="items-{{$key}}-3">3</label>

                        <input type="radio" name="items_{{$key}}"  class="btn-check" id="items-{{$key}}-2" autocomplete="off" value="2" required>
                        <label for="items-{{$key}}-2">2</label>

                        <input type="radio" name="items_{{$key}}"  class="btn-check" id="items-{{$key}}-1" autocomplete="off" value="1" required>
                        <label for="items-{{$key}}-1">1</label>


                      </span>

                  </fieldset>

      </div>
@endforeach

<div class="card card-body border-0 shadow mb-3" id="progress">
  <h6><span id="counter">1</span> out of 10</h6>
  <div class="progress">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
</div>


<div class="card card-body border-0 shadow mb-3 items" id="comment">
  <h6 class="mb-3">Please, enter your comment and suggestions. <i>(optional)</i></h6>
  <textarea class="form-control mb-3" name="comment" id="comment" rows="3"></textarea>
  <div class="text-center">
      <button class="btn btn-primary" id="submit-btn">SUBMIT</button>
  </div>
</div>
  </form>

  </div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</section>
</body>
</html>



<script>

$(document).ready(function() {


$('.items').hide();
$('#card-0').show();


$('#card-0').on('change', function() {
$('#card-1').show();
});

$('#card-1').on('change', function() {
$('#card-2').show();
});

$('#card-2').on('change', function() {
$('#card-3').show();
});

$('#card-3').on('change', function() {
$('#card-4').show();
});

$('#card-4').on('change', function() {
$('#card-5').show();
});

$('#card-5').on('change', function() {
$('#card-6').show();
});

$('#card-6').on('change', function() {
$('#card-7').show();
});

$('#card-7').on('change', function() {
$('#card-8').show();
});

$('#card-8').on('change', function() {
$('#card-9').show();
});

$('#card-9').on('change', function() {
$('#comment').show();
});



});



$('.btn-check').on('change', function() {
            var count = $('body').find('input[type="radio"]:checked').length + 1;

            $(this).parent().parent().next().show();
            if (count < 11)
            {
                $('.progress-bar').css('width', (count*10)+'%')
                $('#counter').html(count);
            }
        });
</script>
