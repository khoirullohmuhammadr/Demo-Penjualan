<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0 text-bold">Dashboard</h1> -->

            @if(session('success'))
    <div id="alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        
<div class="container">
<h3 class="m-0 text-bold">Sells Report</h3>
  @include('components.sell-report')
</div>
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

<style>
/* Jika perlu, tambahkan CSS untuk memastikan transisi terlihat */
.alert {
    opacity: 1;
    transition: opacity 0.5s ease;
}
</style>


          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <!-- /.content -->
  </div>