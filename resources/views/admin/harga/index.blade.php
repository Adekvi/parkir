@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Tarif Kendaraan')
@section('konten')

    {{-- <section class="content"> --}}
    <div class="page-inner">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="judul-menu">
                        <ul class="judul">
                            <li>
                                <h5 class="text-dark font-weight-bold mb-2">
                                    <strong>@yield('judul')</strong>
                                </h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <!-- Judul di kiri -->
                                <h3 class="card-title m-0">Pengaturan Tarif</h3>

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
                                    <table id="example1" class="table table-bordered table-striped"
                                        style="white-space: nowrap">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Jalan</th>
                                                <th>Lokasi Parkir</th>
                                                <th>Jenis Kendaraan</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampil">
                                            @foreach ($rego as $index => $item)
                                                <tr>
                                                    <td>{{ $rego->firstItem() + $index }}</td>
                                                    <td>{{ $item->lokasi->jalan->namaJalan ?? '-' }}</td>
                                                    <td>{{ $item->lokasi->tmptParkir ?? '-' }}</td>
                                                    <td>{{ $item->jenisKendaraan }}</td>
                                                    <td>{{ $item->harga }}</td>
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
                                {{ $rego->links() }}
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
    {{-- </section> --}}

    @include('admin.harga.tambah')
    @include('admin.harga.edit')
    @include('admin.harga.hapus')

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#cari').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('cari.harga') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        let tableBody = $('#tampil');
                        tableBody.empty(); // Hapus isi tabel sebelum mengisi ulang

                        if (response.length > 0) {
                            response.forEach(function(item, index) {
                                let modalEdit = `
                            <div class="modal fade" id="edit${item.id}" tabindex="-1" aria-labelledby="editLabel${item.id}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-white" id="editLabel${item.id}">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/admin/harga-edit/${item.id}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Tempat Parkir</label>
                                                    <input type="text" name="tmptParkir" class="form-control" value="${item.lokasi ? item.lokasi.tmptParkir : ''}">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga</label>
                                                    <input type="number" name="harga" class="form-control" value="${item.harga}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>`;

                                let modalHapus = `
                            <div class="modal fade" id="hapus${item.id}" tabindex="-1" aria-labelledby="hapusLabel${item.id}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-white" id="hapusLabel${item.id}">Hapus Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/admin/harga-hapus/${item.id}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>`;

                                let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.lokasi && item.lokasi.jalan ? item.lokasi.jalan.namaJalan : '-'}</td>
                                <td>${item.lokasi ? item.lokasi.tmptParkir : '-'}</td>
                                <td>${item.jenisKendaraan}</td>
                                <td>Rp. ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
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
                            </tr>`;

                                tableBody.append(row);
                                $(modalEdit).appendTo('body');
                                $(modalHapus).appendTo('body');
                            });
                        } else {
                            tableBody.append(
                                '<tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>'
                            );
                        }
                    },
                    error: function() {
                        alert("Terjadi kesalahan, coba lagi.");
                    }
                });
            });
        });
    </script>
@endpush
