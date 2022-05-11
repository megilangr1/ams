@extends('backend.layouts.master')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title text-lg"> <span class="fa fa-lock"></span> &ensp; Data Akun Pengguna {{ isset($_GET['trashed']) ? 'Non-Aktif' : '' }}</h3>

        <div class="card-tools">
          @if (isset($_GET['trashed']))
          <a href="{{ route('users.index') }}" class="btn btn-success btn-sm">
            <span class="fa fa-circle"></span> &ensp;
            Data Aktif
          </a>              
          @else
          <a href="{{ route('users.index', ['trashed' => 'true']) }}" class="btn btn-danger btn-sm">
            <span class="fa fa-trash"></span> &ensp;
            Data Non-Aktif
          </a>
          @endif
          <a href="{{ route('users.create') }}" class="btn btn-info btn-sm">
            <span class="fa fa-plus"></span> &ensp; 
            Tambah Data
          </a>
        </div>
      </div> 
      <div class="card-body table-responsive p-0">
        <table class="table table-head-fixed table-bordered text-nowrap">
          <thead>
            <tr>
              <th class="text-center" width="5%">No.</th>
              <th>Nama Hak Akses</th>
              <th>Pembuat Data</th>
              <th>Tanggal Buat</th>
              <th class="text-center" width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $item)
              <tr>
                <td class="align-middle text-center">{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}.</td>
                <td class="align-middle">{{ $item->name }}</td>
                <td class="align-middle">{{ $item->created_by }}</td>
                <td class="align-middle">{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                <td class="align-middle text-center">
                  <div class="btn-group">
                    @if (isset($_GET['trashed']))
                      <form action="{{ route('users.restore', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm borad m1">
                          <span class="fa fa-undo"></span> Pulihkan
                        </button>
                      </form>
                    @else
                      <a href="{{ route('users.edit', $item->id) }}" class="btn btn-info btn-sm borad m1">
                        <span class="fa fa-edit"></span>
                      </a>
                      <form action="{{ route('users.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm borad m1">
                          <span class="fa fa-trash"></span>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr> 
            @empty
              <tr>
                <td colspan="5">
                  Belum Ada Data.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div> 
      <div class="card-footer">
        {{ $users->appends($_GET)->links() }}
      </div>
    </div>
  </div>
</div>
@endsection