<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('image/logo/Logo.png')}}" type="image/x-icon">
    <title>PRDGTL</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Css --}}
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <img src="{{asset('image/logo/Logo.png')}}" alt="Brand Logo" width="40px" style="float: left; margin-right:5px">
                        Perpustakaan Digital
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
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                    @if (Auth::user()->role == 'Admin')
                                    <li>
                                        <a href="{{route('anggota.user_admin')}}"><i class="fas fa-users"></i> Anggota </a>
                                    </li>
                                    @endif


                                    
                                    @if (Auth::user()->role == 'Admin')
                                    <li>
                                        <a href="{{route('daftar.pengajuan_peminjaman_buku_admin')}}"><i class="far fa-list-alt"></i> Daftar Pengajuan</a>
                                    </li> 
                                    @endif

                                    @if (Auth::user()->role == 'User')
                                    <li>
                                        <a href="{{route('status.riwayat_pengajuan_user')}}"><i class="far fa-list-alt"></i> Pengajuan</a>
                                    </li> 
                                    @endif
                                    

                                   @if (Auth::user()->role == 'Admin')
                                   <li>
                                    <a href="{{route('daftar.peminjaman_admin')}}">  <i class="fas fa-check-circle"></i> Di Setujui</a>
                                   </li>   
                                   @endif

                                   @if (Auth::user()->role == 'User')
                                   <li>
                                    <a href="{{route('status.riwayat_peminjaman_user')}}"> <i class="fas fa-book-reader"></i> Peminjaman</a>
                                    </li> 
                                   @endif
                                
                                   @if (Auth::user()->role == 'Admin')
                                   <li>
                                    <a href="{{route('daftar.pembatalan_admin')}}"> <i class="fas fa-window-close"></i> Pembatalan</a>
                                   </li> 
                                   @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           <i class="fas fa-sign-out-alt"></i> Logout
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
