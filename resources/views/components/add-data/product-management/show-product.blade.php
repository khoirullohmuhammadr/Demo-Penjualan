<div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
           
              <h3 class="card-title">Product List</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <ol class="list-group list-group-numbered">
            @foreach ($products as $data)
<li class="list-group-item d-flex justify-content-between align-items-start">
  <div class="ms-2 me-auto flex">
    <!-- <img src="" alt=""> -->
    <div class="fw-bold">{{ $data->product_name }}</div>
  </div>
  <!-- <span class="badge text-bg-primary rounded-pill">14</span> -->
  <div class="between">
    <!-- <button  type="submit" class="btn btn-primary">Edit</button> -->
    <a href="{{ route('add-product.edit', $data->id) }}" class="btn btn-info">Edit</a>
    <form action="{{ route('add-product.delete', $data->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" >
                Delete
            </button>
        </form>
        <button class="btn btn-outline-primary btn-details" data-id="{{ $data->id }}">Details</button>
  </div>
</li>

 <!-- Detail popup untuk setiap produk -->
 <div id="user-detail-{{ $data->id }}" class="card user-detail-card hidden" style="width: 18rem;">
    <button class="btn-close"></button>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Name:</strong> {{ $data->product_name }}</li>
        <li class="list-group-item">
            <img src="{{ asset('images/products/'. $data->image) }}" class="card-img-top" alt="{{ $data->product_name }}">
        </li>
    </ul>

    <div class="card-body">
        <a href="{{ route('add-product.edit', $data->id) }}" class="btn btn-info">Edit</a>
        <form action="{{ route('add-product.delete', $data->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
  </div>
@endforeach

  
</ol>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div id="overlay" class="overlay hidden"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const detailButtons = document.querySelectorAll(".btn-details");
        const overlay = document.getElementById('overlay');
        let currentOpenDetail = null;

        // Menampilkan detail user dan overlay
        detailButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const userId = event.target.getAttribute("data-id");
                const userDetailCard = document.getElementById(`user-detail-${userId}`);
                
                // Jika ada detail lain yang terbuka, tutup terlebih dahulu
                if (currentOpenDetail && currentOpenDetail !== userDetailCard) {
                    currentOpenDetail.classList.add("hidden");
                }

                // Tampilkan popup detail dan overlay
                userDetailCard.classList.remove("hidden");
                overlay.classList.remove("hidden");
                
                // Set detail yang saat ini dibuka
                currentOpenDetail = userDetailCard;
            });
        });

        // Menutup detail user dan overlay
        const closeButtons = document.querySelectorAll(".btn-close");
        closeButtons.forEach(button => {
            button.addEventListener("click", (event) => {
                const card = event.target.closest(".card.user-detail-card");
                card.classList.add("hidden");
                
                // Sembunyikan overlay
                overlay.classList.add("hidden");

                // Reset current open detail
                currentOpenDetail = null;
            });
        });

        // Tutup popup saat overlay di klik
        overlay.addEventListener("click", () => {
            if (currentOpenDetail) {
                currentOpenDetail.classList.add("hidden");
                currentOpenDetail = null;
            }
            overlay.classList.add("hidden");
        });
    });
</script>

<style>
  table {
    border: 1px solid gray;
  }

  .user-detail-card {
    position: fixed;
    right: 2%;
    bottom: 4rem;
    z-index: 999;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    max-width: 500px;
    display: flex;
    flex-direction: column;
  }

  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 998;
  }
  .hidden {
    display: none;
  }
  img{
    max-width:300px;
    max-height:300px;
  }
</style>