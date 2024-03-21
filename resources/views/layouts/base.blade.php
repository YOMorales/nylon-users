<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Nylon</title>

    @yield('head')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('script')
</head>

<body class="bg-grey-darken-4">

    <div class="w-75 my-8 mx-auto pa-6 bg-grey-darken-3 rounded-lg">
        <h2 class="text-h4 font-weight-black text-orange">Nylon</h2>

        @yield('content')
    </div>

</body>

</html>
