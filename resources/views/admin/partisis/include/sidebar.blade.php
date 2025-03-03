<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('user/img/akun.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('user/update/form') }}"
                    class="d-block {{ Request::is('user/update/form') ? 'active' : '' }}">
                    <strong>
                        {{ Auth::user()->namaLengkap }}
                    </strong>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

                @if (Auth::check())
                    @if (Auth::user()->role == 'kolektor')
                        <li class="nav-item menu-open">
                            <a href="{{ url('kolektor/index') }}" class="nav-link active">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Dashboard
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">COLLECTOR</li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ url('kolektor/setor') }}"
                                class="nav-link {{ Request::is('kolektor/setor') ? 'active' : '' }}">
                                <i class="fa-solid fa-cloud-arrow-up nav-icon"></i>
                                <p>Data masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/kolektor/disetor') }}"
                                class="nav-link {{ Request::is('kolektor/disetor') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-check nav-icon"></i>
                                <p>Data telah ditarik</p>
                            </a>
                        </li>
                        </li>
                        {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Charts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/charts/chartjs.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ChartJS</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/flot.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Flot</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    @elseif (Auth::user()->role == 'kasir')
                        <li class="nav-item menu-open">
                            <a href="{{ url('kasir/index') }}" class="nav-link active">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Dashboard
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">DATA</li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ url('kasir/dataSetoran') }}"
                                class="nav-link {{ Request::is('kasir/dataSetoran') ? 'active' : '' }}">
                                <i class="fa-solid fa-cloud-arrow-up nav-icon"></i>
                                <p>Data Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kasir/inap') }}"
                                class="nav-link {{ Request::is('kasir/inap') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-check nav-icon"></i>
                                <p>Data Tagihan Bulanan</p>
                            </a>
                        </li>
                        </li>
                        <li class="nav-header">REPORT</li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ url('kasir/juru-parkir') }}"
                                class="nav-link {{ Request::is('kasir/juru-parkir') ? 'active' : '' }}">
                                <i class="fa-solid fa-square-parking nav-icon"></i>
                                <p>Per Juru Parkir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kasir/report-kolektor') }}"
                                class="nav-link {{ Request::is('kasir/report-kolektor') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-pen nav-icon"></i>
                                <p>Per Kolektor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kasir/report-jalan') }}"
                                class="nav-link {{ Request::is('kasir/report-jalan') ? 'active' : '' }}">
                                <i class="fa-solid fa-road nav-icon"></i>
                                <p>Per Jalan (Wilayah)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kasir/report-hari') }}"
                                class="nav-link {{ Request::is('kasir/report-hari') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-day nav-icon"></i>
                                <p>Per Hari</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kasir/report-bulanan') }}"
                                class="nav-link {{ Request::is('kasir/report-bulanan') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-check nav-icon"></i>
                                <p>Per Bulan</p>
                            </a>
                        </li>
                        </li>
                    @elseif (Auth::user()->role == 'admin')
                        <li class="nav-item menu-open">
                            <a href="{{ url('admin/index') }}" class="nav-link active">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Dashboard
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MASTER</li>
                        <li class="nav-item">
                            <a href="{{ url('admin/shift') }}"
                                class="nav-link {{ Request::is('admin/shift') ? 'active' : '' }}">
                                <i class="fa-solid fa-clock nav-icon"></i>
                                <p>Setting Shift</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/jalan') }}"
                                class="nav-link {{ Request::is('admin/jalan') ? 'active' : '' }}">
                                <i class="fa-solid fa-location-dot nav-icon"></i>
                                <p>Setting Nama Jalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/lokasi') }}"
                                class="nav-link {{ Request::is('admin/lokasi') ? 'active' : '' }}">
                                <i class="fa-solid fa-bell nav-icon"></i>
                                <p>Setting Jam Operasional</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/harga') }}"
                                class="nav-link {{ Request::is('admin/harga') ? 'active' : '' }}">
                                <i class="fa-solid fa-money-bill nav-icon"></i>
                                <p>Setting Tarif</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/ket') }}"
                                class="nav-link {{ Request::is('admin/ket') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-info nav-icon"></i>
                                <p>Setting Keterangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/header') }}"
                                class="nav-link {{ Request::is('admin/header') ? 'active' : '' }}">
                                <i class="fa-solid fa-ticket nav-icon"></i>
                                <p>Setting Tampilan Karcis</p>
                            </a>
                        </li>
                        <li class="nav-header">DATA AKUN</li>
                        {{-- <li class="nav-item">
                        <a href="{{ url('daftar/akun') }}" class="nav-link {{ Request::is('tambah/akun') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-plus nav-icon"></i>
                            <p>Tambah Akun</p>
                        </a>
                    </li> --}}
                        <li class="nav-item">
                            <a href="{{ url('admin/akun') }}"
                                class="nav-link {{ Request::is('admin/akun') ? 'active' : '' }}">
                                <i class="fa-regular fa-user nav-icon"></i>
                                <p>Daftar Akun</p>
                            </a>
                        </li>
                        <li class="nav-header">REPORT</li>
                        <li class="nav-item">
                            <a href="{{ url('admin/juru-parkir') }}"
                                class="nav-link {{ Request::is('admin/juru-parkir') ? 'active' : '' }}">
                                <i class="fa-solid fa-square-parking nav-icon"></i>
                                <p>
                                    Report Juru Parkir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/kolek-report') }}"
                                class="nav-link {{ Request::is('admin/kolek-report') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-pen nav-icon"></i>
                                <p>
                                    Report Kolektor
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/dalan-report') }}"
                                class="nav-link {{ Request::is('admin/dalan-report') ? 'active' : '' }}">
                                <i class="fa-solid fa-road nav-icon"></i>
                                <p>
                                    Report By Jalan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/report-day') }}"
                                class="nav-link {{ Request::is('admin/report-day') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-day nav-icon"></i>
                                <p>Report By Hari</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/report-wulan') }}"
                                class="nav-link {{ Request::is('admin/report-wulan') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-check nav-icon"></i>
                                <p>Report By Bulan</p>
                            </a>
                        </li>
                        {{-- <li class="nav-header">LAPORAN</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/pembayaran') }}" class="nav-link {{ Request::is('admin/pembayaran') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pen-to-square"></i>
                            <p>
                                Kolketor Setor
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/kirim') }}" class="nav-link {{ Request::is('admin/kirim') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pen-to-square"></i>
                            <p>
                                Setor Laporan
                            </p>
                        </a>
                    </li> --}}
                    @elseif (Auth::user()->role == 'superadmin')
                        <li class="nav-item menu-open">
                            <a href="{{ url('superadmin/index') }}" class="nav-link active">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Dashboard
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">DATA MASTER</li>
                        <li class="nav-item">
                            <a href="{{ url('super/shift') }}"
                                class="nav-link {{ Request::is('super/shift') ? 'active' : '' }}">
                                <i class="far fa-clock nav-icon"></i>
                                <p>Setting Shift</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('super/jam') }}"
                                class="nav-link {{ Request::is('super/jam') ? 'active' : '' }}">
                                <i class="far fa-bell nav-icon"></i>
                                <p>Setting Jam dan Tempat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('super/data-kendaraan') }}"
                                class="nav-link {{ Request::is('super/data-kendaraan') ? 'active' : '' }}">
                                <i class="fa-solid fa-truck-fast nav-icon"></i>
                                <p>Setting Kendaraan</p>
                            </a>
                        </li>
                        {{-- <li class="nav-header">REKAP DATA</li>
                    <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ url('super/setor') }}" class="nav-link {{ Request::is('super/setor') ? 'active' : '' }}">
                                <i class="fa-solid fa-cloud-arrow-up nav-icon"></i>
                                <p>Data masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('super/disetor') }}" class="nav-link {{ Request::is('super/disetor') ? 'active' : '' }}">
                                <i class="fa-solid fa-circle-check nav-icon"></i>
                                <p>Data telah disetor</p>
                            </a>
                        </li>
                    </li> --}}
                        {{-- <li class="nav-item">
                        <a href="{{ url('super/pembayaran') }}" class="nav-link {{ Request::is('super/pembayaran') ? 'active' : '' }}">
                            <i class="fa-solid fa-money-check-dollar nav-icon"></i>
                            <p>
                                Setting Pembayaraan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/charts/chartjs.html" class="nav-link">
                                    <i class="far fa-calendar-days nav-icon"></i>
                                    <p>Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/flot.html" class="nav-link">
                                    <i class="far fa-calendar-days nav-icon"></i>
                                    <p>Bulanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/flot.html" class="nav-link">
                                    <i class="far fa-calendar-days nav-icon"></i>
                                    <p>Tahunan</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    @endif
                    @unless (
                        (Auth::check() && Auth::user()->role == 'superadmin') ||
                            Auth::user()->role == 'admin' ||
                            Auth::user()->role == 'kasir' ||
                            Auth::user()->role == 'kolektor')
                        <li class="nav-item menu-open">
                            <a href="{{ url('user/dashboard') }}" class="nav-link active">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Dashboard
                                    {{-- <i class="right fas fa-angle-left"></i> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">TRANSAKSI</li>
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="{{ url('user/parkir') }}"
                                class="nav-link {{ Request::is('user/parkir') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-pen-to-square"></i>
                                <p>
                                    Parkir
                                </p>
                            </a>
                        </li>
                        </li>
                    @endunless
                    <li class="nav-item">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-login dropdown-item" type="submit"
                                style="width: 100%; padding: 10px; text-align: left; background-color: rgba(255, 255, 255, 0.9); 
                                        color: #333; border: none; cursor: pointer; font-size: 14px;
                                        transition: background-color 0.3s, color 0.3s;">
                                <i class="fa-solid fa-right-from-bracket" style="margin-right: 5px;"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                    </li>

                @endif
                {{-- <li class="nav-header">INPUT DATA</li>
                <li class="nav-item">
                    <a href="{{ url('admin/datakendaraan') }}" class="nav-link">
                        <i class="nav-icon fas fa-pen-to-square"></i>
                        <p>
                            Data Kendaraan
                        </p>
                    </a>
                </li>
            <li class="nav-header">REKAP</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="far fa-calendar-days nav-icon"></i>
                                <p>Harian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="far fa-calendar-days nav-icon"></i>
                                <p>Bulanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="far fa-calendar-days nav-icon"></i>
                                <p>Tahunan</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
