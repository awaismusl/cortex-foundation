<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', config('app.name'))</title>

    {{-- Meta Data --}}
    @include('cortex/foundation::adminarea.partials.meta')
    @stack('head-elements')

    {{-- Styles --}}
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('css/theme-adminarea.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    @livewireStyles

    {{-- Scripts --}}
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>;
        window.Accessarea = "<?php echo request()->accessarea(); ?>";
    </script>
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    @stack('vendor-scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="hold-transition login-page">

    {{-- Main content --}}
    <div id="app" class="wrapper">

        @yield('content')

    </div>

    {{-- Scripts --}}
    @stack('inline-scripts')
    @livewireScripts
    <script src="{{ route('frontarea.cortex.foundation.turbo.js') }}" data-turbolinks-eval="false" data-turbo-eval="false"></script>

    {{-- Alerts --}}
    @alerts('default')
</body>
</html>
