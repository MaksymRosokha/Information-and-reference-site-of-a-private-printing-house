<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/storage/images/logo.png" type="image/icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/reboot.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/header.css"/>
    <link rel="stylesheet" href="/css/footer.css"/>
    @yield('styles')
    @yield('scripts')
</head>
<body>

<div id="wrapper">
    <header id="header">
        @include('partials.header')
    </header>


    <main id="main">
        <div id="container">
            @yield('content')
        </div>
    </main>


    <footer id="footer">
        @include('partials.footer')
    </footer>
</div>

</body>
</html>