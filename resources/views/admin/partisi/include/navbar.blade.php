<nav class="bottom-navbar" id="bottomNavbar"
    style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-in-out;">
    <div class="container">
        <ul class="nav page-navigation">
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/index') ? 'active' : '' }}"
                            href="{{ url('admin/index') }}">
                            <i class="fa-solid fa-book mt-2"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="mdi mdi-cube-outline menu-icon"></i>
                            <span class="menu-title">Master Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <!-- Dropdown submenu -->
                        <div class="submenu">
                            <ul class="submenu-item">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/shift') ? 'active' : '' }}"
                                        href="{{ url('admin/shift') }}">Setting Shift
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/jalan') ? 'active' : '' }}"
                                        href="{{ url('admin/jalan') }}">Setting Nama Jalan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/lokasi') ? 'active' : '' }}"
                                        href="{{ url('admin/lokasi') }}">Setting Jam Operasional
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/tarif') ? 'active' : '' }}"
                                        href="{{ url('admin/tarif') }}">Setting Tarif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/ket') ? 'active' : '' }}"
                                        href="{{ url('admin/ket') }}">Setting Keterangan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/header') ? 'active' : '' }}"
                                        href="{{ url('admin/header') }}">Setting Karcis
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('admin/shift') }}"
                            class="nav-link {{ Request::is('admin/shift') ? 'active' : '' }}">
                            <i class="fa-solid fa-clock mt-2"></i>
                            <span class="menu-title">Setting Shift</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/jalan') }}"
                            class="nav-link {{ Request::is('admin/jalan') ? 'active' : '' }}">
                            <i class="fa-solid fa-location-dot mt-2"></i>
                            <span class="menu-title">Setting Nama Jalan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/lokasi') }}"
                            class="nav-link {{ Request::is('admin/lokasi') ? 'active' : '' }}">
                            <i class="fa-solid fa-bell mt-2"></i>
                            <span class="menu-title">Setting Jam Operasional</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/harga') }}"
                            class="nav-link {{ Request::is('admin/harga') ? 'active' : '' }}">
                            <i class="fas fa-money-bill mt-2"></i>
                            <span class="menu-title">Setting Tarif</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/ket') }}"
                            class="nav-link {{ Request::is('admin/ket') ? 'active' : '' }}">
                            <i class="fa-solid fa-pen mt-2"></i>
                            <span class="menu-title">Setting Keterangan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/header') }}"
                            class="nav-link {{ Request::is('admin/header') ? 'active' : '' }}">
                            <i class="fa-solid fa-ticket mt-2"></i>
                            <span class="menu-title">Setting Karcis</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'kasir')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/index') ? 'active' : '' }}"
                            href="{{ url('admin/index') }}">
                            <i class="mdi mdi-file-document-box mt-2"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/shift') }}"
                            class="nav-link {{ Request::is('admin/shift') ? 'active' : '' }}">
                            <i class="fa-solid fa-clock mt-2"></i>
                            <span class="menu-title">Setting Shift</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/jalan') }}"
                            class="nav-link {{ Request::is('admin/jalan') ? 'active' : '' }}">
                            <i class="fa-solid fa-location-dot mt-2"></i>
                            <span class="menu-title">Setting Nama Jalan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/lokasi') }}"
                            class="nav-link {{ Request::is('admin/lokasi') ? 'active' : '' }}">
                            <i class="fa-solid fa-bell mt-2"></i>
                            <span class="menu-title">Setting Jam Operasional</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/harga') }}"
                            class="nav-link {{ Request::is('admin/harga') ? 'active' : '' }}">
                            <i class="fa-solid fa-money-bill mt-2"></i>
                            <span class="menu-title">Setting Tarif</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/keterangan') }}"
                            class="nav-link {{ Request::is('admin/keterangan') ? 'active' : '' }}">
                            <i class="fa-solid fa-money-bill mt-2"></i>
                            <span class="menu-title">Setting Keterangan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/header') }}"
                            class="nav-link {{ Request::is('admin/header') ? 'active' : '' }}">
                            <i class="fa-solid fa-ticket mt-2"></i>
                            <span class="menu-title">Setting Karcis</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</nav>
