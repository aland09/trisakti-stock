<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (!empty($data['title']))
            {{ $data['title'] }} - {{ config('app.name', 'Laravel') }}
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {{-- datatables --}}
    <link href="{{ asset('assets/vendor/DataTables/datatables.min.css') }}" rel="stylesheet" />

    @stack('custom-css')
</head>

<body>
    {{-- navbar --}}
    @include('includes.navbar')

    {{-- sidebar --}}
    @include('includes.sidebar')

    <main class="content pe-4 min-vh-100">
        <div class="pe-2">
            @include('includes.header')

            @yield('content')

            @include('includes.footer')
        </div>
    </main>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    {{-- summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    {{-- datatables --}}
    <script src="{{ asset('assets/vendor/DataTables/datatables.min.js') }}"></script>

    @stack('custom-js')
</body>

</html>
