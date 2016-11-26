<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DIYMap</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-fixed-top" >

          <!-- Left area -->
          <div class="navbar-header pull-left"> 
            <!-- <div class="logo" onclick="window.location.href='/'"></div>    -->
            <a onclick="window.location.href='/'" class="navbar-brand" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            <!-- <a onclick="window.location.href='/'" class="navbar-brand" role="button">R</a> -->
          </div>

          <!-- Right area -->
          <div class="navbar-header pull-right">
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
