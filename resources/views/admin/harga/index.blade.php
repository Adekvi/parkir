@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Tarif Kendaraan')
@section('konten')

    {{-- <section class="content"> --}}
    <div class="content-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="judul-menu">
                        <ul class="judul">
                            <li>
                                <h3 class="text-dark font-weight-bold mb-2">
                                    <strong>@yield('judul')</strong>
                                </h3>
                            </li>
                        </ul>
                    </div>
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
                                                <th>Lokasi Parkir</th>
                                                <th>Jenis Kendaraan</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rego as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
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
                                    {{ $rego->links() }}
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
    {{-- </section> --}}

    @include('admin.harga.tambah')
    @include('admin.harga.edit')
    @include('admin.harga.hapus')

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
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
