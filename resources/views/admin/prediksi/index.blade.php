@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Pemasukkan Bulanan')
@section('konten')

    <div class="content-fluid">

        <!-- Small boxes (Stat box) -->
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
                            <div class="card-header text-center">
                                <div class="d-flex justify-content-between w-100">
                                    <!-- Tombol Tambah Data -->
                                    <div class="tambah">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#kendaraan"
                                            class="btn text-white" style="background: #0ddbb9; margin-right: 10px;">
                                            <i class="fas fa-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>

                                    <!-- Tombol Cari -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cari"
                                                placeholder="Cari. . . . ">
                                            <button type="submit" class="btn" style="background: #0ddbb9">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered">
                                        <thead class="table-success">
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Jalan</th>
                                                <th>Lokasi Parkir</th>
                                                <th>Jam Parkir</th>
                                                <th>Tipe Parkir</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampil">

                                        </tbody>
                                    </table>
                                    {{-- {{ $jam->links('pagination::bootstrap-5') }} --}}
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

    </div><!-- /.container-fluid -->

    {{-- @include('admin.lokasi.tambah')
    @include('admin.lokasi.edit')
    @include('admin.lokasi.hapus') --}}

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Menambahkan CDN untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // CARI
        $(document).ready(function() {
            // Ketika ada perubahan pada input cari
            $('#cari').on('keyup', function() {
                var query = $(this).val(); // Ambil nilai input

                // Lakukan request AJAX ke controller
                $.ajax({
                    url: "{{ route('admin.lokasi.cari') }}", // Rute pencarian
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        // Bersihkan hasil sebelumnya
                        $('#tampil').html('');

                        // Jika ada hasil pencarian
                        if (data.length > 0) {
                            data.forEach(function(item, index) {
                                // Menampilkan hasil pencarian ke dalam tabel
                                $('#tampil').append(
                                    `<tr>
                                <td>${index + 1}</td>
                                <td>${item.kodeJln}</td>
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
                            // Jika tidak ada hasil ditemukan
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
