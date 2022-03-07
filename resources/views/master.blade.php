<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- lokasi favicon ada di /public/plugin/images/assets/favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/plugin/images/assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/plugin/images/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/plugin/images/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/plugin/images/assets/favicon/site.webmanifest') }}">

    <title>
        @yield('title') | Penilaian Performa BPJS Ketenagakerjaan
    </title>

    {{-- css section --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .bg-theme {
            background: rgb(9,170,230);
            background: linear-gradient(270deg, rgba(9,170,230,1) 10%, rgba(124,229,43,1) 50%);
        }

        .bg-theme-alt {
            background: rgb(9,170,230);
            background: linear-gradient(320deg, rgba(9,170,230,1) 0%, rgba(124,229,43,1) 35%);
        }

        .sidebar-border {
            border-bottom-right-radius: 40px;
        }
    </style>

    @yield('style')
</head>
<body>
    @auth {{-- jika user sudah login --}}
        @include('Layouts.header')

        <div class="container-fluid mx-0 px-0">
            <div class="row mx-0">
                <div class="col-2 px-0">
                    @include('Layouts.sidebar')
                </div>
                <div class="col px-0">
                    @include('Layouts.navbar')
                    @yield('content')
                </div>
            </div>
        </div>
    @endauth

    @guest {{-- jika user belum login --}}
        @yield('content')
    @endguest

    {{-- js section --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    @yield('script')
</body>
</html>
