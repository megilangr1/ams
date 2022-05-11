<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LAPORAN PENDUKUNG & DIGITALISASI DATA | Sistem Elektronik Manajemen Barang Daerah</title>

  @include('backend.layouts.css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('backend.layouts.navbar')

  @include('backend.layouts.sidebar')

  <div class="content-wrapper">
    {{-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Starter Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="content pt-3">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      MeGGi
    </div>
    <strong>Copyright &copy; 2022 <a href="{{ env('APP_URL') }}"> {{ env('APP_NAME') }} </a>.</strong>
  </footer>
</div>

@include('backend.layouts.script')

</body>
</html>
