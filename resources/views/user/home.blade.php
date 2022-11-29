

  <!-- ======= Breadcrumbs ======= -->
  <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
  <script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>


        @if(session()->has('message'))

            <script>
            Swal.fire({
          title: 'Do you want to survey again?',

          icon: 'warning',
          showDenyButton: true,
          denyButtonText: `Logout`,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isDenied) {


                                  $.ajaxSetup({
                                          headers: {
                                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                          }
                                      });

                                  $.ajax({
                                              url: "{{ route('logout') }}",
                                              type: "POST",
                                              success: function (response) {
                                                window.location.reload();
                                                unset(response)


                                              },
                                              error: function () {


                                              }
                                          });
                              }

                              else
                              {
                                $.ajaxSetup({
                                          headers: {
                                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                          }
                                      });

                                  $.ajax({
                                              url: "/validatemessage",
                                              type: "POST",
                                              success: function (response) {



                                              },
                                              error: function () {


                                              }
                                          });

                                          window.location.reload();
                              }


                          })
              </script>

    @endif




                 <!-- ======Department/Service Section ======= -->
                 <section class="inner-page">
                    <div class="container">

                      <section id="services" class="services">
                        <div class="container">
                            <div class="section-title" data-aos="fade-right">
                            <h2>Departments</h2>
                            <p>Choose from the following departments for your survey.</p>
                          </div>


                          <form action="{{route('search')}}" method="post" id="search-content">
                              @csrf

                              <div class="input-group mb-5">

                                <input type="text" class="form-control" id="search" name="search" placeholder="Search using keywords"  aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i> Search</button>
                                  <button class="btn btn-outline-secondary" onClick="window.location.reload();" type="button"><i class="bi bi-arrow-repeat"></i></button>

                                </div>

                              </div>

                          </form>

                          <div id="homeData">

                            @include('user.homeData')

                        </div>


                        </div>
                      </section>
                    </div>
                  </section> <!--End of Deparment Content-->


                  @section('script')

                  <script>

                  $(document).ready(function () {

                      $('#main').on('submit', '#search-content', function (e) {
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

                              $('#homeData').html(data)
                              $('html, body').animate({scrollTop: '0px'}, 0);

                          },
                          error: function () {

                          },
                      });

                      // departments redirect to survey

                      e.preventDefault();
                  });

                  $('#myElement').click(function() {
                 location.reload();
                  });

                  const reloadtButton = document.querySelector("#reload");
                    // Reload everything:
                    function reload() {
                        reload = location.reload();
                    }
                    // Event listeners for reload
                    reloadButton.addEventListener("click", reload, false);

                  });
                  </script>


                  @endsection
