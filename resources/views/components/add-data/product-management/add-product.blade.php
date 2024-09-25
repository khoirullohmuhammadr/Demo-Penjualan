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
        <div class="row">
        @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3)
          <div class="col-md-6">
            <form class="card card-primary"
              action="{{ isset($editProduct) ? route('add-product.update', $editProduct->id) : route('add-product.store') }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              @if (isset($editProduct))
                @method('PUT')
              @endif
              <div class="card-header">
                <h3 class="card-title">
                  {{ isset($editProduct) ? 'Edit Product' : 'Add Product' }}
                </h3>
              </div>
              <div class="card-body">
                <!-- Product Name -->
                <div class="form-group">
                  <label for="inputName">Product Name:</label>
                  <input type="text" id="inputName" name="product_name" class="form-control"
                    value="{{ isset($editProduct) ? $editProduct->product_name : '' }}" required>
                  @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Select Picture</label>
                        <input class="form-control" type="file" name="image" id="formFile">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="row">
                  <div class="col-12">
                    <a href="{{ route('add-product') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="{{ isset($editProduct) ? 'Update Product' : 'Add new Product' }}"
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
          @else
            
          @endif
          <!-- Product List Component -->
          @include('components.add-data.product-management.show-product')

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
