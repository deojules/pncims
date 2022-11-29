@extends('layouts.login')


@section('content')




   <!-- ======= Hero Section ======= -->
   <section id="hero" >

    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">

      <div class="row justify-content-center">
        <div class="col-lg-8 mb-2">
          <img class="w-100" src="{{ asset('assets/img/LOGO TOP.png') }}">
        </div>
     </div>

      <h1 class="text-secondary display-1"> Client <span class="hero-span">Satisfaction</span> Survey</h1>


      <!-- Button trigger modal -->
        <button type="submit"   class="login-button btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#StudentLogin">
          Student Login
        </button>
        <button type="submit"   class="login-button btn btn-primary btn-lg " data-bs-toggle="modal" data-bs-target="#EmployeeLogin">
            Employee Login
          </button>
          <button type="submit" class="login-button btn btn-danger btn-lg " data-bs-toggle="modal" data-bs-target="#GuestLogin">
           Guest SignUp
          </button>
    </div>
  </section><!-- End Hero -->





  <!-- student modal -->
  <div class="modal fade" id="StudentLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header btn btn-success">
          <h1 class="modal-title fs-5" >Student Login Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form method="POST" action="{{ route('student.login') }}" class="row g-3 needs-validation" novalidate id="stud-form">
                @csrf

                @error('stud_id')
                <div class="alert alert-danger" role="alert">
                  <i class="bi bi-exclamation-triangle-fill"></i> {{$message}}
                </div>
                @enderror
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Student Id</label>
                <input type="text" name="stud_id" autocomplete="off" class="form-control" value="{{old('stud_id')}}"required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>

              </div>

              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required>
                  <div class="invalid-feedback">
                    Please enter your password.
                  </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success add_student">Login</button>
              </div>
          </form>

        </div>
      </div>
    </div>
  </div>
<style>
  .cntr
  {
    text-align: center;
  }
</style>

    <!-- employee modal -->
    <div class="modal fade" id="EmployeeLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header btn btn-primary">
              <h1 class="modal-title fs-5" >Employee Login Form</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                    @csrf

                    @error('username')
                    <div class="alert alert-danger" role="alert">
                      <i class="bi bi-exclamation-triangle-fill"></i> {{$message}}
                    </div>
                    @enderror
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" autocomplete="off" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" value="{{old('username')}}"required>
                      <div class="invalid-feedback">
                        Please enter your username.
                      </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="invalid-feedback">
                          Please enter your password.
                        </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>


          <!-- guest modal -->
    <div class="modal fade" id="GuestLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header btn btn-danger">
              <h1 class="modal-title fs-5" >Guest Login Form</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <form action="{{route('guest.login')}}" method="post" class="row g-3 needs-validation" novalidate>
                  @csrf
                <i class="text-primary">
                  Your personal data will be used only for the statistical analysis of the results of this survey aimed to further improve the services we provide.
                  These are kept confidential and are never shared to the public.
              </i>

                  <div class="mb-3 mt-3 row">
                      <label for="clientName" class="form-label">Client Name</label>
                      <div class="col-sm-6">
                        <input id="firstname" type="text" class="form-control" name="fname" placeholder="First Name" maxlength="70" required>
                        <div class="invalid-feedback">
                          Please enter your First Name.
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6">
                        <input id="lastname" type="text" class="form-control" name="lname" placeholder="Last Name" maxlength="30" required>
                        <div class="invalid-feedback">
                          Please enter your Last Name.
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 mb-3">
                      <label for="email" class="form-label">Email Address</label>
                      <input id="email" type="email" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email Address" maxlength="100" required>
                      <div class="invalid-feedback">
                        Please enter your Email Address.
                      </div>
                    </div>

                  </div>

             <div class="row">
                  <div class="col-sm-12">
                  <label for="category" class="form-label">Client Category</label>
                    <select id="category" class="form-select" name="type" required>
                      <option value="1">Parent/Guardian</option>
                      <option value="2">Administrator</option>
                      <option value="3">Alumni</option>
                      <option value="4">Others</option>
                  </select>

                </div>
              </div>

                  <div class="form-group" id="tbx-others">
                          <input id="others" type="text" class="form-control" name="others" maxlength="30">
                          <span for="others"><small class="text-muted">&nbsp; Please specify.</small></span>
                  </div>

               <span id="hr_stud">
                <div class="mb-3 row">
                  <div class="row" id="tbx-stud-fname">
                    <label for="clientName" class="form-label">Student Name</label>
                    <div class="col-sm-6">
                      <input id="stud-fname" type="text" class="form-control" name="stud_fname" placeholder="First Name" maxlength="70" required>
                      <div class="invalid-feedback">
                        Please enter your First Name.
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6" id="tbx-stud-lname">
                      <input id="stud-lname" type="text" class="form-control" name="stud_lname" placeholder="Last Name" maxlength="30" required>
                      <div class="invalid-feedback">
                        Please enter your Last Name.
                      </div>
                    </div>
                </div>
              </div>


                  <div class="modal-footer">

                  <div class="form-group  row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input id="agree" type="checkbox" class="form-check-input" name="agree" value="agree" required>
                            <label class="form-check-label" for="agree">
                                I allow this site to collect my personal data and use it for the statistical analysis of this survey.
                            </label>
                        </div>
                    </div>
                </div>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Login</button>
                  </div>

              </form>
          </div>

          </div>
        </div>
      </div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    $(document).ready(function () {
        // if ($(window).width() < 510) {
        //   $('#hero > div > img').attr('style','display:none');
        //   }
        //   else {
        //     $('#hero > div > img').removeAttr('style');
        //   }
        // window.addEventListener('resize', function(event) {
        //   if ($(window).width() < 510) {
        //   $('#hero > div > img').attr('style','display:none');
        //   }
        //   else {
        //     $('#hero > div > img').removeAttr('style');
        //   }
        // }, true);
        $('#tbx-others').hide();

        $('#category').change(function() {
            if ($(this).val() == "4")
            {
                $('#tbx-others').show();
                $('#others').attr('required', true);
            }
            else
            {
                $('#tbx-others').hide();
                $('#others').attr('required', false);
            }

            if ($(this).val() == "1")
            {
                $('#hr-stud').show();
                $('#tbx-stud-fname').show();
                $('#tbx-stud-lname').show();
                $('#tbx-label').show();
                $('#stud-fname').attr('required', true);
                $('#stud-lname').attr('required', true);
            }
            else
            {
                $('#hr-stud').hide();
                $('#tbx-stud-fname').hide();
                $('#tbx-stud-lname').hide();
                $('#tbx-label').hide();
                $('#stud-fname').attr('required', false);
                $('#stud-lname').attr('required', false);
            }
        });

        (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()

    });


</script>


@error('stud_id')
<script>
   $(document).ready(function () {
$('#StudentLogin').modal('show');
   });
</script>
@enderror

@error('username')
<script>
   $(document).ready(function () {
$('#EmployeeLogin').modal('show');
   });
</script>
@enderror



@endsection
