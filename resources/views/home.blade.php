<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-secondary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <!-- Navbar -->
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <div class="container-fluid">
                                        <!-- Toggle button -->
                                        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                                            data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                                            aria-label="Toggle navigation">
                                            <i class="fas fa-bars text-light"></i>
                                        </button>

                                        <!-- Collapsible wrapper -->
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <!-- Left links -->
                                            <ul class="navbar-nav me-auto d-flex flex-row mt-3 mt-lg-0">
                                                <li class="nav-item text-center mx-2 mx-lg-1">
                                                    <a class="nav-link" href="{{route('dokter.index')}}">
                                                        <div>
                                                            <i class="far fa-envelope fa-lg mb-1"></i>
                                                        </div>
                                                        dokter
                                                    </a>
                                                </li>
                                                <li class="nav-item text-center mx-2 mx-lg-1">
                                                    <a class="nav-link " aria-disabled="true" href="{{route('jadwal_praktek.index')}}">
                                                        <div>
                                                            <i class="far fa-envelope fa-lg mb-1"></i>
                                                        </div>
                                                        jadwal-praktek
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Left links -->

                                            <!-- Right links -->
                                            <ul class="navbar-nav ms-auto d-flex flex-row mt-3 mt-lg-0">
                                                <li class="nav-item text-center mx-2 mx-lg-1">
                                                    <a class="nav-link" href="{{route('pasien.index')}}">
                                                        <div>
                                                            <i class="fas fa-bell fa-lg mb-1"></i>
                                                        </div>
                                                        pasien
                                                    </a>
                                                </li>
                                                <li class="nav-item text-center mx-2 mx-lg-1">
                                                    <a class="nav-link" href="{{route('kunjungan.index')}}">
                                                        <div>
                                                            <i class="fas fa-globe-americas fa-lg mb-1"></i>
                                                        </div>
                                                        kunjungan
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Right links -->
                                        </div>
                                        <!-- Collapsible wrapper -->
                                    </div>
                                    <!-- Container wrapper -->

                                    @if (!Request::is('dokter','pasien','jadwal_praktek','kunjungan')) 
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                    @endif
                                </nav>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @extends('layouts.app')

    @section('content')
    @include('layouts.sidebar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="wrapper">
                        <!-- Sidebar -->
                        <div class="sidebar sidebar-style-2" data-background-color="dark">
                            <div class="sidebar-logo">
                                <!-- Logo Header -->
                                <div class="logo-header" data-background-color="dark">
                                    <a href="index.html" class="logo">
                                        <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
                                    </a>
                                    <div class="nav-toggle">
                                        <button class="btn btn-toggle toggle-sidebar">
                                            <i class="gg-menu-right"></i>
                                        </button>
                                        <button class="btn btn-toggle sidenav-toggler">
                                            <i class="gg-menu-left"></i>
                                        </button>
                                    </div>
                                    <button class="topbar-toggler more">
                                        <i class="gg-more-vertical-alt"></i>
                                    </button>
                                </div>
                                <!-- End Logo Header -->
                            </div>
                            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                                <div class="sidebar-content">
                                    <ul class="nav nav-secondary">
                                        <li class="nav-item">
                                            <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                                <i class="fas fa-home"></i>
                                                <p>Dashboard</p>
                                                <span class="caret"></span>
                                            </a>
                                            <div class="collapse" id="dashboard">
                                                <ul class="nav nav-collapse">
                                                    <li><a href="../demo1/index.html"><span class="sub-item">Dashboard 1</span></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Sidebar -->

                        <!-- Main Content -->
                        <div class="main-panel">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">{{ __('Dashboard') }}</div>

                                            <div class="card-body">
                                                @if (session('status'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif

                                                {{ __('You are logged in!') }}
                                                
                                                <!-- Chart Section -->
                                                <div class="mt-4">
                                                    <h5>Jumlah Pasien</h5>
                                                    <canvas id="jumlahPasienChart" width="400" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chart.js CDN -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('jumlahPasienChart').getContext('2d');
                        const jumlahPasienChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Jumlah Pasien'],
                                datasets: [{
                                    label: 'Jumlah Pasien',
                                    data: [{{ $jumlahPasien }}],
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    </script>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
