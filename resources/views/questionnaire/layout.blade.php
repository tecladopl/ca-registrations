<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="{{Config::get('app.url')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{Config::get('app.url')}} . /images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{Config::get('app.url')}} . /images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{Config::get('app.url')}} . /images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{Config::get('app.url')}} . /images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{Config::get('app.url')}} . /images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{Config::get('app.url')}} . /images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{Config::get('app.url')}} . /images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{Config::get('app.url')}} . /images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{Config::get('app.url')}} . /images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{Config::get('app.url')}} . /images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{Config::get('app.url')}} . /images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{Config::get('app.url')}} . /images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{Config::get('app.url')}} . /images/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{Config::get('app.url')}} . /images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:url" content="{{Config::get('app.url')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ Config::get('app.name', __("Citizen's assembly")) }}"/>
    <meta property="og:description" content="{{ Config::get('app.name', __("Citizen's assembly")) }}"/>
    <meta property="og:image" content="{{Config::get('app.url')}} . /images/index/logo.png"/>
    <title>{{ Config::get('app.name', __("Citizen's assembly")) }}</title>
    <meta name="description" content="{{ Config::get('app.description', __("Citizen's assembly")) }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Styles -->
    <!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/ie.css">
    <![endif]-->

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/questionnaire.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 md:p-12 lg:p-12 sm:p-6 p-3">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto p-6 text-center font-bold">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="p-6">
                    {{ $slot }}
                </div>

            </main>
        </div>
    </div>
</div>
@stack('modals')
@livewireScripts
</body>
</html>
