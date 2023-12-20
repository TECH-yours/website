@include('includes.language')
<!doctype html>
<html>
<head>
    @include('includes.head')
    <title>YoursHealth | 友益食</title>
    <link rel="icon" href="/img/logo_icon.ico">
</head>
<body>
@include('includes.navbar')
<main role="main" style="margin-top: 50px;">
    <div class="col" style="margin-bottom: 15px;display: none">
        <h2>{{$page_header}}</h2>
        <div class="border-bottom"></div>
    </div>

    <div class="main-page">
        @yield('content')
    </div>
</main>
{{--<p>{{ session() -> all()  }}</p>--}}
@include('includes.footer')
<script>
    new WOW().init();

    $('.language').on('click', function () {
        var val = $(this).attr('id');
        window.location.href = '/language/' + val;
    });

</script>
@yield('end_script')
</body>
</html>
