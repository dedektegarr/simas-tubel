<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | {{ $page_title }}</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/x-icon">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-6a5aa2f6.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @yield('login')

        @if (Auth::check())
            @include('layouts.partials.navbar')
            @include('layouts.partials.sidebar')

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">{{ $page_title }}</h1>
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>

            </div>

            @include('layouts.partials.footer')
    </div>

    {{-- @vite('resources/js/app.js') --}}
    <script src="{{ asset('build/assets/app-b32bcb33.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    @stack('script')
    @endif

</body>

</html>
