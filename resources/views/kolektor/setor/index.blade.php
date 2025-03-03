@extends('admin.partisi.layout.home')
@section('judul', 'Collector | Data Masuk')
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
                                <h4 class="card-title"></h4>
                                <button type="button" data-toggle="modal" data-target="#kendaraan" class="btn btn-primary float-right">
                                    <i class="fas fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <header class="text-start mb-2">
                                    <h4>Data Petugas belum setor</h4>
                                </header>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Setor</th>
                                                <th>Jam Setor</th>
                                                <th>Nomor Polisi</th>
                                                <th>Nominal</th>
                                                <th>Status</th>
                                                {{-- <th>Aksi</th> --}}
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
                                            @foreach ($bayar as $item)
                                                @if ($item->status == 'Belum disetor')
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td> <!-- Nomor -->
                                                        <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->format('H:i') }}</td> <!-- Jam -->
                                                        <td>{{ $item->nopol }}</td> <!-- Daftar Nopol -->
                                                        <td>Rp. {{ Rupiah($item->penerimaan) }}</td> <!-- Total Nominal -->
                                                        <td colspan="2">{{ $item->status }}</td> <!-- Status -->
                                                    </tr>                        
                                                @endif
                                            @endforeach
                                        </tbody>
                                        
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <strong>
                                                        Keterangan
                                                    </strong>
                                                </td>
                                                <td colspan="2">
                                                    @foreach ($setor as $item)
                                                        @if ($item->status == 'Belum disetor')
                                                            <div class="list">
                                                                <ul>
                                                                    <li>
                                                                        {{ $item->nopol_list }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td colspan="2" class="text-center">
                                                    <!-- Dapatkan total nominal untuk semua data -->
                                                    <strong>
                                                        Total : Rp. {{ Rupiah($setor->sum('total_nominal')) }}
                                                    </strong>
                                                </td>
                                                @if ($setor->count() > 0)
                                                    <td>
                                                        <button type="button" class="btn btn-warning rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#bayar">
                                                            <i class="fas fa-pencil-alt"></i> Setor
                                                        </button>
                                                    </td>
                                                @else
                                                    '-'
                                                @endif
                                            </tr>
                                        </tfoot>
                                        
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

@include('kolektor.setor.tambah')
{{-- @include('kolektor.bayar.edit')
@include('kolektor.bayar.hapus') --}}
    
@endsection

@push('css')

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
        "responsive": false, "lengthChange": true, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush