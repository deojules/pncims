@extends('layouts.app')

@section('content')

<section id="contact" class="contact">
    <div class="container " data-aos="fade-right">
        <div class="survey-title">
            <h2>Manage Services</h2>
    </div>

<div class="row">
    <div class="col-md-6">
    <h1>Department</h1>
    <select id="dept" class="form-select" name="dept" >
        <option value="" hidden selected disabled> </option>
      @foreach($departments as $dept)
      <option value="{{$dept->dept_id}}">{{$dept->name}}</option>
      @endforeach
  </select>
    </div>
</div>

    <!-- Button trigger modal -->



  <div class="service" id="ServiceData">

    @include('admin.ServiceData')

  </div>

    <div style="margin-top:113px;"></div>




</section>

  <!-- Modal -->
  <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a service</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.service.add') }}" id="service-form">
                @csrf

                <input type="hidden" value="" id="dept_id" name="dept_id">

            <div class="form-group">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <textarea type="text" name="service" id="service" class="form-control"></textarea>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success add_service">Add</button>

              </div>

          </form>

        </div>

      </div>
    </div>
  </div>

@endsection

@section('script')

<script>
$(document).ready(function () {

    $('#ServiceData').hide();
    // $('.service-2').hide();



$('#dept').on('change', function() {
    var dept_id = document.getElementById("dept").value;
    $('#dept_id').val(dept_id);
    // $('.service-2').hide();
    // $('.service-2').show();

    let csrf = $('meta[name="csrf-token"]').attr('content');

$.ajax({
    url: "{{route('admin.service.department') }}",
    type: 'POST',
    data: { _token:csrf, dept_id:dept_id},
    success: function (data) {

        $('#ServiceData').show();
        $('#ServiceData').html(data);

    },
    error: function () {

    },
});




});


});
</script>

<script>

$(document).ready(function () {



    $('#main').on('submit', '#service-form', function (e) {
    var route = $(this).attr('action');
    var formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: route,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {


            $('#ServiceData').html(data);
            $('#serviceModal').modal('hide');
            $('#service').val('');
            $('.service-2').show();



        },
        error: function () {

        },
    });

    e.preventDefault();
});



});

</script>

<script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>

<script>


$('#main').on('click','.delete',function(e){

    var button = $(this)

    e.preventDefault();

  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {


            let csrf = $('meta[name="csrf-token"]').attr('content');
            let service_id = button.data('id');

            $.ajax({
                url: "{{route('admin.service.delete') }}",
                type: 'POST',
                data: { _token:csrf, service_id:service_id},
                success: function (data) {

                    $('#ServiceData').html(data);

                },
                error: function () {

                },
            });


  }
})


});


</script>


@endsection
