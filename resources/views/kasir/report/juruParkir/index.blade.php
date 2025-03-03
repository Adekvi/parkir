@extends('admin.partisi.layout.home')
@section('judul', 'Kasir | Report Juru Parkir')
@section('konten')

<section class="content">
    <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form method="GET" action="{{ route('juru.parkir.index') }}">
                                    <div class="row">
                                        <!-- Filter Nama User -->
                                        <div class="col-md-3">
                                            <label for="id_user">Nama User</label>
                                            <select name="id_user" id="id_user" class="form-control">
                                                <option value="">-- Semua User --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ request('id_user') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->namaLengkap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                            
                                        <!-- Filter Lokasi Parkir -->
                                        <div class="col-md-3">
                                            <label for="id_lokasiParkir">Lokasi Parkir</label>
                                            <select name="id_lokasiParkir" id="id_lokasiParkir" class="form-control">
                                                <option value="">-- Semua Lokasi --</option>
                                                @foreach ($lokasiParkir as $lokasi)
                                                    <option value="{{ $lokasi->id }}" {{ request('id_lokasiParkir') == $lokasi->id ? 'selected' : '' }}>
                                                        {{ $lokasi->tmptParkir }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                            
                                        <!-- Button Filter -->
                                        <div class="col-md-3 d-flex align-items-end justify-content-end custom-margin">
                                            <button type="submit" class="btn btn-primary">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>                            
                            
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary" style="white-space: nowrap">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                {{-- <th>Nama Juru Parkir</th> --}}
                                                <th>Lokasi Parkir</th>
                                                <th>Shift</th>
                                                <th>Jumlah Kendaraan</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody style="white-space: nowrap">
                                            <?php 
                                            
                                            if (!function_exists('Rupiah')) {
                                                function Rupiah($angka)
                                                {
                                                    return "" . number_format($angka, 0, ',', '.');
                                                }
                                            }
                                            
                                            ?>

                                            @foreach ($juru as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y') }}</td>
                                                    <td>{{ $item->jam->tmptParkir }}</td>
                                                    <td>{{ $item->shift->namaShift }}</td>
                                                    <td>{{ $item->totalKendaraan }} Unit</td>
                                                    <td>
                                                        <span>Motor: Rp. {{ Rupiah($item->nilaiMotor) }}</span>
                                                        <span style="margin-left: 15px;">Mobil: Rp. {{ Rupiah($item->nilaiMobil) }}</span>
                                                    </td>
                                                    <td>Rp. {{ Rupiah($item->total_nominal) }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#info{{ $item->id }}">
                                                            <i class="fas fa-circle-info"></i> Detail
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

    </div><!-- /.container-fluid -->
</section>

@include('kasir.report.juruParkir.info')
    
@endsection

@push('css')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <style>
        .table-responsive {
            overflow-x: auto; /* Scroll horizontal ketika diperlukan */
            -webkit-overflow-scrolling: touch; /* Dukungan untuk smooth scrolling pada perangkat mobile */
        }

        .table {
            width: 100%; /* Membuat tabel memenuhi lebar kontainer */
            table-layout: auto; /* Agar tabel dapat menyesuaikan lebar kolom sesuai konten */
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

        .custom-margin {
            margin-left: -18%;
        }

    </style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": false, "lengthChange": true, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    // dapatkan lokasi secara otomatis
    document.addEventListener('DOMContentLoaded', function () {
        const userSelect = document.getElementById('id_user');
        const lokasiSelect = document.getElementById('id_lokasiParkir');

        userSelect.addEventListener('change', function () {
            const userId = this.value;

            // Hapus opsi lokasi parkir yang ada sebelumnya
            lokasiSelect.innerHTML = '<option value="">-- Semua Lokasi --</option>';

            if (userId) {
                // Lakukan AJAX request ke backend
                fetch(`/get-lokasi-juru?id_user=${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Tambahkan opsi baru berdasarkan data dari backend
                        data.forEach(lokasi => {
                            const option = document.createElement('option');
                            option.value = lokasi.id;
                            option.textContent = lokasi.tmptParkir;
                            lokasiSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching lokasi parkir:', error));
            }
        });
    });

</script>
@endpush