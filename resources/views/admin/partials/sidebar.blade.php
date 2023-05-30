<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{asset('user/dist/img/desain-03.png')}}" alt="jariyah-fund" height="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">

          <div class="navbar-search-block">

          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->

              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->

              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->

              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>

          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <div class="dropdown-divider"></div>

            <div class="dropdown-divider"></div>

            <div class="dropdown-divider"></div>

            <div class="dropdown-divider"></div>

          </div>
        </li>
        <li class="nav-item">

        </li>
        <li class="nav-item">

        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <center><img src="{{asset('/img/static/desain-01.png')}}" alt="jariyah-fund" class="brand-image img-square" style="width:185px; height: auto;"></center>
        <span class="brand-text font-weight-light"> </br></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="{{ url('admin/dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Dashboard</p>
                  </a>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="{{ url('admin/approval-pendamping/request-pinjam') }}" class="nav-link {{ Request::is('admin/approval-pendamping/request-pinjam') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-users"></i>
                      <p>Approval Pendamping</p>
                  </a>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="{{ url('admin/approval-nazhir/request-pinjam') }}" class="nav-link {{ Request::is('admin/approval-nazhir/request-pinjam') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-users-cog"></i>
                      <p>Approval Nazhir</p>
                  </a>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="#" class="nav-link {{ ((Request::is('admin/approval-admin/request-pinjam') || Request::is('admin/approval-admin/request-cicilan')) ? 'active' : '' ) }}">
                      <i class="nav-icon fas fa-list-ul"></i>
                      <p>Approval Admin</p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ url('admin/approval-admin/request-pinjam') }}" class="nav-link {{ Request::is('admin/approval-admin/request-pinjam') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pengajuan Pinjam</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/approval-admin/request-cicilan') }}" class="nav-link {{ Request::is('admin/approval-admin/request-cicilan') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Cicilan</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="#" class="nav-link {{ ((Request::is('admin/fund/incoming') || Request::is('admin/fund/used')) ? 'active' : '' ) }}">
                      <i class="nav-icon fas fa-calculator"></i>
                      <p>Dana Bersama</p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ url('admin/fund/incoming') }}" class="nav-link {{ Request::is('admin/fund/incoming') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Dana Masuk</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/fund/used') }}" class="nav-link {{ Request::is('admin/fund/used') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Dana Terpakai</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="{{ url('admin/group') }}" class="nav-link {{ Request::is('admin/group') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-user"></i>
                      <p>Group</p>
                  </a>
                  {{-- <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ url('admin/tampilangroup') }}" class="nav-link {{ Request::is('admin/tampilangroup') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>List Group</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/tampilanlistanggota') }}" class="nav-link {{ Request::is('admin/tampilanlistanggota') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>List Anggota</p>
                          </a>
                      </li>
                  </ul> --}}
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="#" class="nav-link {{ ((Request::is('admin/duta-wakaf-list')  || Request::is('admin/nazhir-list') || Request::is('admin/project-list') || Request::is('admin/pendamping-list')) ? 'active' : '' ) }}">
                      <i class="nav-icon fas fa-database"></i>
                      <p>Data Master</p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ url('admin/duta-wakaf-list') }}" class="nav-link {{ Request::is('admin/duta-wakaf-list') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Duta Wakaf</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/nazhir-list') }}" class="nav-link {{ Request::is('admin/nazhir-list') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Nazhir</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/project-list') }}" class="nav-link {{ Request::is('admin/project-list') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Project</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/pendamping-list') }}" class="nav-link {{ Request::is('admin/pendamping-list') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pendamping</p>
                          </a>
                      </li>
                  </ul>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="{{ url('admin/setting') }}" class="nav-link {{ Request::is('admin/setting') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-cog"></i>
                      <p>Setting</p>
                  </a>
              </li>
          </ul>

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <form action="{{ url('admin-logout') }}" method="post">
                  @csrf
                      <button type="submit" class="nav-link bg-white d-flex border-0">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>Logout</p>
                      </button>
                  </form>
              </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @yield('body')

    @yield('js-new-dashboard')
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
