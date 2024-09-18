<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Product</title>
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
              <h1>Product Management</h1>
            </div>
       
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="column content-wrapper">
          <div class="col-md-6">
            <form class="card card-primary"
              action="{{ isset($stok) ? route('stok-input.update', $stok->id) : route('stok-input.store') }}"
              method="POST">
              @csrf
              @if (isset($stok))
                @method('PUT')
              @endif
           
              <div class="card-body">
                <!-- Product Name -->
                <div class="form-group">
                    <label for="inputStatus">Product</label>
                    <select id="inputStatus" class="form-control custom-select" name="products_id">
                        <option value="" disabled>Select one</option>
                        @foreach ($product as $c)
                        <option value="{{ $c->id }}" {{ (isset($stok) && $c->id == $stok->products_id) ? 'selected' : '' }}>
                            {{ $c->product_name }}
                        </option>
                    @endforeach

                    </select>
                    @error('products_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="inputName">Stok</label>
                  <input type="number" id="inputName" name="stok" class="form-control"
                    value="{{ old('stok', $stok->stok ?? '')}}" required>
                  @error('stok')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="inputName">Input Date</label>
                  <input type="date" id="inputName" name="input_date" class="form-control"
                    value="{{ old('input_date', $stok->input_date ?? '') }}" required>
                  @error('input_date')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Image Upload -->
        

                <!-- Submit and Cancel Buttons -->
                <div class="row">
                  <div class="col-12">
                    <a href="{{ route('add-product') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="{{ isset($stok) ? 'Update Product' : 'Add new Stok' }}"
                      class="btn btn-success float-right">
                  </div>
                </div>
              </div>
            </form>

            <!-- Success Alert -->
            @if (session('success'))
              <div id="alert" class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

          </div>


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

  <!-- jQuery -->
  <script src="{{asset('admin lte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('admin lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin lte/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('admin lte/dist/js/demo.js')}}"></script>

  <!-- Alert auto-hide -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      setTimeout(function () {
        var alert = document.getElementById('alert');
        if (alert) {
          alert.style.transition = "opacity 0.5s ease";
          alert.style.opacity = "0";
          setTimeout(function () {
            alert.style.display = 'none';
          }, 500);
        }
      }, 2000);
    });
  </script>
</body>

</html>
