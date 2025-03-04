@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Setting Tampilan Karcis')
@section('konten')

    <div class="page-inner">
        <div class="row">
            <!-- Bagian Header & Inputan (Kiri) -->
            <div class="container-fluid">
                <div class="judul-menu">
                    <ul class="judul">
                        <li>
                            <h5>@yield('judul')</h5>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <!-- Judul di kiri -->
                        <h3 class="card-title m-0">Pengaturan Header Karcis</h3>

                        <!-- Tombol Tambah & Pencarian di kanan -->
                        <div class="d-flex align-items-center gap-3">
                            <div class="tambah" style="white-space: nowrap">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#kendaraan"
                                    class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </button>
                            </div>
                            {{-- <div class="input-group">
                                <input type="text" class="form-control" id="cari" placeholder="Cari...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-responsive table-bordered table-striped"
                                style="white-space: nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Header 1</th>
                                        <th>Header 2</th>
                                        <th>Header 3</th>
                                        <th>Header 4</th>
                                        <th>Footer 1</th>
                                        <th>Footer 2</th>
                                        <th>Footer 3</th>
                                        <th>Footer 4</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karcis as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->header1 }}</td>
                                            <td>{{ $item->header2 }}</td>
                                            <td>{{ $item->header3 }}</td>
                                            <td>{{ $item->header4 }}</td>
                                            <td>{{ $item->footer1 }}</td>
                                            <td>{{ $item->footer2 }}</td>
                                            <td>{{ $item->footer3 }}</td>
                                            <td>{{ $item->footer4 }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning rounded-pill btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}">
                                                    <i class="fas fa-pen"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger rounded-pill btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tampilan Karcis (Kanan) -->
            <div class="card ml-3">
                <div class="card-body">
                    <h3 class="text-start">Contoh Tampilan Karcis</h3>
                    <div class="karcis">
                        <header>
                            @if ($karcis->isNotEmpty())
                                @foreach ($karcis as $item)
                                    <h1>{{ $item->header1 ?? 'Setoran Parkir Harian' }}</h1>
                                    <h2>{{ $item->header2 ?? 'Retribusi Parkir Kendaraan' }}</h2>
                                    <h3>{{ $item->header3 ?? 'Kemitraan Dinas Perhubungan' }}</h3>
                                    <h4>{{ $item->header4 ?? 'Kota Samarinda' }}</h4>
                                @endforeach
                            @else
                                <h1>Setoran Parkir Harian</h1>
                                <h2>Retribusi Parkir Kendaraan</h2>
                                <h3>Kemitraan Dinas Perhubungan</h3>
                                <h4>Kota Samarinda</h4>
                            @endif
                            <p class="tanggal-jam"><span id="tanggal-jam"></span></p>
                        </header>
                        <section class="area-info">
                            <p><strong>Area:</strong></p>
                            <p><strong>Lokasi:</strong></p>
                            <p><strong>Shift:</strong></p>
                        </section>
                        <table class="tabel-kendaraan">
                            <thead>
                                <tr>
                                    <th>Kendaraan</th>
                                    <th>Unit</th>
                                    <th>Rp.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sepeda Motor (R2)</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Mobil (R4)</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="total-uang">
                            <strong>Total Uang:</strong>
                        </div>
                        <footer>
                            <p><strong>Ket:</strong></p>
                            <div class="petugas">
                                @if ($karcis->isNotEmpty())
                                    @foreach ($karcis as $item)
                                        <div>
                                            <p>{{ $item->footer1 ?? 'Petugas' }}</p>
                                            <p>{{ $item->footer2 ?? 'Nama' }}</p>
                                        </div>
                                        <div>
                                            <p>{{ $item->footer3 ?? 'Kolektor' }}</p>
                                            <p>{{ $item->footer4 ?? 'Nama' }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div>
                                        <p>Petugas</p>
                                        <p>Nama</p>
                                    </div>
                                    <div>
                                        <p>Kolektor</p>
                                        <p>Nama</p>
                                    </div>
                                @endif
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('admin.header.karcis') --}}
    @include('admin.header.tambah')
    @include('admin.header.edit')
    @include('admin.header.hapus')

@endsection

@push('css')
    <style>
        .karcis {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            font-family: 'OCR-B', 'Courier', monospace;
            width: 450px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1,
        header h2,
        header h3,
        header h4 {
            font-size: 20px;
            margin: 0;
        }

        .tanggal-jam {
            font-size: 0.9rem;
            color: #555;
        }

        .area-info {
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .tabel-kendaraan {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .tabel-kendaraan th,
        .tabel-kendaraan td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 5px;
        }

        .tabel-kendaraan th {
            background-color: #f2f2f2;
        }

        .total-uang {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: right;
        }

        footer {
            font-size: 0.9rem;
        }

        .petugas {
            display: flex;
            justify-content: space-between;
        }

        .petugas div {
            text-align: center;
        }
    </style>
@endpush

@push('js')
    <script>
        // Fungsi untuk format tanggal dan waktu dalam format Indonesia
        function formatTanggalJam() {
            const now = new Date();

            // Nama hari dan bulan dalam bahasa Indonesia
            const hari = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long'
            }).format(now);
            const tanggal = now.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            });

            // Hanya jam dan menit
            const jam = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
            });

            // Gabungkan hasil
            return `${hari}, ${tanggal} ${jam}`;
        }

        // Set isi elemen HTML
        document.getElementById('tanggal-jam').textContent = formatTanggalJam();

        // Perbarui waktu setiap detik
        setInterval(() => {
            document.getElementById('tanggal-jam').textContent = formatTanggalJam();
        }, 6000);
    </script>
@endpush
