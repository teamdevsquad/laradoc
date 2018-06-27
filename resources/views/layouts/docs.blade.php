<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DevSquad | Docs</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
</head>
<body>
    <div id="app" v-cloak>
        <header>
            <nav class="navbar navbar-dark bg-primary">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('/img/logo.png') }}" class="d-inline-block align-top" alt="" />
                </a>
            </nav>
        </header>
        
        <div class="docs-wrapper container">
            @yield('sidebar')
            @yield('content')
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
