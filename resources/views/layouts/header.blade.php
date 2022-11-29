    <!-- ======= Header ======= -->
    <div id="header" class="fixed-top d-flex align-items-center">
      <div class="container">
        <div class="header-container d-flex align-items-center justify-content-between">
          <div class="logo">
            <h1 class="text-light">
              <a href="{{route('index')}}">
              <span> <img class="pnc" src="{{ asset('assets/img/CSS-NEW.png') }}" height="33"> </span>
              </a>
            </h1>
          </div>



          @if(Auth::guard('student')->user())
            <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto" href="{{route('index')}}">Home</a></li>

                    <li class="nav-link dropdown"><a href="#"><span>
                      {{Auth::guard('student')->user()->info->fullname}}
                      </span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                      <li class="nav-item dropdown">
                          <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                          Logout
                          </a>
                      </li>
                  <form method="post" action="{{ route('logout') }}" class="d-none" id="form-logout">
                        @csrf
                      </form>
                    </li>

                    </ul>
                  </li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- employee navbar -->




          @elseif(Auth::user())
            <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto" href="{{route('index')}}">Home</a></li>
                  <li class="dropdown"><a href="#"><span>My Departments</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>

                      @foreach(Auth::user()->emp_depts as $ed)

                        <li><a href="{{route('dept_quali',[$ed->department->acronym])}}">{{$ed->department->name}}</a></li>

                      @endforeach

                    </ul>

                  </li>
                @if(Auth::user()->admin)
                  <li class="dropdown"><a href="#"><span>Admin</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{route('admin.service')}}">Services</a></li>
                      <li><a href="{{route('admin.responses')}}">Survey Log</a></li>
                      <li><a href="{{route('admin.clients')}}">Summary of Clients</a></li>
                      <li><a href="{{route('admin.qualitative')}}">Qualitative Data</a></li>
                      <li><a href="{{route('admin.quantitative')}}">Quantitative Data</a></li>
                      <li><a href="{{route('admin.overall')}}">Overall Ratings</a></li>

                    </ul>
                  </li>
                  @endif
                    <li class="nav-link dropdown "><a href="#"><span>
                      {{Auth::user()->info->fullname}}
                      </span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                      <li class="nav-item dropdown">
                          <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                          Logout
                          </a>
                      </li>
                  <form method="post" action="{{ route('logout') }}" class="d-none" id="form-logout">
                        @csrf
                      </form>
                    </li>

                    </ul>
                  </li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
          <!-- employee navbar -->

          @elseif(session('guest'))
            <nav id="navbar" class="navbar">
              <ul>
                  <li><a class="nav-link scrollto" href="{{route('index')}}">Home</a></li>
                    <li class="nav-link dropdown"><a href="#"><span>
                      {{session('fname').' '.session('lname')}}
                      </span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                      <li class="nav-item dropdown">
                          <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                          Logout
                          </a>
                      </li>
                         <form method="post" action="{{ route('logout') }}" class="d-none" id="form-logout">
                        @csrf
                      </form>
                    </li>

                    </ul>
                  </li>
              </ul>

              <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- guest navbar -->
@endif

        </div>
        <!-- End Header Container -->
      </div>
    </div>
    <!-- End Header -->
