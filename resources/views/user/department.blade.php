@extends('layouts.app')

@section('content')
    @include('user.staffs')
@endsection

@section('modal')

@endsection


@section('script')

<script>

    $(document).ready(function() {

        $('#save-content').on('submit', '#save-btn', function (e) {
            var route = $(this).attr('action');
            var formData = new FormData(this);

            $.ajax({
                 type: 'POST',
                url: route,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function() {

                },
                error: function () {

                },
            });
            e.preventDefault();
        });

        // saving survey function

 $(document).ready(function() {

$('.items').hide();


$('#service').change(function() {
            if ($(this).val() == "0")
            {
                $('#service-others').show();
                $('#others').attr('required', true);
            }
            else
            {
                $('#service-others').hide();
                $('#service-others').val('');
                $('#others').attr('required', false);
            }

        });


$('#staff').on('change', function() {
$('#service-div').show();
});





$('#service').on('keyup', function() {
      if ($(this).val().length < 3)
          $('#next-btn').attr('disabled', true);
      else
          $('#next-btn').attr('disabled', false);
});


$('#main').on('submit', '#approval-content', function (e) {
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

            $('#main').html(data)
            $('html, body').animate({scrollTop: '0px'}, 0);

        },
        error: function () {

        },
    });

    // departments redirect
    e.preventDefault();
});


});


  });
  </script>



@endsection
