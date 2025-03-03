@extends('admin.partisi.layout.home')
@section('judul', 'Update Profil')
@section('konten')

    <div class="content-fluid mb-3">
        <div class="row">
            <div class="judul-menu">
                <ul class="judul">
                    <li>
                        <h3 class="text-dark">@yield('judul')</h3>
                    </li>
                </ul>
            </div>
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header" style="background: #0ddbb9">
                        <h3 class="card-title text-center text-light">Identitas Diri</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('user/update/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group text-center">
                                        <img src="{{ asset('user/img/profil.svg') }}" class="img-fluid rounded"
                                            alt="User Image" style="max-height: 200px; object-fit: cover;">
                                        <p class="text-muted">{{ $user->username }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="{{ $user->username }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jekel" id="jekel" class="form-control" required>
                                            <option value="">--Pilih--</option>
                                            <option value="L" {{ $user->jekel == 'L' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="P" {{ $user->jekel == 'P' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tempat Lahir</label>
                                        <input type="text" name="tempatLahir" class="form-control" id="tempatLahir"
                                            placeholder="Tempat Lahir" value="{{ $user->tempatLahir }}" required>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" name="namaLengkap" id="namaLengkap" class="form-control"
                                            value="{{ $user->namaLengkap }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shift</label>
                                        <select name="id_shift" id="id_shift" class="form-control" required>
                                            <option value="">--Pilih Shift--</option>
                                            @foreach ($shift as $sif)
                                                <option value="{{ $sif->id }}"
                                                    {{ $selectedShift == $sif->id ? 'selected' : '' }}>
                                                    {{ $sif->namaShift }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tglLahir" id="tglLahir"
                                            value="{{ $user->tglLahir }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Lokasi Parkir</label>
                                    <select name="id_lokasiParkir" id="id_lokasiParkir" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($gedung as $ged)
                                            <option value="{{ $ged->id }}"
                                                {{ $selectedGedung == $ged->id ? 'selected' : '' }}>
                                                {{ $ged->tmptParkir }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Nama Lokasi</label>
                                    <input type="text" name="namaLokasi" id="namaLokasi" class="form-control"
                                        value="{{ $user->namaLokasi }}">
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Input tersembunyi untuk lokasi -->
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn text-light" style="background: #0ddbb9">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah browser mendukung Geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Simpan latitude dan longitude ke input tersembunyi
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                }, function(error) {
                    console.error("Error mendapatkan lokasi: ", error.message);
                });
            } else {
                console.error("Geolocation tidak didukung oleh browser ini.");
            }
        });
    </script>
@endpush


{{-- @extends('admin.partisi.layout.home')
@section('judul', 'Update Profil')
@section('konten')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Data Diri</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('user/update/' . $user->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group text-center">
                                        <img src="{{ asset('user/img/profil.svg') }}" class="img-fluid rounded" alt="User Image" style="max-height: 200px; object-fit: cover;">
                                        <p class="text-muted">{{ $user->username }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" name="namaLengkap" id="namaLengkap" class="form-control" value="{{ $user->namaLengkap }}" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Shift</label>
                                        <select name="namaShift" id="namaShift" class="form-control" required>
                                            <option value="">--Pilih Shift--</option>
                                            @foreach ($shift as $item)  
                                                <option value="{{ $item->namaShift }}" {{ $user->shift == $item->id ? 'selected' : '' }}>{{ $item->namaShift }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                     <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" value="{{ old('password', $user->password) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jekel" id="jekel" class="form-control" required>
                                            <option value="">--Pilih--</option>
                                            <option value="L" {{ $user->jekel == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ $user->jekel == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Foto KTP</label>
                                        <input type="file" class="form-control" name="fotoKtp" id="fotoKtp">
                                        <p style="font-size: 12px; color: orange; font-style: italic">Nama Foto : {{ Storage::url($user->fotoKtp) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tempat Lahir</label>
                                        <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="{{ $user->tempatLahir }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tglLahir" id="tglLahir" value="{{ $user->tglLahir }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Lokasi Parkir</label>
                                        <select name="lokasiPkr" id="lokasiPkr" class="form-control" required>
                                            <option value="">--Pilih--</option>
                                            @foreach ($gedung as $item)
                                                <option value="{{ $item->id }}" {{ $user->lokasiPkr == $item->id ? 'selected' : '' }}>{{ $item->tmptParkir }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Nama Lokasi</label>
                                        <input type="text" name="namaLokasi" id="namaLokasi" class="form-control" placeholder="Nama Lokasi Parkir" value="{{ $user->namaLokasi }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" class="form-control" id="alamat" cols="20" rows="5">{{ $user->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Input tersembunyi untuk lokasi -->
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Cek apakah browser mendukung Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                // Simpan latitude dan longitude ke input tersembunyi
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function (error) {
                console.error("Error mendapatkan lokasi: ", error.message);
            });
        } else {
            console.error("Geolocation tidak didukung oleh browser ini.");
        }
    });
</script>
@endpush --}}
