
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        @include('landing.include.css')
        @stack('css')

    </head>

    <body>

        {{-- <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End --> --}}

        <!-- Topbar Start -->
        @include('landing.include.topbar')
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        @include('landing.include.navbar')
        <!-- Navbar & Hero End -->

        @yield('isi')

        @include('landing.include.footer')

        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        @include('landing.include.js')
        @stack('js')

    </body>

</html>
