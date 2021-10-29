<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Michiel van Ginhoven" />
    <title>Spectrum Roosterapp</title>
    {{-- bootstrap etc. --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- eigen css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layoutstyle.css') }}" >
    @stack('styles')
    {{-- csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-bg-spectrum">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/spectrum-logo-small.svg') }}" width="30" height="30" class="d-inline-block align-top" alt="">
            Spectrum Roosters
        </a>
        <div class="otherLinks">
            <a href="/tracks">Roosters</a>
            <a href="/rooms">Lokalen Beheren</a>
            <a href="#">dropdown</a>
        </div>
    </nav>
    {{-- content uit een andere blade template --}}
    @yield('content')



<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
