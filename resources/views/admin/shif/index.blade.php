@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Master Shift')
@section('konten')

    <div class="page-inner">
        <div class="row">
            <div class="judul">
                <ul>
                    <li>
                        <h5> @yield('judul')</h5>
                    </li>
                </ul>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Judul di kiri -->
                        <h3 class="card-title m-0">Pengaturan Shift</h3>

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
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Shift</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shift as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->namaShift }}</td>
                                        <td>{{ $item->mulai }}</td>
                                        <td>{{ $item->akhir }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning rounded-pill btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                <i class="fas fa-pen"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-danger rounded-pill btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
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
        </div>
    </div>
    </div>

    @include('admin.shif.tambah')
    @include('admin.shif.edit')
    @include('admin.shif.hapus')

@endsection
