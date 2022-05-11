@extends('backend.layouts.master')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title text-lg"> <span class="fa fa-lock"></span> &ensp; Ubah Data Akun Pengguna | {{ $user->name }}</h3>
        <div class="card-tools">
          <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm">
            <span class="fa fa-arrow-left"></span> &ensp; 
            Kembali 
          </a>
        </div>
      </div> 
      <div class="card-body"> 
        <form action="{{ route('users.update', $user->id) }}" method="post">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Nama Pengguna : </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text borad">
                      <span class="fa fa-address-card"></span>
                    </span>
                  </div>
                  <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" value="{{ $user->name }}" placeholder="Masukan Nama Pengguna..." autocomplete="off" autofocus required>
                  <span class="invalid-feedback">
                    {{ $errors->first('name') }}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Email Pengguna : </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text borad">
                      <span class="fa fa-envelope"></span>
                    </span>
                  </div>
                  <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" value="{{ $user->email }}" placeholder="Masukan Email Pengguna..." autocomplete="off" required>
                  <span class="invalid-feedback">
                    {{ $errors->first('email') }}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="password">Password Pengguna : </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text borad">
                      <span class="fa fa-lock"></span>
                    </span>
                  </div>
                  <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" placeholder="Masukan Password Pengguna..." autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('password') }}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password : </label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text borad">
                      <span class="fa fa-key"></span>
                    </span>
                  </div>
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" placeholder="Masukan Ulang Password..." autocomplete="off">
                  <span class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-success btn-block text-nowrap">
                <span class="fa fa-check"></span> &ensp; Simpan Perubahan
              </button>
            </div>
          </div>
        </form>
      </div> 
      <div class="card-footer">
      </div>
    </div>
  </div>
</div>
@endsection