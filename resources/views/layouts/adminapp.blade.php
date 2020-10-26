<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'TARC Caring' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <link rel="icon" type="image/png" href="https://d1ujqdpfgkvqfi.cloudfront.net/favicon-generator/htdocs/favicons/2020-10-26/d0ee3599391fe3569ff093bb093058dc.ico.png"/>

    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ 'TARC Caring' }}
                </a>
                <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto text-white">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-white">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item text-white">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown text-white">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right text-white bg-info" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-white bg-info" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row min-vh-100 flex-column flex-md-row d-none d-md-flex">
                <aside class="col-12 col-md-2 p-0 bg-info flex-shrink-1">
                    <nav class="navbar navbar-expand navbar-dark bg-info flex-md-column flex-row align-items-start py-2">
                        <div class="collapse navbar-collapse ">
                            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                            <li class="nav-item pt-2">
                                    <a class="nav-link pl-0 text-nowrap text-white" href="{{ route('admin.home') }}"><i class="fa fa-bullseye fa-fw"></i> <span class="d-none d-md-inline @if(Route::is('admin.home')) {{'font-weight-bold'}} @endif">Home</span></a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link pl-0 text-nowrap text-white" href="{{ route('admin.register.management') }}"><i class="fa fa-bullseye fa-fw"></i> <span class="d-none d-md-inline @if(Route::is('admin.register.management')) {{'font-weight-bold'}} @endif">Register Management Account</span></a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link pl-0 text-white" href="{{ route('admin.manage.management') }}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline @if(Route::is('admin.manage.management')) {{'font-weight-bold'}} @endif">Manage Management Account</span></a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link pl-0 text-white" href="{{ route('admin.report.sentiment') }}"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline @if(Route::is('admin.report.sentiment')) {{'font-weight-bold'}} @endif">Feedback Sentiment Report</span></a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link pl-0 text-white" href="{{ route('admin.report.made') }}"><i class="fa fa-heart codeply fa-fw"></i> <span class="d-none d-md-inline @if(Route::is('admin.report.made')) {{'font-weight-bold'}} @endif">Feedback Made Report</span></a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link pl-0 text-white" href="{{ route('admin.report.result') }}"><i class="fa fa-star codeply fa-fw"></i> <span class="d-none d-md-inline @if(Route::is('admin.report.result')) {{'font-weight-bold'}} @endif">Feedback Result Report</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </aside>
                <main class="col bg-faded py-3 flex-grow-1">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>
