<!doctype html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ asset('/js/app.js') }}"></script>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="grid grid-cols-12 min-h-screen">
            <div id="loading">
                <div class="loader">Loading...</div>
            </div>
            <div class=" col-span-2">
                @include('components.sidebar')
            </div>
            <div class=" col-span-10">
                <div class="mb-10 pt-10 text-center text-5xl font-bold">
                    @yield('title')
                </div>
                @yield('content') 
            </div>
        </div>
        @stack('scripts')
    </body>
</html>