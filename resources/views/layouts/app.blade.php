<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($pageTitle) ? $pageTitle.' | ':'' }} {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="fa fa-trophy"></span> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <span class="fa fa-home"></span> Home
                            </a>
                        </li>
                        @can ('view-admin-pages')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('draw.index') }}">
                                <span class="fa fa-ticket-alt"></span> Draw Tickets
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="members" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="fa fa-users"></span> Members
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="members">
                                <a class="dropdown-item" href="{{ route('members.index') }}">
                                    <span class="fa fa-list"></span> {{ __('List') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('members.create') }}">
                                    <span class="fa fa-plus"></span> {{ __('Create') }}
                                </a>
                            </div>
                        </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="page-footer font-small special-color-dark pt-4">

          <!-- Footer Elements -->
          <div class="container">

            <!-- Social buttons -->
            <ul class="list-unstyled list-inline text-center">
              <li class="list-inline-item">
                <a class="btn-floating mx-1" target="_blank" href="http://plus65.com.sg">
                  <img src="{{ asset('logo.png') }}" class="img-responsive" alt="" style="width:30px">
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn-floating mx-1" target="_blank" href="https://www.instagram.com/plus65interactive/">
                  <i class="fab fa-instagram text-dark"> </i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn-floating mx-1" target="_blank" href="https://www.facebook.com/plus65interactive/">
                  <i class="fab fa-facebook text-dark"> </i>
                </a>
              </li>
            </ul>
            <!-- Social buttons -->

          </div>
          <!-- Footer Elements -->

          <!-- Copyright -->
          <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="http://plus65.com.sg"> Plus65</a>
          </div>
          <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </div>
</body>
</html>
