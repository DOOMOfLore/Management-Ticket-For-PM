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
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#3eb060">
    <meta name="theme-color" content="#4ea64e">
    <link rel="search" type="application/opensearchdescription+xml" title="Pixabay" href="https://pixabay.com/static/misc/opensearch.xml">

    <!-- Styles -->
    <link href="{{ asset('backend/css/big-login.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}"/>
    
    <!-- Script -->
    <script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
</head>
<body>
    <div class="big-loading"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
    
    <div class="big-login">
       @yield('content')
    </div>
</body>
</html>
