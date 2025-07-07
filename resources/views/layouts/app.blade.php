<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Eden1eav</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.header')
    
    <div class="container-fluid flex-grow-1">
        <div class="row h-100">
            @include('layouts.sidebar')
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @include('partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>

    @include('layouts.scripts')
</body>
</html>