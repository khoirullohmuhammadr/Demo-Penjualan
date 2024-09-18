<div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
           
              <h3 class="card-title">City List</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <ol class="list-group list-group-numbered">
            @foreach ($city as $data)
<li class="list-group-item d-flex justify-content-between align-items-start">
  <div class="ms-2 me-auto flex">
    <!-- <img src="" alt=""> -->
    <div class="fw-bold">{{ $data->city_name }}</div>
  </div>
  <!-- <span class="badge text-bg-primary rounded-pill">14</span> -->
  <div class="between">
    <!-- <button  type="submit" class="btn btn-primary">Edit</button> -->
    <a href="{{ route('add-city.edit', $data->id) }}" class="btn btn-info">Edit</a>
    <form action="{{ route('add-city.delete', $data->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-danger" >
                Delete
            </button>
        </form>
  </div>
</li>
@endforeach

  
</ol>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>