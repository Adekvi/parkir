@extends('admin.partisi.layout.home')
@section('judul', 'Admin | Report Data')
@section('konten')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
            <div class="judul">
                <ul>
                    <li>
                        <h5 class="fw-bold mb-3">@yield('judul')</h5>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <!-- Judul di kiri -->
                            <h3 class="card-title m-0">Laporan Data parkir</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
