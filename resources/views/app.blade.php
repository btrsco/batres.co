<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name') }}</title>

        <meta
            inertia
            head-key="description"
            name="description"
            content="{{ $page['props']['app']['meta']['description'] }}"
        />

        <meta
            inertia
            head-key="og:type"
            property="og:type"
            content="{{ $page['props']['app']['meta']['type'] }}"
        />

        <meta
            inertia
            head-key="og:title"
            property="og:title"
            content="{{ $page['props']['app']['meta']['title']['default'] }}"
        />

        <meta
            inertia
            head-key="og:description"
            property="og:description"
            content="{{ $page['props']['app']['meta']['description'] }}"
        />

        <meta
            inertia
            head-key="og:site_name"
            property="og:site_name"
            content="{{ $page['props']['app']['name'] }}"
        />

        <meta
            inertia
            head-key="og:image"
            property="og:image"
            content="{{ $page['props']['app']['meta']['image'] }}"
        />

        <meta
            inertia
            head-key="twitter:card"
            property="twitter:card"
            content="{{ $page['props']['app']['meta']['twitter_card'] }}"
        />

        <meta
            inertia
            head-key="twitter:title"
            property="twitter:title"
            content="{{ $page['props']['app']['name'] }}"
        />

        <meta
            inertia
            head-key="twitter:description"
            property="twitter:description"
            content="{{ $page['props']['app']['meta']['description'] }}"
        />

        <meta
            inertia
            head-key="twitter:site"
            property="twitter:site"
            content="{{ $page['props']['app']['social']['twitter']['at'] }}"
        />

        <meta
            inertia
            head-key="twitter:image"
            property="twitter:image"
            content="{{ $page['props']['app']['meta']['image'] }}"
        />

        <meta
            inertia
            head-key="theme-color:light"
            name="theme-color"
            content="{{ $page['props']['app']['meta']['theme']['light'] }}"
            media="(prefers-color-scheme: light)"
        />

        <meta
            inertia
            head-key="theme-color:dark"
            name="theme-color"
            content="{{ $page['props']['app']['meta']['theme']['dark'] }}"
            media="(prefers-color-scheme: dark)"
        />

        <link rel="preconnect" href="https://cdn.serve.ooo">

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
