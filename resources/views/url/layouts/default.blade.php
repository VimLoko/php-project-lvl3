<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('url.includes.head')
    </head>
    <body class="min-vh-100 d-flex flex-column">
        <header class="flex-shrink-0">
            @include('url.includes.header')
        </header>
        <main class="flex-grow-1">
            @yield('content')
        </main>
        <footer class="border-top py-3 mt-5 flex-shrink-0">
            @include('url.includes.footer')
        </footer>
        @include('url.includes.scripts')
    </body>
</html>
