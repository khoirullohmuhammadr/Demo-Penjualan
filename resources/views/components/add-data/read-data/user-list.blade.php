<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User List</title>
  <!-- bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin lte/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    @include('components.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('components.sidebar.mainsidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Project Add</h1>
            </div>
        
            <div class="col-sm-6">
              @if (session('success'))
          <div id="alert" class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
       <div class="justify-content-lg-center" style="width:100%; padding:0 5vw;">
         @include('components.add-data.read-data.table-list')
       </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- @include('components.footer') -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('admin lte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('admin lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin lte/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('admin lte/dist/js/demo.js')}}"></script>
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
</body>

</html>