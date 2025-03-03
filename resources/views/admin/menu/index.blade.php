@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Menu')
@section('konten')

    <div class="content-wrapper">
        <div class="judul-menu">
            <ul class="judul">
                <li>
                    <h3 class="text-dark">
                        <strong>
                            @yield('judul')
                        </strong>
                    </h3>
                </li>
            </ul>
            <hr style="color: #ff9900; height: 2px; border: none; background-color: #ff9900;">
        </div>
        <div class="card">
            <div class="card-body">
                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <div class="row">
                            {{-- MASTER DATA --}}
                            <div class="col-lg-12">
                                <div class="judul-menu" id="masterDataTitle">
                                    <ul class="judul">
                                        <li>
                                            <h3 class="text-dark font-weight-bold mb-2">
                                                <i class="fa-solid fa-database" style="font-size: 25px"></i>
                                                <strong>Master Data</strong>
                                                <hr
                                                    style="color: #ff9900; height: 2px; border: none; background-color: #ff9900;">
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                                <div id="masterDataMenu" class="menu-items">
                                    <div class="row">
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/shift') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-clock big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Master Shift
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/jalan') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-location-dot big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Master Nama Jalan
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/lokasi') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-bell big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Master Lokasi dan Operasi
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/tarif') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-money-bill big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Master Tarif
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/ket') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-pen big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Master Keterangan
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/header') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-ticket big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Master Tampilan Karcis
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- DATA AKUN --}}
                            <div class="col-lg-12">
                                <div class="judul-menu" id="dataAkunTitle">
                                    <ul class="judul">
                                        <li>
                                            <h3 class="text-dark font-weight-bold mb-2">
                                                <i class="fa-solid fa-user-pen" style="font-size: 25px"></i>
                                                <strong>Data Akun</strong>
                                                <hr
                                                    style="color: #ff9900; height: 2px; border: none; background-color: #ff9900;">
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                                <div id="dataAkunMenu" class="menu-items">
                                    <div class="col-lg-2 text-center">
                                        <a href="{{ url('admin/akun') }}" class="btn btn-lg d-block p-3">
                                            <div class="card bg-white">
                                                <div class="card-body text-center">
                                                    <div class="mb-3">
                                                        <i class="fa-solid fa-user big-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-dark pb-2 mb-2 mt-2">
                                                Akun Pengguna
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- REPROT --}}
                            <div class="col-lg-12">
                                <div class="judul-menu" id="reportDataTitle">
                                    <ul class="judul">
                                        <li>
                                            <h3 class="text-dark font-weight-bold mb-2">
                                                <i class="fa-solid fa-clipboard" style="font-size: 25px"></i>
                                                <strong>Report Data</strong>
                                                <hr
                                                    style="color: #ff9900; height: 2px; border: none; background-color: #ff9900;">
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                                <div id="reportDataMenu" class="menu-items">
                                    <div class="row">
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/juru-parkir') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-square-parking big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Report Juru Parkir
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/kolek-report') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-user-pen big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Report Kolektor
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/dalan-report') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-road big-icon"></i>

                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Report By Jalan
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/report-dayt') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-calendar-day big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Report By Hari
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <a href="{{ url('admin/report-wulan') }}" class="btn btn-lg d-block p-3">
                                                <div class="card bg-white">
                                                    <div class="card-body text-center">
                                                        <div class="mb-3">
                                                            <i class="fa-solid fa-calendar-check big-icon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-dark pb-2 mb-2 mt-2">
                                                    Report By Bulan
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- PREDIKSI --}}
                            <div class="col-lg-12">
                                <div class="judul-menu" id="prediksiTitle">
                                    <ul class="judul">
                                        <li>
                                            <h3 class="text-dark font-weight-bold mb-2">
                                                <i class="fa-solid fa-calendar" style="font-size: 25px"></i>
                                                <strong>Prediksi</strong>
                                                <hr
                                                    style="color: #ff9900; height: 2px; border: none; background-color: #ff9900;">
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                                <div id="prediksiMenu" class="menu-items">
                                    <div class="col-lg-2 text-center">
                                        <a href="{{ url('admin/prediksi') }}" class="btn btn-lg d-block p-3">
                                            <div class="card bg-white">
                                                <div class="card-body text-center">
                                                    <div class="mb-3">
                                                        <i class="fa-solid fa-money-check-dollar big-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-dark pb-2 mb-2 mt-2">
                                                Pemasukan Bulanan
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif (Auth::user()->role == 'kasir')
                        <div class="row">
                            <div class="judul-menu">
                                <ul class="judul">
                                    <li>
                                        <h3 class="text-dark font-weight-bold mb-2">
                                            <i class="fa-solid fa-database" style="font-size: 25px"></i>
                                            <strong>Master Data</strong>
                                        </h3>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-2 text-center">
                                <a href="{{ url('admin/shift') }}" class="btn btn-lg d-block p-3">
                                    <div class="card bg-white">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-clock big-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dark pb-2 mb-2 mt-2">
                                        Master Shift
                                    </p>
                                </a>
                            </div>
                            <div class="col-lg-2 text-center">
                                <a href="{{ url('admin/jalan') }}" class="btn btn-lg d-block p-3">
                                    <div class="card bg-white">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-location-dot big-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dark pb-2 mb-2 mt-2">
                                        Master Nama Jalan
                                    </p>
                                </a>
                            </div>
                            <div class="col-lg-2 text-center">
                                <a href="{{ url('admin/lokasi') }}" class="btn btn-lg d-block p-3">
                                    <div class="card bg-white">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-bell big-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dark pb-2 mb-2 mt-2">
                                        Master Jam Operasional
                                    </p>
                                </a>
                            </div>
                            <div class="col-lg-2 text-center">
                                <a href="{{ url('admin/tarif') }}" class="btn btn-lg d-block p-3">
                                    <div class="card bg-white">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-money-bill big-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dark pb-2 mb-2 mt-2">
                                        Master Tarif
                                    </p>
                                </a>
                            </div>
                            <div class="col-lg-2 text-center">
                                <a href="{{ url('admin/ket') }}" class="btn btn-lg d-block p-3">
                                    <div class="card bg-white">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-pen big-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dark pb-2 mb-2 mt-2">
                                        Master Keterangan
                                    </p>
                                </a>
                            </div>
                            <div class="col-lg-2 text-center">
                                <a href="{{ url('admin/header') }}" class="btn btn-lg d-block p-3">
                                    <div class="card bg-white">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-ticket big-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-dark pb-2 mb-2 mt-2">
                                        Master Tampilan Karcis
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>
        /* Animasi untuk ikon */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .big-icon {
            font-size: 50px !important;
            color: #ff9900;
        }

        /* Menggunakan animasi pada ikon saat hover */
        .big-icon:hover {
            animation: pulse 1.5s infinite;
            /* Animasi dengan durasi 1.5 detik dan berulang saat hover */
        }

        .judul-menu {
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to toggle visibility of the menu items
            function toggleMenu(titleId, menuId) {
                const title = document.getElementById(titleId);
                const menu = document.getElementById(menuId);

                title.addEventListener('click', function() {
                    if (menu.style.display === "none" || menu.style.display === "") {
                        menu.style.display = "flex";
                    } else {
                        menu.style.display = "none";
                    }
                });
            }

            // Set up toggles for each section
            toggleMenu("masterDataTitle", "masterDataMenu");
            toggleMenu("dataAkunTitle", "dataAkunMenu");
            toggleMenu("reportDataTitle", "reportDataMenu");
            toggleMenu("prediksiTitle", "prediksiMenu");
        });
    </script>
@endpush
