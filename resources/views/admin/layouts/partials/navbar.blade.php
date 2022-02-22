<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if (Auth::check())
                @if (Auth::user()->getFirstMedia('user-profile'))
                <img src="{{Auth::user()->getFirstMedia('user-profile')->getUrl()}}" class="user-image img-circle elevation-2"
                    alt="User Image">
                @else
                <img src="{{asset('upload/img/avatar/default-avatar.png')}}" class="user-image img-circle elevation-2"
                    alt="User Image">
                @endif
                @endif

                @if (Auth::check())
                <span class="d-none d-md-inline">{{Auth::user()->name}}</span>

                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    @if (Auth::check())
                    @if (Auth::user()->getFirstMedia('user-profile'))
                    <img src="{{Auth::user()->getFirstMedia('user-profile')->getUrl()}}" class="img-circle elevation-2" alt="User Image">
                    @else
                    <img src="{{asset('upload/img/avatar/default-avatar.png')}}" class="img-circle elevation-2"
                        alt="User Image">
                    @endif
                    @endif


                    @if (Auth::check())
                    <p>
                        {{Auth::user()->name}} - {{Auth::user()->role}}
                        <small>{{Auth::user()->email}}</small>
                    </p>
                    @endif

                </li>
                <!-- Menu Body -->
                {{-- <li class="user-body">
            <div class="row">
              <div class="col-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>

          </li> --}}
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ url('admin/profile') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Sign
                        out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
