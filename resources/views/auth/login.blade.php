<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group input {
            width: calc(100% - 24px);
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            display: block;
            margin: 0 auto;
        }

        .btn {
            background: #6e8efb;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 16px;
        }

        .btn:hover {
            background: #a777e3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            display: none;
        }

        .register-link {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Selamat Datang!</h2>
        <form id="loginForm" action="{{ url('login/store') }}" method="POST" enctype="multipart/form-data">
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
                    class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                    value="{{ old('username') }}">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-3">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
        <p class="register-link">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
</body>

</html>
