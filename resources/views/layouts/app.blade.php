<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mangrupa') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3eb060">

    <!-- Scripts -->
    <script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

    <!-- Fonts -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}"/>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/css/reset.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/css/mtree.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/css/big-main.css') }}"/>
</head>
<body>
    <div class="big-loading"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
    
    <div class="big-left">
        <div class="big-logo">
            <img src="{{ asset('backend/image/i-mardoc.svg') }}" style="width: 200px;"/>
            <br /><br /><br /><br /><br />
            <div>
                &copy; 2018 . Allright Reserved
            </div>
        </div>
        <div class="big-main-menu">
            <div class="menu-wrap">
                @include('layouts/main-menu')
            </div>
        </div>
    </div>
    <div class="big-right">
        <header>
            <div class="big-hide-menu"></div>
            <div class="big-user">
                <div class="big-profile">
                    <div class="pic" id="b-profile" style="background-image:url(https://www.goodcatchgames.com/wp-content/uploads/2018/08/MBSD_IOS_ICON-300x300.png);"></div>
                    <div class="profile-content">
                        <span>
                            Hi,
                            <b>{{ Auth::user()->name }}</b>
                        </span>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <div class="big-container">
            @yield('content')

            <div class="big-popup" id="popup2">
                <div class="popup-wrap">
                    <div class="popup-header">
                        <div class="popup-close fa fa-times"></div>
                        <div class="popup-title"></div>
                    </div>
                    <div class="popup-content" style="width:1000px; height:500px; overflow: auto;">

                    </div>
                </div>
            </div>
                
        </div> <!-- big-container end -->
    </div> <!-- big-right end -->
        
    <script src="{{ asset('backend/js/jquery.velocity.min.js') }}"></script>
    <script src="{{ asset('backend/js/mtee.js') }}"></script>
    <script src="{{ asset('backend/js/big-main.js') }}"></script>
</body>
</html>
