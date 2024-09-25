<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      
          <li class="nav-item">
            <a href="/dashboard" class="nav-link {{(request()->is('dashboard')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 )
          <li class="nav-header">User Data Management</li>
          <li class="nav-item">
            <a href="/add-user" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Add User</p>
            </a>
          </li>
          @else
          @endif
          @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
          <li class="nav-item">
            <a href="/add-user/user-list" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User List
              </p>
            </a>
          </li>
             @else
          @endif
          @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
          <li class="nav-item">
            <a href="/role" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Role List
              </p>
            </a>
          </li>
             @else
          @endif
          @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
          <li class="nav-item">
            <a href="/add-city" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                City Management
              </p>
            </a>
          </li>
             @else
          @endif
          <li class="nav-header">Product Management</li>
     
          <li class="nav-item">
            <a href="/add-product" class="nav-link">
              <i class="nav-icon fas fa-sign"></i>
              <p>Product Management</p>
            </a>
          </li>
     
          @if(Auth::user()->role_id == 1 ||Auth::user()->role_id == 2 ||Auth::user()->role_id == 3 )
          <li class="nav-item">
            <a href="/stok-input" class="nav-link">
              <i class="nav-icon fas fa-sign"></i>
              <p>Add Stok Product </p>
            </a>
          </li>
          @else
          @endif
        
          <li class="nav-item">
            <a href="/stok-input/stok-list" class="nav-link">
              <i class="nav-icon fas fa-sign"></i>
              <p>Stok List </p>
            </a>
          </li>
          <li class="nav-header">More Option</li>
        

          <!-- <li class="fa-settings"></li> -->
          <form  action="{{ route('logout')}}" method="POST">
            @CSRF
          <li class="nav-item">
            <button type="submit" class="btn-info btn text-white nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log out
              </p>
            </button>
          </li>
          </form>
        </ul>
      </nav>

      