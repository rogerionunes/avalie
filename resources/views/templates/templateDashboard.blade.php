<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Avalie | Dashboard </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('assets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{url('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{url('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Seja bem vindo, <strong>{{ Auth::user()->name }}.</strong></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.login.logout') }}" class="nav-link">Sair</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container MENU -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard')}}" class="brand-link">
      <img src="{{url('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Avalie</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.users.list') }}" class="nav-link @if (Request::segment(2) == 'user') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Usuario
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.curso.list') }}" class="nav-link @if (Request::segment(2) == 'curso') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Curso
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.disciplina.list') }}" class="nav-link @if (Request::segment(2) == 'disciplina') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Disciplina
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.turma.list') }}" class="nav-link @if (Request::segment(2) == 'turma') active @endif">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Turma
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">

    @yield('contentDashboard')
  </div>

  <footer class="main-footer">
    <strong>Avalie - Sistema de Avaliação Docente
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('assets/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Select2 -->
<script src="{{url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
  //Initialize Select2 Elements
  $('.select2').select2();
</script>
</body>
</html>