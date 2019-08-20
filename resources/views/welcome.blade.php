<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Fileinvite Todo</title>
        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="h-screen flex items-center justify-center bg-teal-lightest font-sans">
            <div class="centerer">
                <todo-list></todo-list>
                <div class="text-center text-muted">Developed for Jackson - August 2019</div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
