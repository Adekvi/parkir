@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Keterangan')
@section('konten')

    <div class="content-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="judul-menu">
                        <ul class="judul">
                            <li>
                                <h3>@yield('judul')</h3>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h3 class="card-title">Pengaturan</h3> --}}
                                <button type="button" data-bs-toggle="modal" data-bs-target="#kendaraan" class="btn"
                                    style="background: #0ddbb9">
                                    <i class="fas fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ket as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning rounded-pill btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $item->id }}">
                                                            <i class="fas fa-pen"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger rounded-pill btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapus{{ $item->id }}">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>

    @include('admin.ket.tambah')
    @include('admin.ket.edit')
    @include('admin.ket.hapus')

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
