@extends('admin.partisi.layout.home')
@section('judul', 'Dashboard Admin')
@section('konten')

    <div class="content-fluid">

        <div class="judul-menu">
            <ul class="judul">
                <li>
                    <h3 class="text-dark font-weight-bold mb-2">
                        <strong>@yield('judul')</strong>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-2 text-center">
                <div class="small-box bg-primary text-light"
                    style="border-radius: 15px; padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div class="inner" style="text-align: left;">
                        <h3>{{ $userCount }}</h3>
                    </div>
                    <div class="icon" style="font-size: 2rem;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <p class="text-dark pb-2 mb-2 mt-2">
                    Juru Parkir
                </p>
            </div>
            <div class="col-lg-2 text-center">
                <div class="small-box bg-success text-light"
                    style="border-radius: 15px; padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div class="inner" style="text-align: left;">
                        <h3>{{ $kolektorCount }}</h3>
                    </div>
                    <div class="icon" style="font-size: 2rem;">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                </div>
                <p class="text-dark pb-2 mb-2 mt-2">
                    Kolektor
                </p>
            </div>
            <div class="col-lg-2 text-center">
                <div class="small-box bg-info text-light"
                    style="border-radius: 15px; padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div class="inner" style="text-align: left;">
                        <h3>{{ $jalanCount }}</h3>
                    </div>
                    <div class="icon" style="font-size: 2rem;">
                        <i class="fa-solid fa-road-circle-check"></i>
                    </div>
                </div>
                <p class="text-dark pb-2 mb-2 mt-2">
                    Jalan
                </p>
            </div>
            <div class="col-lg-2 text-center">
                <div class="small-box bg-warning text-light"
                    style="border-radius: 15px; padding: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div class="inner" style="text-align: left;">
                        <h3>{{ $lokasiParkirCount }}</h3>
                    </div>
                    <div class="icon" style="font-size: 2rem;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                </div>
                <p class="text-dark pb-2 mb-2 mt-2">
                    Lokasi Parkir
                </p>
            </div>
        </div>

        <div class="diagram">
            <ul class="diagram">
                <li>
                    <h4>Diagram</h4>
                </li>
            </ul>
            <div class="col-sm-8 grid-margin d-flex stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-2">Data Statistik</h4>
                        </div>
                        <canvas id="lineChart" width="1338" height="668"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil data dari controller
        const kolektorCount = {{ $kolektorCount }};
        const userCount = {{ $userCount }};
        const jalanCount = {{ $jalanCount }};
        const lokasiParkirCount = {{ $lokasiParkirCount }};

        // Membuat diagram garis
        const ctx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line', // Jenis grafik garis
            data: {
                labels: ['Kolektor', 'User', 'Jalan', 'Lokasi Parkir'], // Label untuk sumbu X
                datasets: [{
                    label: 'Jumlah',
                    data: [kolektorCount, userCount, jalanCount, lokasiParkirCount], // Data untuk sumbu Y
                    borderColor: '#464dee', // Warna garis
                    backgroundColor: 'rgba(70, 77, 238, 0.1)', // Warna latar belakang titik
                    fill: true, // Mengisi area di bawah garis
                    tension: 0.4 // Kelenturan garis
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true // Memulai sumbu Y dari nol
                    }
                }
            }
        });
    </script>
@endpush
