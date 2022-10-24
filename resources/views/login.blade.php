<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <link href="/dist/colorbox.css" rel="stylesheet">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>

<style>
  .myForm {
  min-width: 400px;
  position: absolute;
  text-align: center;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 1.5rem
  }
</style>
<body class="dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  
  <!-- /.navbar -->

  

  
</div>
<div class="container">
  <form class="myForm" method="post" action="{{route('login.admin')}}">
    @if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
  @endif
    @csrf
    <div class="form-group">
      <label for="email">Email</label>
      @if($errors->has('email'))
                <div class="error text-danger">{{ $errors->first('email') }}</div>
              @endif
      <input class="form-control input-lg" type="email" name="email" id="email" placeholder="email" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      @if($errors->has('password'))
                <div class="error text-danger">{{ $errors->first('password') }}</div>
              @endif
      <input class="form-control input-lg" type="password" name="password" placeholder="password" />
    </div>
    <div class="form-group">
      <input type="submit" name="submit" class="btn btn-success btn-lg" value="Sign Up" />
    </div>
  </form>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/plugins/raphael/raphael.min.js"></script>
<script src="/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/plugins/jquery-mapael/maps/usa_states.min.js"></script>


<script src="/dist/js/pages/dashboard2.js"></script>
<script type="text/javascript" src="/dist/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="/packages/barryvdh/elfinder/js/standalonepopup.min.js"></script>
</body>
</html>