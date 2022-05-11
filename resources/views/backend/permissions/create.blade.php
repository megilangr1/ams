@extends('backend.layouts.master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title text-lg"> <span class="fa fa-lock"></span> &ensp; Buat Data Izin Akses Baru</h3>
        <div class="card-tools">
          <a href="{{ route('permissions.index') }}" class="btn btn-danger btn-sm">
            <span class="fa fa-arrow-left"></span> &ensp; 
            Kembali 
          </a>
        </div>
      </div> 
      <div class="card-body"> 
        <form action="{{ route('permissions.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-9">
              <div class="form-group">
                <label for="name">Nama Hak Izin Akses : </label>
                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" value="{{ old('name') }}" placeholder="Masukan Nama Hak Izin Akses..." autocomplete="off" autofocus required>
                <span class="invalid-feedback">
                  {{ $errors->first('name') }}
                </span>
              </div>
            </div>
            <div class="col-md-3">
              <label for="">&ensp;</label>
              <button type="submit" class="btn btn-success btn-block text-nowrap">
                <span class="fa fa-check"></span> &ensp; Buat Data Hak Izin Akses
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