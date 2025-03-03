@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Pembayaran')
@section('konten')

<section class="content">
    <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h3 class="header-title">Laporan : {{ $startDate ?? '-' }} - {{ $endDate ?? '-' }}</h3>
                            </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{-- @if($noDataMessage)
                                        <div class="row justify-content-center">
                                            <div class="col-md-4">
                                                <div class="alert alert-warning" role="alert">
                                                    <i class="fa-solid fa-skull-crossbones"></i>
                                                   {{ $noDataMessage }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif 
                                    <form action="{{ route('admin.pembayaran') }}" method="GET" class="mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="start_date">Tanggal Mulai</label>
                                                <input type="date" name="start_date" value="{{ $startDate ?? '' }}" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="end_date">Tanggal Akhir</label>
                                                <input type="date" name="end_date" value="{{ $endDate ?? '' }}" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Tampilkan Laporan</button>
                                            </div>
                                        </div>
                                    </form> --}}
                                    
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Setor</th>
                                                <th>Petugas Parkir</th>
                                                {{-- <th>Nomor Polisi</th> --}}
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                // Fungsi untuk memformat harga ke dalam format Rupiah
                                                if (!function_exists('Rupiah')) {
                                                    function Rupiah($angka)
                                                    {
                                                        return "" . number_format($angka, 0, ',', '.');
                                                    }
                                                }    
                                            ?>
                                            @foreach ($rekap as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td> <!-- Nomor -->
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y / H:i') }}</td>
                                                    <td>{{ $item->user->namaLengkap }}</td> <!-- Daftar Nopol -->
                                                    <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td> <!-- Total Nominal -->
                                                    {{-- <td>{{  }}</td> --}}
                                                    <td>{{ $item->status ?? '' }}</td> <!-- Status -->
                                                    <td>
                                                        <button type="button" class="btn btn-primary rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#approve{{ $item->id }}">
                                                            <i class="fa-solid fa-thumbs-up"></i> Approve
                                                        </button>
                                                        <button type="button" class="btn btn-warning rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#info{{ $item->id }}">
                                                            <i class="fa-solid fa-circle-info"></i> Detail
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

@include('admin.bayar.approve')
@include('admin.bayar.info')
    
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
            "responsive": false,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

@endpush