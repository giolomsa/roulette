<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Roulette') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<?php
$userBalance = \Illuminate\Support\Facades\Auth::user()->balance;
?>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top ">
            <div class="container col-lg-12 ">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Roulette') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <a>Balance: {{$userBalance}} Cents</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid main-container">
            <div class="col-md-2 sidebar">
                <ul class="nav nav-pills nav-stacked">
                    <?php
                    $segment = Request::segment('1');
                    ?>

                    @if($segment == '')
                        <li class="active"><a href="{{url('/')}}/" >Dashboard</a></li>
                    @else
                        <li><a href="{{url('/')}}/" >Dashboard</a></li>
                    @endif

                    @if($segment == 'balance')
                        <li class="active"><a href="{{url('/')}}/balance" >User Balance</a></li>
                    @else
                        <li><a href="{{url('/')}}/balance" >User Balance</a></li>
                    @endif

                    @if($segment == 'addbet' || $segment == 'gameresult')
                        <li class="active"><a href="{{url('/')}}/addbet">Make Bet</a></li>
                    @else
                        <li><a href="{{url('/')}}/addbet">Make Bet</a></li>
                    @endif

                    @if($segment == 'history' )
                        <li class="active"><a href="{{url('/')}}/history">Game History</a></li>
                    @else
                        <li><a href="{{url('/')}}/history">Game History</a></li>
                    @endif

                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('title')
                    </div>
                    <div class="panel-body">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>
