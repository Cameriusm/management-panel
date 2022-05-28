<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Панель - @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}"  type='image/x-icon'>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/panels/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/panels/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/panels/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/panels/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/panels/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/panels/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/panels/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/panels/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/panels/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/panel" class="brand-link">
    <img src="/panels/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Панель Отчётов</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-/panels align-items-center justify-content-left ml-3 d-flex">
      <div class="d-block info justify-content-center mt-3  d-flex flex-column text-light">
        <!-- Request user information -->
        <a>Профиль: {{ Auth::user()->name }}</a>
        @switch ( auth()->user()->roles->pluck('name')[0])
          @case('admin')
            <a>Роль: Администратор</a>
          @break
          @case('manager')
            <a>Роль: Менеджер</a>
          @break
          @case('worker')
            <a>Роль: Рабочий</a>
            @break
          @default
            <a >Роль: ¯\_(ツ)_/¯</a>
        @endswitch
          <!-- Show current date and time -->
        <a>Дата:
          <div class="d-inline" id="livedate">
            {{ \Carbon\Carbon::now()->toDateString() }} 
            </div>
        </a>
        <a id="">Время:  
          <div class="d-inline" id="livetime">
          {{ \Carbon\Carbon::now()->toTimestring() }} 
        </div>
        </a>
      </div>
    </div>
    <div class="d-block ml-3  d-flex flex-column text-light">
  </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2  ">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (Auth::user()->roles->pluck('name')[0] != ('worker'))
        <li class="nav-header">ГЛАВНОЕ МЕНЮ</li>
              <li class="nav-item ">
                <a href="/panel" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Главная
                </p>
              </a>
        @endif
        <li class="nav-header">МЕНЕДЖМЕНТ</li>
        <!-- Check user role to show/hide UI accordingly -->
        @if (Auth::user()->roles->pluck('name')[0] == ('admin') || Auth::user()->roles->pluck('name')[0] == ('manager'))
        <li class="nav-item">
          <a href="{{ route('staff') }}" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Список сотрудников
            </p>
          </a>
        </li>
        @endif
        @if (Auth::user()->roles->pluck('name')[0] == ('worker'))
        <li class="nav-item">
          <a href="{{ route('reports.index') }}" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Список отчётов
            </p>
          </a>
        </li>

        @endif
        @if (Auth::user()->roles->pluck('name')[0] == ('admin'))
        <li class="nav-header">АДМИНИСТРИРОВАНИЕ</li>
        <li class="nav-item">
          <a href="{{route('rights.index')}}" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
              Изменение прав
            </p>
          </a>
        </li>
        @endif
        <li class="nav-header">ПРОФИЛЬ</li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Настройки</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Смена данных</p>
          </a>
        </li> --}}
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
            <i class="nav-icon far fa-circle text-info"></i>
                Выйти
              </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
        </div>
    @elseif(session('error'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-times-circle"></i>{{ session('error') }}</h4>
    </div>
            @endif
    @yield('content')
  </div>
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  // Updates liveTime on sidebar
  function showTime() {
    function addZero(i) {
      if (i < 10) {i = "0" + i}
      return i;
    }

    const d = new Date();
    d.toLocaleString('ru-RU', { timeZone: 'Asia/Krasnoyarsk' })
    let h = addZero(d.getHours());
    let m = addZero(d.getMinutes());
    let s = addZero(d.getSeconds());
    let time = h + ":" + m + ":" + s;
    let date = 
    document.getElementById("livetime").innerHTML = time;
    var dd = String(d.getDate()).padStart(2, '0');
    var mm = String(d.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = d.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;   
    document.getElementById("livedate").innerHTML = today;
  }

  setInterval(showTime, 1000);
</script>
<!-- jQuery -->
<script src="/panels/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/panels/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/panels/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/panels/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/panels/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/panels/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/panels/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/panels/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/panels/plugins/moment/moment.min.js"></script>
<script src="/panels/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/panels/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/panels/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/panels/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/panels/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/panels/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/panels/dist/js/pages/dashboard.js"></script>
<script src="/panels/panel.js"></script>
</body>
</html>
