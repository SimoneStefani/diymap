<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-fixed-top" >

          <!-- Left area -->
          <div class="navbar-header pull-left"> 
            @section('navbar-left')
            <!-- <div class="logo" onclick="window.location.href='/'"></div>    -->
            <div class="navbar-brand">
                <button onclick="window.location.href='/'" class="btn btn-nav" type="button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </button>
            </div>
            @show
            <!-- <a onclick="window.location.href='/'" class="navbar-brand" role="button">R</a> -->
          </div>

          <!-- Right area -->
          <div class="navbar-header pull-right">
            @section('navbar')
                @if (Auth::guest())
                    <a class="navbar-brand pull-right" href="{{ url('/login') }}">Login</a>
                @else
                    <a class="navbar-brand pull-right" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            @show
          </div>
        </nav>  

        @yield('content')
    </div>

    {{-- @section('meta')
        @include('components.assets.meta')
    @show --}}

    <!-- Scripts -->
    <script src="/js/app_vendor.js"></script>
    <script src="/js/app.js"></script>
    @yield('scripts')
    @include('partial.tracking')
</body>
</html>
