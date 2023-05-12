<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href=" {{ mix('css/style.css')}}">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="justify-center pt-8 sm:pt-0 items-center text-center">
                    <div class=" flex justify-center text-center">
                        <img src="{{ asset('/images/index/banner.png') }}" class="content-center max-w-md flex justify-center text-center">
                    </div>
                    
                    <h1 class="m-4 font-bold text-4xl flex justify-center text-center">{{__('Citizens Assemblies')}}</h1>
                    <hr class="mb-8 ml-8 mr-8">
                    <p class="text-sm flex justify-center text-center">{{__('A citizens’ assembly is a new form of democratic decision making. It can be held at the level of a city, a region, a country, or even an international community. A citizens’ assembly consists of a randomly selected group of citizens, which is formed taking into account demographic criteria such as gender and age.')}}</p>
                    
                    <div class="m-8 ">
                        <hr>
                        <h2 class="font-bold text-xl m-4 flex justify-center text-center">{{__('Registrations')}}</h2>
                        
                        <div class="grid grid-cols-2 gap-1">
                            @foreach ($questionnaires as $questionnaire)
                                <div class="border m-4 p-2">
                                    <h3 class="font-bold text-lg bold m-1">{{$questionnaire->name}}</h3>
                                    <hr>
                                    <p class="underline underline-offset-3"><a href="{{url($questionnaire->path)}}">{{url($questionnaire->path)}}</a>
                                    <p>{{$questionnaire->start}} - {{$questionnaire->end}}</p>
                                    <hr>
                                    <p class="m-3 text-justify">{{$questionnaire->description}}</p>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>
