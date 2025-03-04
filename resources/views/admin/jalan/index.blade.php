@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Nama Jalan')
@section('konten')

    <div class="page-inner">

        <div class="row mb-3">
            <div class="container-fluid">
                <div class="judul-menu">
                    <ul class="judul">
                        <li>
                            <h5 class="text-dark font-weight-bold mb-2">
                                <strong>@yield('judul')</strong>
                            </h5>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Pengaturan Nama Jalan</h3>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#kendaraan"
                                    class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Jalan</th>
                                                <th>Nama Jalan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jalan as $index => $item)
                                                <tr>
                                                    <td>{{ $jalan->firstItem() + $index }}</td>
                                                    <td>{{ $item->kodeJln }}</td>
                                                    <td>{{ $item->namaJalan }}</td>
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
                                {{ $jalan->links() }}
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('admin.jalan.tambah')
    @include('admin.jalan.edit')
    @include('admin.jalan.hapus')

@endsection
