<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login!</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ 'admin/vendors/mdi/css/materialdesignicons.min.css' }}">
    <link rel="stylesheet" href="{{ 'admin/vendors/base/vendor.bundle.base.css' }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ 'admin/css/style.css' }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ 'admin/images/logogo.png' }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <h4>Selamat Datang!</h4>
                                {{-- <h6 class="font-weight-light">Sign in to continue.</h6> --}}
                                <form class="pt-3" action="{{ url('login/store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    @if ($errors->has('login'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('login') }}
                                        </div>
                                    @endif

                                    @if ($errors->has('access'))
                                        <div class="alert alert-warning">
                                            {{ $errors->first('access') }}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Username" value="{{ old('username') }}">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        {{-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            href="../../index.html">SIGN IN</a> --}}
                                    </div>
                                    <div class="text-center mt-4 font-weight-light">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" class="text-primary">Create</a>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <h4>Hello! let's get started</h4>
                                <h6 class="font-weight-light">Sign in to continue.</h6>

                                <form action="{{ url('login/store') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    @if ($errors->has('login'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('login') }}
                                        </div>
                                    @endif

                                    @if ($errors->has('access'))
                                        <div class="alert alert-warning">
                                            {{ $errors->first('access') }}
                                        </div>
                                    @endif

                                    <div class="input-group mb-3">
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Username" value="{{ old('username') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="register">
                                    <p class="mb-2 mt-2">
                                        <a href="{{ route('register') }}" class="text-center">Daftar Akun</a>
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ 'admin/vendors/base/vendor.bundle.base.js' }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ 'admin/js/template.js' }}"></script>
    <!-- endinject -->
</body>

</html>
