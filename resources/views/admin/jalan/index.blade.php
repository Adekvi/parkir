@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Nama Jalan')
@section('konten')

    <div class="content-fluid">

        <div class="row mb-3">
            <div class="container-fluid">
                <div class="judul-menu">
                    <ul class="judul">
                        <li>
                            <h3 class="text-dark font-weight-bold mb-2">
                                <strong>@yield('judul')</strong>
                            </h3>
                        </li>
                    </ul>
                </div>
                <div class="row">
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
                                                <th>Kode Jalan</th>
                                                <th>Nama Jalan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jalan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
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

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table-responsive {
            overflow-x: auto;
            /* Scroll horizontal ketika diperlukan */
            -webkit-overflow-scrolling: touch;
            /* Dukungan untuk smooth scrolling pada perangkat mobile */
        }

        .table {
            width: 100%;
            /* Membuat tabel memenuhi lebar kontainer */
            table-layout: auto;
            /* Agar tabel dapat menyesuaikan lebar kolom sesuai konten */
        }

        @media (max-width: 576px) {
            .card-title {
                font-size: 1rem;
                text-align: center;
            }

            table th,
            table td {
                font-size: 0.875rem;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
