<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .auth-img-bg {
      background-image: url('{{ asset('user/img/parkir.jpg') }}');
      border-radius: 5px;
      background-size: cover;
      background-position: center;
      min-height: 100vh;
    }

    .auth-form-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .auth-form-transparent {
      background: rgba(255, 255, 255, 0.8);
      border-radius: 8px;
      padding: 20px;
    }

    .form-container {
      max-width: 400px;
      margin: auto;
    }

    .form-control {
      font-size: 14px;
    }
  </style>
</head>

<body>
    <div class="container-fluid p-0">
      <div class="row g-0">
        <!-- Form Section -->
        <div class="col-lg-4 auth-form-container">
          <div class="auth-form-transparent text-left">
            <h4 class="mb-4">Daftar Pengguna Baru</h4>
            <form method="POST" action="{{ route('kolektor.store') }}" enctype="multipart/form-data" class="form-container">
              @csrf
              {{-- Username --}}
              <div class="mb-3">
                <input type="text" 
                       class="form-control @error('username') is-invalid @enderror" 
                       name="username" 
                       placeholder="Username"
                       value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              {{-- Nama Lengkap --}}
              <div class="mb-3">
                <input type="text" 
                       class="form-control @error('namaLengkap') is-invalid @enderror" 
                       name="namaLengkap" 
                       placeholder="Nama Lengkap"
                       value="{{ old('namaLengkap') }}">
                @error('namaLengkap')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              {{-- Password --}}
              <div class="mb-3">
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       name="password" 
                       placeholder="Password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              {{-- Register Button --}}
              <div class="d-grid">
                <button type="submit" class="btn btn-warning btn-lg">Register</button>
              </div>
              <div class="text-center mt-4 font-weight-light">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Login</a>
              </div>
            </form>
          </div>
        </div>
        <!-- Background Section -->
        <div class="col-lg-8 auth-img-bg">
          <div class="d-flex justify-content-center align-items-center h-100">
            <p class="text-white text-center fw-bold">&copy; <?= date('Y') ?> Sipar. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>  

</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
