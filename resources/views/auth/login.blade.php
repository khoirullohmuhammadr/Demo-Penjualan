<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin lte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page .bg-dark.bg-gradient">
@if(session('alert-message'))
    <div id="alert-message" class="alert alert-info">
        {{ session('alert-message') }}
    </div>
@endif
@if(session('alert-signup'))
    <div id="alert-signup" class="alert alert-success">
        {{ session('alert-signup') }}
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menghilangkan elemen berdasarkan ID
    function hideAlert(alertId) {
        var alert = document.getElementById(alertId);
        if (alert) {
            setTimeout(function() {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500); // Waktu tambahan untuk transisi efek fade out
            }, 2000); // Waktu sebelum alert mulai menghilang (3 detik)
        }
    }

    // Panggil fungsi untuk kedua ID
    hideAlert('alert-message');
    hideAlert('alert-signup');
});
</script>

<div class="login-box">
  <div class="login-logo">
    <a href="{{asset('admin lte/index2.html')}}"><b>Log</b> in</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

     @if (session('failed'))
        <div class="alert alert-danger">{{session('failed')}}</div>
     @endif

      <p class="login-box-msg">Log in to start your session</p>

      <form action="/login" method="post">
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
            <!-- <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
      does'nt have an account?
        <a href="/register">Sign Up</a>
      </p> -->
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
