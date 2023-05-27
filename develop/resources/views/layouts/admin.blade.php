<!DOCTYPE html>
<html>
<head>
    @yield('includes.header_meta')
    @include('includes.admin.lib_css')
    @yield('css')
</head>
<body @yield('body')>
    @include('includes.admin.navbar')
    @yield('content')
    @include('includes.admin.lib_script')
    @yield('end_script')
</body>
</html>