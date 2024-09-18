<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin lte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
@if(session('message'))
    <div id="alert" class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menghilangkan alert setelah 3 detik
    setTimeout(function() {
        var alert = document.getElementById('alert'); // ID sesuai dengan elemen HTML
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(function() {
                alert.style.display = 'none'; // Hapus elemen dari tampilan setelah transisi
            }, 500); // Waktu tambahan untuk transisi efek fade out
        }
    }, 2000); // Waktu sebelum alert mulai menghilang (3 detik)
});
</script>

<div class="login-box">
  <div class="login-logo">
    <a href="{{asset('admin lte/index2.html')}}"><b>Sign</b> Up</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

     @if (session('failed'))
        <div class="alert alert-danger">{{session('failed')}}</div>
     @endif

      <p class="login-box-msg">sign up to enter login session</p>

      <form action="{{route('register')}}" method="post">
        @csrf

        @error('email')
        <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        @error('password')
      <small class="text-danger">{{$message}}</small>
      @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append show-password">
            <div class="input-group-text">
              <span class="fas fa-lock" id="password-lock"></span>
            </div>
          </div>
        </div>
        
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
      already have an account?
        <a href="/">Sign In</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin lte/dist/js/adminlte.min.js')}}"></script>

<script>
   $('.show-password').on('click', function(){
    if($('#password').attr('type') == 'password'){
      $('#password').attr('type', 'text');
      $('#password-lock').attr('class', 'fas fa-unlock');
    }else{
      $('#password').attr('type', 'password');
      $('#password-lock').attr('class', 'fas fa-lock');
    }
   })
</script>
</body>
</html>
