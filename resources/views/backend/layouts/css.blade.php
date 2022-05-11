<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets') }}/plugins/toastr/toastr.min.css">

<style>
  .borad {
    border-radius: 0px !important;
  }

  .m1 {
    margin: 1px !important;
  }

  .toast-warning > .toast-message {
    color: #3c3c3c !important;
  }
</style>

@yield('css')
@stack('css')