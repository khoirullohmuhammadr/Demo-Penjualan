<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="index3.html" class="brand-link">
      <img src="{{asset('admin lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <div class="sidebar">
        @include('components.Sidebar.userpanel')
        @include('components.Sidebar.nav')
    </div>
</aside>