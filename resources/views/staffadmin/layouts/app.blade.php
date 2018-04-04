<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    @include('staffadmin.static.style')
    @yield('style')
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navigation Top -->
    @include('staffadmin.inc.navbar')

    <!-- Navigation Side -->
    @include('staffadmin.inc.sidebar')
    <main class="app-content">
        @yield('admincontent')
    </main>
    @include('staffadmin.static.script')
    @yield('script')
  </body>
