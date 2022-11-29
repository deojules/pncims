@extends('layouts.app')

@section('content')
  <!-- ======= Breadcrumbs ======= -->


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
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

                                        },
                                        error: function () {
                                          

                                        }
                                    });
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
                        
                 
                        <form action="{{route('search')}}" method="get">
                    
                          <div class="input-group mb-5">
                            <input type="text" class="form-control" name="search" placeholder="Search using keywords"  aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                          </div>
                          
                        </form>
                  

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
                      </div>
                    </section>
                  </div>
                </section> <!--End of Deparment Content-->


 
@endsection

@section('modal')
    
@endsection

@section('script')
    
@endsection
