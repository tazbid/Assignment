<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard', []) }}" class="brand-link">
        {{-- <img src="{{asset('admin-assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Assignment</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @auth
            <div class="image">
                @if (Auth::user()->getFirstMedia('user-profile'))
                <img src="{{Auth::user()->getFirstMedia('user-profile')->getUrl()}}" class="img-circle elevation-2"
                    alt="User Image">
                @else
                <img src="{{asset('upload/img/avatar/default-avatar.png')}}" class="img-circle elevation-2"
                    alt="User Image">
                @endif
                @endauth


            </div>
            <div class="info">
                @if (Auth::check())
                <a href="{{ url('admin/profile') }}" class="d-block">{{Auth::user()->name}}</a>
                @endif

            </div>
        </div>
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                {{-- <li class="nav-item">
                <a href="{{ url(/admin/dashboard) }}" class="nav-link" target="_blank">
                <i class="nav-icon fas fa-globe"></i>
                <p>
                    Visit Public Site
                </p>
                </a>
                </li> --}}
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="{{ url('/admin/dashboard', []) }}" class="nav-link @if (Request::is("admin/dashboard")) active
                        @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                {{-- doctor --}}
                @role('super-admin')
                <li class="nav-item has-treeview
                       @if (Request::is("admin/pricing/rules") || Request::is("admin/pricing/rule/*")) menu-open @endif ">
                       <a href=" #" class="nav-link
                           @if (Request::is("admin/pricing/rules") || Request::is("admin/pricing/rule/*")) active @endif">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        Pricing Rule
                        <i class="fas fa-angle-left right"></i>

                    </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ url('admin/pricing/rule/create', []) }}" class="nav-link @if (Request::is("admin/pricing/rule/create")) active @endif">
                                <i class="fas fa-prescription-bottle-alt nav-icon"></i>
                                <p>Add New Pricing Rule</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ url('admin/pricing/rules', []) }}" class="nav-link @if (Request::is("admin/pricing/rules")) active @endif">
                                <i class="fas fa-pills nav-icon"></i>
                                <p>All Pricing Rule List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                {{-- logs --}}
                {{-- <li class="nav-item has-treeview
                @if (Request::is("admin/log-viewer/*") || Request::is("admin/user-histories") || Request::is("admin/user-histories/*")
                || Request::is("admin/user-history/*")  || Request::is("admin/log-viewer"))
                menu-open @endif ">
                <a href="#" class="nav-link
                    @if(Request::is("admin/log-viewer/*") || Request::is("admin/user-histories") || Request::is("admin/log-viewer")) active @endif">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Logs
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ url('admin/log-viewer', []) }}" class="nav-link @if
                (Request::is("admin/log-viewer")) active @endif">
                <i class="fas fa-list-ul nav-icon"></i>
                <p>Log Dashboard</p>

                </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/log-viewer/logs', []) }}"
                        class="nav-link {{Request::is("admin/log-viewer/logs") ? 'active': ""}}">
                        <i class="fas fa-list-ol nav-icon"></i>
                        <p>Logs by Date</p>
                    </a>
                </li>
            </ul>
            </li> --}}

            {{-- <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
