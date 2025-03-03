<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@yield('judul')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                @if (Auth::check())
                    @if (Auth::user()->role == 'user')
                        <li class="breadcrumb-item active"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                    @elseif (Auth::user()->role == 'kolektor')
                        <li class="breadcrumb-item active"><a href="{{ url('kolektor/index') }}">Dashboard</a></li>
                    @elseif (Auth::user()->role == 'kasir')
                        <li class="breadcrumb-item active"><a href="{{ url('kasir/index') }}">Dashboard</a></li>
                    @elseif (Auth::user()->role == 'admin')
                        <li class="breadcrumb-item active"><a href="{{ url('admin/index') }}">Dashboard</a></li>
                    @elseif (Auth::user()->role == 'superadmin')
                        <li class="breadcrumb-item active"><a href="{{ url('superadmin/index') }}">Dashboard</a></li>                        
                    @endif                    
                @endif
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>