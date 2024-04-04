<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name') }}</title>

        @include('partials.meta', ['page' => $page])
        @include('partials.favicons')

        <link rel="preconnect" href="https://a.serve.ooo">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;1,400;0,700;1,700&display=swap" rel="stylesheet">

        @production
            <script defer data-domain="batres.co" src="https://a.serve.ooo/js/plausible.js"></script>
        @endproduction

        @vite(['resources/scripts/app.js', "resources/views/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans font-normal antialiased bg-zinc-50">
        @inertia
    </body>
</html>
