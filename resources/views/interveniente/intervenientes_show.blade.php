<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
        
        /* Design do botão back to welcome page */
        .back{
            position:absolute;
            top:0;
            right:0;
            padding: 20px;
            text-decoration: none;
        }

        .btnback{
            font-size:12px;
            border: 2px solid #191970;
            text-decoration: none;
            color: #fff;
            background-color: #191970;
            padding: 7px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btnback:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            background-color: white;
            color: #191970;
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
        }
        h2{
            color: white;
        }
        p{
            font-size: 26px;
        }
        
        </style>
    </head>
    <body>
        <div class="back">
            <a type="button" href="{{ route('interveniente.index') }}" class="btnback">Voltar aos Intervenientes</a>   
        </div>

        <center>
            <h1>Detalhes do Interveniente</h1>
        </center>
        <br>
        <center>
            <h2>Filmes em que {{ $interveniente->interveniente }} participou:</h2>
            
                @foreach ($filmes as $filme)
                <p><a target=blank href="{{ route('filme.show', $filme->id_filme) }}">{{ $filme->titulo }}</a> - {{ $filme->ano }}<br></p>
                @endforeach
            
        </center>
    </body>
</html>
