<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

        <title>Sugestões de Filmes</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Styles -->
        <style>
        body{
            background-color: #A9AAF7;
            padding: 10px;
            color: black;
        }
        
        /* Design do botão back to intervenientes page */
        .back {
            position: absolute;
            top: 0;
            right: 0;
            padding: 20px;
            text-decoration: none;
        }

        .btnback {
            border: 2px solid #191970;
            border-radius: 5px;
            margin-right: 10px;
            padding: 7px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #191970;
            background-color: white;
        }

         /* Design do icon da homepage*/
        .icon {
            width: 24px; /* Defina a do ícone */
            height: 24px; /* Defina a altura do ícone */
            background-image: url("{{ asset('icons/moviestar.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .btnback:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #191970;
            color: white;
        }

        /* Design do botão IMDB */ 
        .imdbbutton {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f5de50;
            color: black;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        /* Design do botão IMDB quando passamos por cima */ 
        .imdbbutton:hover {
            background-color: #eac13e;
            text-decoration: none;
            color: white;
        }

        h1{
            color: white;
            font-size: 40px;
            border-bottom: 2px solid white;
            padding: 10px;
        }

        h2{
            color: white;
        }

        p{
            font-size: 26px;
        }

        /* Design do botão Adicionar Filme */
        .pulser {
            width: fit-content;
            background: #191970;
            border-radius: 5px;
            position: relative;
            color: #fff;
        }

        .pulser::after {
            animation: pulse 4000ms cubic-bezier(0.9, 0.7, 0.5, 0.9) infinite;
        }

        @keyframes pulse {
            0% {opacity: 0;}
            50% {
            transform: scale(1.4);
            opacity: 0.4;
            }
        }

        .pulser::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: #191970;
            border-radius: 5px;
            z-index: -1;
        }

        .add:hover{
            background-color: #fff;
            color: #191970;
        }
        
        </style>
    </head>
    <body>
        <div class="back">
            <a type="button" href="{{ route('interveniente.index') }}" class="btnback"> <!-- voltar à pagina dos intervenientes-->
                <i class="icon"></i>  
            </a>   
        </div>

        <center>
            <h1>Detalhes do Interveniente</h1>
        </center>
        <br>

        @auth
            <form action="{{ route('adicionar.interv.preferido') }}" method="post">
                @csrf
                <input type="hidden" name="id_interveniente" value="{{ $interveniente->id_interveniente }}">
                <center><button type="submit" class="btn add pulser">Adicionar aos favoritos ⭐</button></center>
            </form>
        @endauth
        <br>

        <center>
            <h2>Filmes em que {{ $interveniente->interveniente }} participou:</h2>
            
                @foreach ($filmes as $filme)
                <p><a target=blank href="{{ route('filme.show', $filme->id_filme) }}">{{ $filme->titulo }}</a> - {{ $filme->ano }}<br></p>
                @endforeach
            
        </center>
    </body>
</html>
