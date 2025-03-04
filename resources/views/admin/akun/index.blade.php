@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Daftar Akun')
@section('konten')

    <div class="page-inner">

        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="judul-menu">
                        <ul class="judul">
                            <li>
                                <h5>@yield('judul')</h5>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <!-- Judul di kiri -->
                                <h3 class="card-title m-0">Pengaturan Keterangan</h3>

                                <!-- Tombol Tambah & Pencarian di kanan -->
                                <div class="d-flex align-items-center gap-3">
                                    <div class="tambah" style="white-space: nowrap">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#kendaraan"
                                            class="btn btn-primary">
                                            <i class="fas fa-user-plus"></i> Tambah Data
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="table-primary" style="white-space: nowrap">
                                        <tr>
                                            <th>No</th>
                                            {{-- <th>Foto Ktp</th> --}}
                                            <th>Nama Lengkap</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Jenis Kelamin</th>
                                            <th>TTL</th>
                                            <th>Nama Jalan</th>
                                            <th>Lokasi Parkir</th>
                                            <th>Shift</th>
                                            <th>Role</th>
                                            <th title="">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="white-space: nowrap">
                                        @foreach ($akun as $index => $item)
                                            <tr>
                                                <td>{{ $akun->firstItem() + $index }}</td>
                                                {{-- <td>
                                                    <img src="{{ Storage::url($item->fotoKtp) ?? '-' }}"
                                                        class="card-img-top"
                                                        style="width: 100px; height: auto; cursor: pointer;" alt="Foto KTP"
                                                        onclick="openModal('{{ $item->id }}')">
                                                </td> --}}
                                                <td>{{ $item->namaLengkap }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->password }}</td>
                                                <td>{{ $item->jekel ?? '-' }}</td>
                                                <td>{{ $item->tempatLahir ?? '-' }}, {{ $item->tglLahir ?? '-' }}</td>
                                                <td>{{ $item->jalan->namaJalan ?? '-' }}</td>
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
                            {{ $akun->links() }}
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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

@push('js')
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
