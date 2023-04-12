<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">

    <meta name="author" content="Зейкан Михайло Йосипович">
    <meta name="copyright" content="Maksym Valentynovych Rosokha">
    <meta name="address" content="Україна, Закарпатська область, місто Ужгород, вулиця Капушанська, 82А">

    <meta name="description"
          content="Поліграфічні послуги,Все для нотаріата,Буклети,Візитки,Видання книг,Друк на банері, Таблички,
          Журнали обліку, бланки,Прошивка курсових, дипломних робіт">
    <meta name="keywords"
          content="поліграфічні послуги, все для нотаріата, буклети, візитки, видання книг, друк на банері,
              таблички, журнали обліку, бланки, прошивка курсових, дипломних робіт, друкарня, послуги друкарні">

    <link rel="canonical" href="{{ route('main') }}"/>

    <meta property="og:title"
          content="Доступні реєстри за новою формою. - Скарбничка нотаріуса. Видавництво ІВА. @yield('title')">
    <meta property="og:local" content="uk_UA">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('main') }}">
    <meta property="og:image" content="/storage/images/logo.png">
    <meta property="og:site_name" content="Скарбничка нотаріуса. Видавництво ІВА">
    <meta property="article:modified_time" content="2020-04-12T13:01:04+00:00"/>
    <meta property="og:description"
          content="Поліграфічні послуги,Все для нотаріата,Буклети,Візитки,Видання книг,Друк на банері, Таблички,
          Журнали обліку, бланки,Прошивка курсових, дипломних робіт">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
          content="Доступні реєстри за новою формою. - Скарбничка нотаріуса. Видавництво ІВА. @yield('title')">
    <meta name="twitter:description"
          content="Поліграфічні послуги,Все для нотаріата,Буклети,Візитки,Видання книг,Друк на банері, Таблички,
          Журнали обліку, бланки,Прошивка курсових, дипломних робіт">
    <meta name="twitter:image" content="/storage/images/logo.png">

    <meta itemprop="name"
          content="Доступні реєстри за новою формою. - Скарбничка нотаріуса. Видавництво ІВА. @yield('title')">
    <meta itemprop="description"
          content="Поліграфічні послуги,Все для нотаріата,Буклети,Візитки,Видання книг,Друк на банері, Таблички,
          Журнали обліку, бланки,Прошивка курсових, дипломних робіт">
    <meta itemprop="image" content="/storage/images/logo.png">

    <title>Доступні реєстри за новою формою. - Скарбничка нотаріуса. Видавництво ІВА. @yield('title')</title>
    <link rel="icon" href="/storage/images/logo.png" type="image/icon">

    <link rel="stylesheet" href="/css/reboot.css">
    <link rel="stylesheet" href="/css/helpers.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/header.css"/>
    <link rel="stylesheet" href="/css/footer.css"/>
    @yield('styles')

    <script src="/js/app.js" defer></script>
    @yield('scripts')
</head>
<body>

<div id="app" class="wrapper">
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