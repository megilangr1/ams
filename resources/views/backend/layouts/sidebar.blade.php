<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name ?? 'Belum Login' }}</a>
      </div>
    </div>

    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item {{ Request::is('/main') ? 'active':'' }}">
          <a href="{{ route('backend.main') }}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Halaman Utama
            </p>
          </a>
        </li>
        <li class="nav-item {{ Request::is('roles', 'roles/*', 'permissions', 'permissions/*', 'users', 'users/*') ? 'menu-open':'' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Konfigurasi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item {{ Request::is('roles/*') ? 'active':'' }}">
              <a href="{{ route('roles.index') }}" class="nav-link">
                <i class="fa fa-lock nav-icon"></i>
                <p>Data Akses</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('permissions/*') ? 'active':'' }}">
              <a href="{{ route('permissions.index') }}" class="nav-link">
                <i class="fa fa-key nav-icon"></i>
                <p>Data Izin Akses</p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('users/*') ? 'active':'' }}">
              <a href="{{ route('users.index') }}" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Data Akun Pengguna</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>