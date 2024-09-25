<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add City</title>
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
              <h1>City Management</h1>
            </div>
  
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
        @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
          <div class="col-md-6">
            <form class="card card-primary"
              action="{{ isset($editCity) ? route('add-city.update', $editCity->id) : route('add-city.create') }}"
              method="POST">
              @csrf
              @if (isset($editCity))
          @method('PUT')
        @endif
              <div class="card-header">
                <h3 class="card-title">
                  {{ isset($editCity) ? 'Edit City Name' : 'Add City Name' }}
                </h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">City Name:</label>
                  <input type="text" id="inputName" name="city_name" class="form-control"
                    value="{{ isset($editCity) ? $editCity->city_name : '' }}" required>
                  @error('city_name')
            <div class="text-danger">{{ $message }}</div>
          @enderror
                </div>

                <div class="row">
                  <div class="col-12">
                    <a href="{{ route('add-city') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="{{ isset($editCity) ? 'Update City' : 'Add new City' }}"
                      class="btn btn-success float-right">
                  </div>
                </div>
              </div>
            </form>
          @else
            @if (session('success'))
        <div id="alert" class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif
@endif
            <!-- /.card -->
          </div>
          @include('components.add-data.read-data.show-city')
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('components.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Menghilangkan alert setelah 3 detik
      setTimeout(function () {
        var alert = document.getElementById('alert'); // ID sesuai dengan elemen HTML
        if (alert) {
          alert.style.transition = "opacity 0.5s ease";
          alert.style.opacity = "0";
          setTimeout(function () {
            alert.style.display = 'none'; // Hapus elemen dari tampilan setelah transisi
          }, 500); // Waktu tambahan untuk transisi efek fade out
        }
      }, 2000); // Waktu sebelum alert mulai menghilang (3 detik)
    });
  </script>
</body>

</html>