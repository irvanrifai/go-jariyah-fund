<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Jariyah Fund</title>

  <link rel="icon" href="{{ asset('img/static/desain-03.png') }}"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('user/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('user/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('user/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('user/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset ('user/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('user/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('user/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('user/plugins/summernote/summernote-bs4.min.css')}}">

  @yield('css-new-dashboard')
  @yield('css-tracking')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
                    <i class="nav-icon fas fa-users text-info"></i>
                    <p>Approval Pendamping</p>
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('admin/approval-nazhir/request-pinjam') }}" class="nav-link {{ Request::is('admin/approval-nazhir/request-pinjam') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users text-success"></i>
                    <p>Approval Nazhir</p>
                </a>
            </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link {{ ((Request::is('admin/tampilpengajuanpinjam') || Request::is('admin/tampilcicilan')) ? 'active' : '' ) }}">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>Approval Admin</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilpengajuanpinjam') }}" class="nav-link {{ Request::is('admin/tampilpengajuanpinjam') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pengajuan Pinjam</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilcicilan') }}" class="nav-link {{ Request::is('admin/tampilcicilan') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Cicilan</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link {{ ((Request::is('admin/tampilandanamasuk') || Request::is('admin/tampilandanaterpakai')) ? 'active' : '' ) }}">
                    <i class="nav-icon fas fa-calculator"></i>
                    <p>Dana Bersama</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilandanamasuk') }}" class="nav-link {{ Request::is('admin/tampilandanamasuk') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dana Masuk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilandanaterpakai') }}" class="nav-link {{ Request::is('admin/tampilandanaterpakai') ? 'active' : '' }}">
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
                <a href="#" class="nav-link {{ ((Request::is('admin/tampilandutawakaf')  || Request::is('admin/tampilan-nazhir') || Request::is('admin/tampilan-projek') || Request::is('admin/pendamping')) ? 'active' : '' ) }}">
                    <i class="nav-icon fas fa-database"></i>
                    <p>Data Master</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilandutawakaf') }}" class="nav-link {{ Request::is('admin/tampilandutawakaf') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Duta Wakaf</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilan-nazhir') }}" class="nav-link {{ Request::is('admin/tampilan-nazhir') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nazhir</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/tampilan-projek') }}" class="nav-link {{ Request::is('admin/tampilan-projek') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Project</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/pendamping') }}" class="nav-link {{ Request::is('admin/pendamping') ? 'active' : '' }}">
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

<!-- jQuery -->
<script src="{{asset('user/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('user/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('user/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('user/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('user/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('user/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('user/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('user/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('user/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('user/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('user/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('user/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('user/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('user/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('user/dist/js/pages/dashboard.js')}}"></script>

@yield('js_plugins')
@yield('js_inline')
</body>
</html>
