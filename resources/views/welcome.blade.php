
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>OrganizaTe</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <!--Bootstrap-->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>

        <section class="welcome-body">
            <div class="welcome-body-content">
                <p>
                    Bienvenido a la pagina web de ysiprobamos!!
                </p>
            
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <button class="btn btn-primary">
                            <a href="{{ route('login') }}">Acceder</a>
                        </button>
                        
                        @if (Route::has('register'))
                            <button class="btn btn-primary">
                                <a href="{{ route('register') }}">Registrarte</a>
                            </button>
                        @endif
                    @endauth
                @endif
            </div>
        </section>
    </body>
</html>
