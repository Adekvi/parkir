@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Daftar Akun')
@section('konten')

    <div class="content-fluid">

        <div class="judul-menu">
            <ul class="judul">
                <li>
                    <h3>@yield('judul')</h3>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <button type="button" data-toggle="modal" data-target="#kendaraan" class="btn float-left"
                            style="background: #0ddbb9">
                            <i class="fas fa-user-plus"></i>
                            Daftar Akun
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="table-primary" style="white-space: nowrap">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto Ktp</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Jenis Kelamin</th>
                                        <th>TTL</th>
                                        <th>Kode Jalan</th>
                                        <th>Lokasi Parkir</th>
                                        <th>Shift</th>
                                        <th>Role</th>
                                        <th title="">Status</th>
                                    </tr>
                                </thead>
                                <tbody style="white-space: nowrap">
                                    @foreach ($akun as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->fotoKtp) }}" class="card-img-top"
                                                    style="width: 100px; height: auto; cursor: pointer;" alt=""
                                                    onclick="openModal('{{ $item->id }}')">
                                            </td>
                                            <td>{{ $item->namaLengkap }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->password }}</td>
                                            <td>{{ $item->jekel ?? '-' }}</td>
                                            <td>{{ $item->tempatLahir ?? '-' }}, {{ $item->tglLahir ?? '-' }}</td>
                                            <td>{{ $item->namaLokasi ?? '-' }}</td>
                                            <td>{{ $item->jam->tmptParkir ?? '-' }}</td>
                                            <td>{{ $item->shift->namaShift ?? '-' }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>
                                                <form method="POST" action="{{ url('status-Akun') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input" name="status"
                                                            id="status_{{ $item->id }}" value="1"
                                                            onchange="this.form.submit()"
                                                            @if ($item->status) checked @endif>
                                                        <label class="button form-check-label"
                                                            for="status_{{ $item->id }}">
                                                            {{-- {{ $item->status ? 'Aktif' : 'Nonaktif' }} --}}
                                                        </label>
                                                    </div>
                                                </form>
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

    @foreach ($akun as $item)
        <div class="modal fade" id="fotoModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fotoModalLabel">Foto</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ Storage::url($item->fotoKtp) }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('admin.akun.daftar')

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

        .piket {
            display: flex;
            justify-content: center;
        }

        .button {
            width: 55px;
            height: 25px;
            background-color: #d2d2d2;
            border-radius: 200px;
            cursor: pointer;
            position: relative;
        }

        .button::before {
            position: absolute;
            content: "";
            width: 15px;
            height: 15px;
            background-color: #fff;
            border-radius: 200px;
            margin: 5px;
            transition: 0.2s;
        }

        input:checked+.button {
            background-color: blue;
        }

        input:checked+.button::before {
            transform: translateX(30px);
        }

        input {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        function openModal(itemId) {
            $('#fotoModal' + itemId).modal('show');
        }
    </script>
@endpush
