<!doctype html>
<html lang="{{ $user->locale}}">
<head>
    @include('partials.head')
</head>
<body class="flex min-h-screen w-full font-sans antialiased bg-neutral-800 text-gray-300 scroll-smooth">
    <header class="w-full">
        @include('partials.userbar')
        @include('partials.header')
    </header>
    <script src="{{ mix('js/alpine.js') }}" crossorigin="anonymous" defer></script>

</body>

</html>