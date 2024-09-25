<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="{{asset('admin lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
        @if(auth()->check())
            <a href="#" class="d-block">{{ auth()->user()->email }}</a>
            <div class="flex text-white">
              <p>You Log in as:</p>
              <a href="#" class="d-block">{{ auth()->user()->role->role }}</a>
            </div>
        @else
            <a href="#" class="d-block">Guest(not login yet)</a>
        @endif
    </div>
      </div>