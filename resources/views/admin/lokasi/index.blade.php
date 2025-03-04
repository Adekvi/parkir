@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Jam & Tempat')
@section('konten')

    <div class="page-inner">

        <!-- Small boxes (Stat box) -->
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
                                <!-- Judul di kiri -->
                                <h3 class="card-title m-0">Pengaturan Lokasi</h3>

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
                                    <table id="example1" class="table table-bordered" style="white-space: nowrap">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Jalan</th>
                                                <th>Lokasi Parkir</th>
                                                <th>Jam Parkir</th>
                                                <th>Tipe Parkir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampil">
                                            @foreach ($jam as $index => $item)
                                                <tr>
                                                    <td>{{ $jam->firstItem() + $index }}</td>
                                                    <td>{{ $item->jalan->namaJalan ?? '' }}</td>
                                                    <td>{{ $item->tmptParkir }}</td>
                                                    <td>{{ $item->durasiParkir ?? '-' }} Jam</td>
                                                    <td>{{ $item->tipe ?? '-' }}</td>
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
                                {{ $jam->links() }}
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

    @include('admin.lokasi.tambah')
    @include('admin.lokasi.edit')
    @include('admin.lokasi.hapus')

@endsection

@push('js')
    <!-- Menambahkan CDN untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // CARI
        $(document).ready(function() {
            $('#cari').on('keyup', function() {
                var query = $(this).val();

                $.ajax({
                    url: "{{ route('admin.lokasi.cari') }}",
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#tampil').html('');

                        if (data.length > 0) {
                            data.forEach(function(item, index) {
                                $('#tampil').append(
                                    `<tr>
                                <td>${index + 1}</td>
                                <td>${item.jalan ? item.jalan.namaJalan : 'Tidak Diketahui'}</td>
                                <td>${item.tmptParkir}</td>
                                <td>${item.durasiParkir} Jam</td>
                                <td>${item.tipe}</td>
                                <td>
                                    <button type="button" class="btn btn-warning rounded-pill btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#edit${item.id}">
                                        <i class="fas fa-pen"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-danger rounded-pill btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#hapus${item.id}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>`
                                );
                            });
                        } else {
                            $('#tampil').append(
                                '<tr><td colspan="6" class="text-center">Tidak ada hasil ditemukan.</td></tr>'
                            );
                        }
                    }
                });
            });
        });

        // JAM
        fetch('/admin/lokasi', {
                method: 'GET', // Karena Anda menggunakan GET untuk mengambil data
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success') {
                    console.log('Data Jam Lokasi:', data.jam);

                    // Redirect jika URL redirect tersedia
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    }
                } else {
                    console.error('Error:', data.message || 'Terjadi kesalahan');
                }
            })
            .catch((error) => console.error('Fetch error:', error));
    </script>
@endpush
