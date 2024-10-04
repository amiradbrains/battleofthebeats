<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Battle of the Beats</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    @php
        $bgs = ['5.png', '7.png', '14.png', '6.png', '3.png', '4.png'];
        $bg = $bgs[array_rand($bgs)];
    @endphp

</head>

<body class="antialiased" style="background-color: #4b5563;">
@yield('content')

</body>

</html>
