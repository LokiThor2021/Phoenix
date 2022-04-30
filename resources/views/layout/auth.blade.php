<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    @section('title')
        <title>{{ \config('other.title') }} - {{ \config('other.subTitle') }}</title>
    @show
    @section('meta')
        <meta name="description" content="{{ __('auth.login-now-on') }} {{ \config('other.title') }} . {{ __('auth.not-a-member') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:site_name" content="{{ \config('other.title') }}">
        <meta property="og:type" content="website">
        <meta name="color-scheme" content="dark light">
        <meta property="og:image" content="{{ \url('/img/logo.png') }}">
        <meta property="og:description" content="{{ \config('unit3d.powered-by') }}">
        <meta property="og:url" content="{{ \url('/') }}">
        <meta property="og:locale" content="{{ \config('app.locale') }}">
        <meta name="csrf-token" content="{{ \csrf_token() }}">
    @show
    <link rel="shortcut icon" href="{{ \url('/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ \url('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ \mix('css/auth.css') }}" crossorigin="anonymous">
</head>
<body class="flex h-screen w-full font-sans antialiased bg-transparent auth">
<!-- Dont Not Change! For Jackett Support -->
<div class="Jackett" style="display:none;">{{ config('unit3d.powered-by') }}</div>
<!-- Dont Not Change! For Jackett Support -->

@if ($errors->any())
    <div id="ERROR_COPY"  style="display: none;">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

@yield('content')

<script src="{{ mix('js/app.js') }}" crossorigin="anonymous"></script>
@foreach (['warning', 'success', 'info'] as $key)
    @if (Session::has($key))
        <script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: '{{ $key }}',
                title: '{{ Session::get($key) }}'
            });

        </script>
    @endif
@endforeach

@if (Session::has('errors'))
    <script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}">
        Swal.fire({
            title: '<strong style=" color: rgb(17,17,17);">Error</strong>',
            icon: 'error',
            html: jQuery('#ERROR_COPY').html(),
            showCloseButton: true
        });

    </script>
@endif
@if(\config('Phoenix.auth-backdrop'))
    <script nonce="{{ HDVinnie\SecureHeaders\SecureHeaders::nonce('script') }}" defer>
        window.onload = () => {
            const body = document.body.style;
            body.background = 'linear-gradient(335deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 1)),url({{\config('Phoenix.auth-backdrop')}}) fixed no-repeat center';
            body.backgroundSize = 'cover';
        };
    </script>
@endif
</body>
</html>