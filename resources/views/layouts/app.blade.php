<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <title>@stack('meta_title')</title>
    <base href="{{ asset('/') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="description" content="@stack('meta_description')"/>
    <meta property="og:title" content="@stack('meta_title')"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:image" content="{{ asset('/images/logo.png') }}"/>
    <meta property="og:site_name" content="{{ config('app_name') }}"/>
    <link rel="stylesheet" type="text/css" href="{{  asset('/dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('/dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  mix('/css/app.css') }}">
    <link href="{{ asset('/dist/mmenu/mmenu.css') }}" rel="stylesheet"/>
    @stack('styles')
</head>
<body>
<div id="page">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-md">
                <a href="#main-menu" class="btn btn-outline-light px-3 mr-2 mr-sm-3 d-inline d-lg-none"
                   id="button-menu"><i class="fa-solid fa-ellipsis-vertical"></i> Меню</a>
                <div class="collapse d-none d-lg-block">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Главная</a>
                        <a class="nav-link" href="#">Отзывы</a>
                        <a class="nav-link" href="{{ route('page', 'gallery') }}">Галерея работ</a>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="bg-black-opacity my-3">
            <div class="container-md header-2">
                <div class="logo d-none d-lg-block">
                    <a href="{{ route('home') }}"><img src="{{ asset('/images/logo.png') }}" class="img-fluid"></a>
                </div>
                <div class="d-flex align-items-center contact">
                    <div class="text-center">
                        <a href="tel:{{ phone_clear(setting('phone')) }}" class="phone"><i
                                class="fa-solid fa-square-phone"></i> {{ setting('phone') }}</a>
                        <div>{{ setting('working_hours') }}</div>
                    </div>
                    <div class="text-center">
                        <div>
                            <i class="fa-solid fa-location-dot"></i> БАЛАШИХА УЛ.КОЖЕДУБА, 13
                        </div>
                        <a href="{{ setting('location_map') }}" target="_blank">(схема проезда)</a>
                    </div>
                    <div class="d-md-flex flex-column text-right d-none">
                        <a href="mailto:{{ setting('email') }}">
                            <i class="fa-solid fa-envelope-circle-check text-white"></i> {{ setting('email') }}
                        </a>
                        <a href="https://www.instagram.com/{{ setting('instagram') }}" target="_blank"><i
                                class="fa-brands fa-instagram text-white"></i> {{ '@' . setting('instagram') }}</a>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg bg-orange menu d-none d-lg-block">
            <div class="container-md">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{ route('page', 'car-wash') }}">Мойка</a>
                        <a class="nav-link" href="{{ route('page', 'tire-service') }}">Шиномонтаж</a>
                        <a class="nav-link" href="{{ route('page', 'auto-detailing') }}">Детейлинг</a>
                        <a class="nav-link" href="{{ route('page', 'seasonal-tire-storage') }}">Хранение шин</a>
                        <a class="nav-link" href="{{ route('page', 'price') }}">Прайс</a>
                        <a class="nav-link" href="{{ route('page', 'promotion') }}">Акции</a>
                        <a class="nav-link" href="{{ route('page', 'about-us') }}">О нас</a>
                        <a class="nav-link" href="{{ route('page', 'contact') }}">Контакты</a>
                    </div>
                    <form class="my-2 my-lg-0 order-lg-1 ms-auto w-auto js_form_search">
                        <input class="form-control mr-sm-2 " type="search" placeholder="Поиск по сайту"
                               aria-label="Search">
                    </form>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    @include('partials.carbrands')
    @include('partials.yandexmap')

    <footer class="bg-dark">
        <div class="container-md">
            <div class="row py-5">
                <div class="col-md-6">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{ route('page', 'about-us') }}" class="text-white">О
                                нас</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Сертификаты и гарантия</a></li>
                        <li class="list-inline-item"><a href="#" class="text-white">Ваши отзывы о нас</a></li>
                        <li class="list-inline-item"><a href="{{ route('page', 'contact') }}" class="text-white">Контакты</a>
                        </li>
                    </ul>

                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-orange">Качественная мойка в Балашихе</a></li>
                                <li><a href="#" class="text-white">Помыть машину не дорого</a></li>
                                <li><a href="#" class="text-white">Бонусная программа на мойку</a></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-orange">Полировка кузова</a></li>
                                <li><a href="#" class="text-white">Восстанавливаем блеск</a></li>
                                <li><a href="#" class="text-white">Виды полировки</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-orange">Видео</a></li>
                                <li><a href="#" class="text-white">Видео по восстановлению салона</a></li>
                                <li><a href="#" class="text-white">Выбор стекол для авто</a></li>
                                <li><a href="#" class="text-white">Качественная уборка салона</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-right text-white">
                    <p class="h2 font-weight-light mb-3">{{ setting('phone') }}</p>
                    <div class="d-inline-block border border-light rounded p-2 px-3">У вас остались вопросы?<br>
                        <a href="#" class="d-block text-center h4 text-orange">Задайте их нам</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="py-4 font-weight-light bg-secondary text-white">
            <div class="container-md">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-left">
                        <p class="mb-md-0">
                            Auto-plane.ru © 2017 - 2019. All rights reserved. </p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline mb-0 mt-2 mt-md-0 text-center text-md-right">
                            <li class="list-inline-item"><i class="fa-brands fa-cc-visa"></i></li>
                            <li class="list-inline-item"><i class="fa-brands fa-cc-mastercard"></i></li>
                            <li class="list-inline-item"><i class="fa-brands fa-apple-pay"></i></li>
                            <li class="list-inline-item"><i class="fa-brands fa-google-pay"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<nav id="main-menu">
    <ul>
        <li><a class="nav-link" href="{{ route('page', 'car-wash') }}">Мойка</a></li>
        <li><a class="nav-link" href="{{ route('page', 'tire-service') }}">Шиномонтаж</a></li>
        <li><a class="nav-link" href="{{ route('page', 'auto-detailing') }}">Детейлинг</a></li>
        <li><a class="nav-link" href="{{ route('page', 'seasonal-tire-storage') }}">Хранение шин</a></li>
        <li><a class="nav-link" href="{{ route('page', 'price') }}">Прайс</a></li>
        <li><a class="nav-link" href="{{ route('page', 'promotion') }}">Акции</a></li>
        <li><a class="nav-link" href="{{ route('page', 'about-us') }}">О нас</a></li>
        <li><a class="nav-link" href="{{ route('page', 'contact') }}">Контакты</a></li>
    </ul>
</nav>
<script src="{{ asset('/dist/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/js/autocomplete.js') }}"></script>
<script src="{{ asset('/js/search.js') }}"></script>
<script src="{{ asset('/dist/mmenu/mmenu.js') }}"></script>
<script src="{{ asset('/js/mmenu.js') }}"></script>

@stack('scripts')
</body>
</html>
