@extends('admin.partisi.layout.home')
@section('judul', 'Kasir | Report Bulanan')
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
                                <form action="{{ route('kasir.report-bulanan') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="Bulan">Bulan</label>
                                            <input type="month" name="bulan" id="bulan" class="form-control" value="{{ request('bulan') }}">
                                        </div>
                            
                                        <div class="col-md-3 d-flex align-items-end justify-content-end">
                                            <button type="submit" class="btn btn-primary custom-margin">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary" style="white-space: nowrap">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kendaraan</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody style="white-space: nowrap">
                                            <?php 
                                                // Fungsi untuk memformat harga ke dalam format Rupiah
                                                if (!function_exists('Rupiah')) {
                                                    function Rupiah($angka)
                                                    {
                                                        return "" . number_format($angka, 0, ',', '.');
                                                    }
                                                }
                                            ?>
                                            @foreach ($terima as $index => $kolektor)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $kolektor['created_at']->first() }}
                                                    </td>                                
                                                    <td>{{ $kolektor['totalKendaraan'] }}</td>
                                                    <td>
                                                        Motor : {{ Rupiah($kolektor['nilaiMotor']) }}
                                                        <span style="margin-right: 15px">Mobil :
                                                        {{ Rupiah($kolektor['nilaiMobil']) }}</span>
                                                    </td>
                                                    <td>{{ Rupiah($kolektor['total']) }}</td>
                                                    {{-- <td>
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#info{{ $kolektor['id'] }}">
                                                            <i class="fas fa-circle-info"></i> Detail
                                                        </button>
                                                    </td> --}}
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

@include('kasir.report.bulanan.info')
    
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
            margin-left: -58%;
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
</script>
@endpush