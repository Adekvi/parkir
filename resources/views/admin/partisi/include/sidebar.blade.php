<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('admin/index') }}">
                <p class="text-center text-white">PARKIR</p>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item active">
                            <a href="{{ url('admin/index') }}" class="collapsed">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Administrator</h4>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Data Master</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ url('admin/shift') }}">
                                            <span class="sub-item">Setting Shift</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/jalan') }}">
                                            <span class="sub-item">Setting Nama Jalan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/lokasi') }}">
                                            <span class="sub-item">Setting Jam Operational</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/harga') }}">
                                            <span class="sub-item">Setting Tarif</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/ket') }}">
                                            <span class="sub-item">Setting Keterangan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/header') }}">
                                            <span class="sub-item">Setting Karcis</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/akun') }}">
                                <i class="fa-solid fa-user"></i>
                                <p>Data Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/report') }}">
                                <i class="fa-solid fa-clipboard"></i>
                                <p>Report Data</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/prediksi') }}">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                <p>Prediksi</p>
                            </a>
                        </li>
                    @elseif (Auyh::user()->role == 'kasir')
                        <li class="nav-item active">
                            <a href="{{ url('kasir/index') }}" class="collapsed">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarLayouts">
                                <i class="fas fa-th-list"></i>
                                <p>Sidebar Layouts</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="sidebar-style-2.html">
                                            <span class="sub-item">Sidebar Style 2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="icon-menu.html">
                                            <span class="sub-item">Icon Menu</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="widgets.html">
                                <i class="fas fa-desktop"></i>
                                <p>Widgets</p>
                                <span class="badge badge-success">4</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
