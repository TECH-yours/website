@include('includes.language')
<!doctype html>
<html>
<head>
    @include('includes.head')
    @include('includes.header_meta', ['page_title' => 'YoursHealth | 友益食'])
    <title>YoursHealth | 友益食</title>
    <link rel="icon" href="/img/logo_icon.ico">
</head>
<body>
@include('includes.navbar')
<main role="main" style="margin-top: 50px;">

    <div class="main-page">
        @yield('content')
    </div>
</main>
{{--<p>{{ session() -> all()  }}</p>--}}
@include('includes.footer')
<script>
    // new WOW().init();

    $('.language').on('click', function () {
        var val = $(this).attr('id');
        window.location.href = '/language/' + val;
    });

</script>
@yield('end_script')
</body>
</html>
