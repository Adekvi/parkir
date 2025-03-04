@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Keterangan')
@section('konten')

    <div class="page-inner">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="judul-menu">
                        <ul class="judul">
                            <li>
                                <h5>@yield('judul')</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <!-- Judul di kiri -->
                                <h3 class="card-title m-0">Pengaturan Keterangan</h3>

                                <!-- Tombol Tambah & Pencarian di kanan -->
                                <div class="d-flex align-items-center gap-3">
                                    <div class="tambah" style="white-space: nowrap">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#kendaraan"
                                            class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah Data
                                        </button>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cari" placeholder="Cari...">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
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
                                            @foreach ($ket as $index => $item)
                                                <tr>
                                                    <td>{{ $ket->firstItem() + $index }}</td>
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
                                    {{ $ket->links() }}
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
