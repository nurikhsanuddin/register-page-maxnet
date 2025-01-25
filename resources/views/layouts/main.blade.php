<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @include('layouts.partials.link')

    <title>Maxnet</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
</head>

<body class="font-sans flex flex-col min-h-0">
    <div class="flex-grow bg-gray-100  bg-cover bg-fixed md:bg-center">
        @include('layouts.partials.navbar')
        @yield('section')
    </div>

    @include('layouts.partials.script')
    @stack('scripts')
</body>

</html>