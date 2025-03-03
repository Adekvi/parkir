@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Report Juru Parkir')
@section('konten')

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
                    <form method="GET" action="{{ route('admin.parkir.index') }}">
                        <div class="row">
                            <!-- Filter Nama User -->
                            <div class="col-md-3">
                                <label for="id_user">Nama User</label>
                                <select name="id_user" id="id_user" class="form-control">
                                    <option value="">-- Semua User --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ request('id_user') == $user->id ? 'selected' : '' }}>
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
                                        <option value="{{ $lokasi->id }}"
                                            {{ request('id_lokasiParkir') == $lokasi->id ? 'selected' : '' }}>
                                            {{ $lokasi->tmptParkir }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Button Filter -->
                            <div class="col-md-1 d-flex align-items-end justify-content-end custom-margin">
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
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody style="white-space: nowrap">
                                <?php
                                
                                if (!function_exists('Rupiah')) {
                                    function Rupiah($angka)
                                    {
                                        return '' . number_format($angka, 0, ',', '.');
                                    }
                                }
                                
                                ?>

                                @foreach ($juru as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y') }}
                                        </td>
                                        <td>{{ $item->jam->tmptParkir ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $item->shift->namaShift ?? '-' }}</td>
                                        <td>{{ $item->totalKendaraan }} Unit</td>
                                        <td>
                                            <span>Motor: Rp. {{ Rupiah($item->motor) }}</span>
                                            <span style="margin-left: 15px;">Mobil: Rp.
                                                {{ Rupiah($item->mobil) }}</span>
                                        </td>
                                        <td>Rp. {{ Rupiah($item->total_nominal) }}</td>
                                        {{-- <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#info{{ $item->id }}">
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

    @include('admin.report.juru.detail')

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        // dapatkan lokasi secara otomatis
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('id_user');
            const lokasiSelect = document.getElementById('id_lokasiParkir');

            userSelect.addEventListener('change', function() {
                const userId = this.value;

                // Hapus opsi lokasi parkir yang ada sebelumnya
                lokasiSelect.innerHTML = '<option value="">-- Semua Lokasi --</option>';

                if (userId) {
                    // Lakukan AJAX request ke backend
                    fetch(`/get-lokasi?id_user=${userId}`)
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
