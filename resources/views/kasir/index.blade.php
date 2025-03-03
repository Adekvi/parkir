@extends('admin.partisi.layout.home')
@section('judul', 'Dashboard Kasir')
@section('konten')

<section class="content">
    <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>

                        <p>User</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $kolektorCount }}</sup></h3>

                    <p>Kolektor</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jalanCount }}</h3>

                    <p>Jalan</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-road-circle-check"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $lokasiParkirCount }}</h3>

                    <p>Lokasi Parkir</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>
    
@endsection