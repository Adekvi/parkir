<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('judul')</title>

  @include('admin.partisi.include.css')
  @stack('css')
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('admin.partisi.include.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.partisi.include.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partisi.include.header')
        <!-- /.content-header -->

        <!-- Main content -->
        @yield('konten')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
    @include('admin.partisi.include.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
<!-- ./wrapper -->

@include('admin.partisi.include.js')
@stack('js')

</body>
</html>
