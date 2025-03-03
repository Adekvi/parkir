@extends('admin.partisi.layout.home')
@section('judul', 'Collector | Data Disetor')
@section('konten')

<section class="content">
    <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Setor</th>
                                                <th>Nomor Polisi</th>
                                                {{-- <th>Jumlah Motor</th>
                                                <th>Nilai Motor</th>
                                                <th>Jumlah Mobil</th>
                                                <th>Nilai Mobil</th> --}}
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
                                            @foreach ($bayar as $item)
                                                @if ($item->status == 'Sudah disetor')
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->format('d-m-Y / H:i') }}</td>
                                                        <td>{{ $item->nopol_list }}</td>
                                                        {{-- <td>{{ $item->jumlahMotor }}</td>
                                                        <td>{{ Rupiah ($item->nilaiMotor) }}</td>
                                                        <td>{{ $item->jumlahMobil }}</td>
                                                        <td>{{ Rupiah($item->nilaiMobil) }}</td> --}}
                                                        <td>Rp. {{ Rupiah($item->total_nominal) }}</td>
                                                        <td>{{ $item->status }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#info{{ $item->id }}">
                                                                <i class="fas fa-circle-info"></i>
                                                            </button>
                                                        </td>
                                                    </tr>                
                                                @endif
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

{{-- Modal Info --}}
@foreach ($bayar as $item)
    <div class="modal fade text-left" id="info{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Informasi</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <div class="table-responsive">
                            <div class="header">
                                <h5>
                                    <strong>Lokasi Parkir : </strong>
                                    {{ $item->jam->tmptParkir }}
                                </h5>
                            </div>
                            <table class="table table-bordered" style="width: 100%; overflow-y: auto">
                                <thead class="table-primary text-center" style="white-space: nowrap">
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari, Tanggal dan Jam</th>
                                        <th>Nama Petugas</th>
                                        <th>Plat Nomor</th>
                                        <th>Jumlah Motor</th>
                                        <th>Tarif Motor</th>
                                        <th>Jumlah Mobil</th>
                                        <th>Tarif Mobil</th>
                                        <th>Total</th>
                                        <th>Setor</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" style="white-space: nowrap">
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->shift)
                                                {{ \Carbon\Carbon::parse($item->shift->created_at)->timezone('Asia/Jakarta')->translatedFormat('l, d F Y / H:i:s') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $item->user->namaLengkap ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $item->nopol_list }}</td>
                                        <td>{{ $item->jumlahMotor }}</td>
                                        <td>{{ Rupiah($item->nilaiMotor) }}</td>
                                        <td>{{ $item->jumlahMobil }}</td>
                                        <td>{{ Rupiah($item->nilaiMobil) }}</td>
                                        <td>{{ Rupiah($item->total_nominal) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fas fa-check-circle"></i> 
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
    
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
        "responsive": false, "lengthChange": true, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush