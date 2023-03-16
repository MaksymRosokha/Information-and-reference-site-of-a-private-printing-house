<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/storage/images/logo.png" type="image/icon type">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/reboot.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/header.css"/>
    @yield('styles')
    @yield('scripts')
</head>
<body>

<div class="wrapper">
    <header>
        @include('partials.header')
    </header>


    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>


    <footer>

    </footer>
</div>


</body>
</html>