<table class="table table-primary table-hover">
  <tr class="table-secondary">
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Primary City</th>
    <th scope="col">Role</th>
    <th scope="col">Action</th>
  </tr>
  <ol class="list-group-numbered">
  @foreach ($user as $x)
  <tr>
    <th class="list-group-numbered">{{ $x->id }}</th>
    <td>{{ $x->name }}</td>
    <td>{{ $x->email }}</td>
    <td>{{ $x->city->city_name }}</td> 
    <td>{{ $x->role->role }}</td> 
    <td>
    <div class="between">
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <!-- Cek jika user dengan role_id == 1 (Super Admin), hanya super admin lain yang bisa edit atau delete -->
            @if ($x->role_id != 1 || Auth::user()->role_id == 1)
                <a href="{{ route('add-user.edit', $x->id) }}" class="btn btn-info">Edit</a>
                <form action="{{ route('user-list.delete', $x->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        @endif

        <!-- Tombol Details, selalu muncul -->
        <button class="btn btn-outline-primary btn-details" data-id="{{ $x->id }}">Details</button>
    </div>
</td>

  </tr>

  <!-- Detail popup untuk setiap user -->

  <div id="user-detail-{{ $x->id }}" class="card user-detail-card hidden" style="width: 18rem;">
    <button class="btn-close"></button>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Name:</strong> {{ $x->name }}</li>
        <li class="list-group-item">
            <img src="{{ asset('images/users/'. $x->image) }}" class="card-img-top" alt="{{ $x->name }}">
        </li>
        <li class="list-group-item"><strong>Email:</strong> {{ $x->email }}</li>
        <li class="list-group-item"><strong>Birthday:</strong> {{ $x->birthday }}</li>
        <li class="list-group-item"><strong>City:</strong> {{ $x->city->city_name }}</li>
    </ul>
    <div class="card-body">     
    @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
        <a href="{{ route('add-user.edit', $x->id) }}" class="btn btn-info">Edit</a>
        <form action="{{ route('user-list.delete', $x->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @else
        @endif
        <p></p>
    </div>
  </div>
  @endforeach
  </ol>
</table>

<!-- Overlay -->
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
    bottom: 2rem;
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
    max-width:200px;
    max-height:200px;
  }
</style>
