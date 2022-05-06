<meta charset="UTF-8">
@section('title')
    <title>{{\page_title()}}</title>
@show

<meta name="description" content="{{ config('other.meta_description') }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="_base_url" content="{{ route('home.index') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta')
<link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
<link rel="icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
@livewireStyles
@yield('stylesheets')
<style>
    :root {
        --fa-style-family: "Font Awesome 6 Pro"!important;
        --fa-style: 900!important;
    }
</style>
