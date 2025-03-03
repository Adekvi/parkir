<nav class="navbar top-navbar col-lg-12 col-12 p-0" style="background: #0ddbb9">
    <div class="container-fluid">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between p-4">
            <ul class="navbar-nav navbar-nav-left">
                <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                    <a href="#" class="nav-link horizontal-nav-left-menu" id="toggleMenu">
                        <i class="mdi mdi-format-list-bulleted text-white"></i>
                    </a>
                </li>
                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                            <a href="{{ url('admin/index') }}" class="nav-link hoizontal-nav-left-menu">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 'kasir')
                        <li class="nav-item ms-0 me-5 d-lg-flex d-none">
                            <a href="{{ url('admin/index') }}" class="nav-link hoizontal-nav-left-menu">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown d-lg-flex d-none">
                    <a href="{{ url('user/update/form') }}"
                        class="btn btn-light btn-sm text-dark {{ Request::is('user/update/form') ? 'active' : '' }}">
                        Profile
                    </a>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                    <a href="{{ url('menu/index') }}"
                        class="btn btn-light btn-sm text-dark {{ Request::is('menu/index') ? 'active' : '' }}">
                        Menu
                    </a>
                </li>
                <li class="nav-item nav-profile dropdown" style="cursor: pointer">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                        <span class="nav-profile-name text-white">
                            {{ Auth::user()->namaLengkap }}
                        </span>
                        <span class="online-status"></span>
                        <img src="{{ asset('user/img/akun.png') }}" alt="" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item">
                            <i class="mdi mdi-settings text-primary"></i>
                            Settings
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-nav-link">
                                <i class="mdi mdi-logout text-danger"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="horizontal-menu-toggle">
                <span class="mdi mdi-menu text-white"></span>
            </button>
        </div>
    </div>
</nav>

@push('css')
    <style>
        /* CSS untuk tombol yang aktif */
        .btn.active {
            background-color: #464dee;
            /* Warna latar belakang saat tombol aktif */
            color: #fff;
            /* Warna teks saat tombol aktif */
            border-color: #464dee;
            /* Warna border saat tombol aktif */
        }
    </style>
@endpush
