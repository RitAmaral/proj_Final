<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

        <title>Detalhes do Filme</title>

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
        
        /* Design do botão back to filmes page */
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
            background-image: url("{{ asset('icons/moviespage.png') }}");
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

        /* Estilo para a lista de comentários */
        ul.list-unstyled {
            padding: 0;
        }

        .comentario-item {
            margin-bottom: 20px; 
            border: 1px solid #ddd; 
            padding: 10px;
            background-color: #f9f9f9; 
        }

        /* Design do botão enviar comentario e classificação */
        .btnenviar{
            font-size:16px;
            border: 2px solid #191970;
            text-decoration: none;
            color: #fff;
            background-color: #191970;
            padding: 7px;
            border-radius: 5px;
        }

        .btnenviar:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            background-color: #FFF775;
            color: #191970;
            border: 2px solid #191970;
        }

        .marginhor{
            margin-right: 15px;
            margin-left: 15px;
        }
        
        </style>
    </head>
    <body>
        <div class="back">
            <a type="button" href="{{ route('filme.index') }}" class="btnback"> <!-- voltar aos filmes page-->
                <i class="icon"></i>      
            </a>  
        </div>

        <center>
            <h1>Detalhes do Filme</h1>
        </center>
        <br>

        <!-- Title Card -->
        <center>
            <div class="card hover" style="width: 18rem;">
            <img src="http://localhost/proj_Final/Imagens/{{ $filmes->imagem }}" class="card-img-top" alt="{{ $filmes->titulo }}">
            <div class="card-body">
                <h3 class="card-title">{{$filmes->titulo}}</h3>
                <p class="card-text">
                    <b>Ano: </b> {{$filmes->ano}} <br>
                    <b>IMDb Rating: </b> {{$filmes->rating}} <br>
                    <b>User Rating: </b> {{ $averageRating }} <br>   
                    <b>Classificação: </b> {{$filmes->classificacao}} <br>
                    <b>País: </b> {{$filmes->pais}} <br>
                    <b>Plataforma: </b> {{$filmes->plataforma}} <br>
                    <br>
                    <b><u>Géneros</u></b> <br>
                    @foreach ($generos as $genero)
                        {{ $genero->genero }}<br>
                    @endforeach
                    <br>
                    <b><u>Intervenientes</u></b> <br>
                    @foreach ($detalhesIntervenientes as $interveniente)
                        {{ $interveniente->interveniente }} - {{ $interveniente->funcao }} <br>
                    @endforeach
                </p>
                <a href="{{ $filmes->link_imdb }}" target="_blank" class="imdbbutton">Vê o trailer no IMDb</a>
            </div>
            </div>
        </center>

        <br><br>

        <!-- Comentários dos users -->
        <div class="row">
            <div class="col-md-6">
                <h3>Comentários:</h3>

                @if ($comentarios->isEmpty())
                    <p>Nenhum comentário ainda.</p>
                @else
                    <ul class="list-unstyled">
                        @foreach ($comentarios as $comentario)
                        <li class="comentario-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>Por:</b> {{ $comentario->name }}</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <p><b>Data e Hora:</b> {{ $comentario->data_hora }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>Comentário:</b> {{ $comentario->comentario }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>          

            <br><br>

           <!-- só para users logados, classificar o filme -->
            <div class="col-md-6">
                @auth           
                    <h3>Classifica o filme:</h3> 
                    <form action="{{ url('/rating') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_filme" value="{{ $filmes->id_filme }}">
                        <input type="hidden" name="id" value="{{ auth()->id() }}">

                        <label for="user_rating">Selecione uma classificação:</label>
                        <select name="user_rating" id="user_rating" class="marginhor">
                            <option value="1">1 ⭐</option>
                            <option value="2">2 ⭐⭐</option>
                            <option value="3">3 ⭐⭐⭐</option>
                            <option value="4">4 ⭐⭐⭐⭐</option>
                            <option value="5">5 ⭐⭐⭐⭐⭐</option>
                            <option value="6">6 ⭐⭐⭐⭐⭐⭐</option>
                            <option value="7">7 ⭐⭐⭐⭐⭐⭐⭐</option>
                            <option value="8">8 ⭐⭐⭐⭐⭐⭐⭐⭐</option>
                            <option value="9">9 ⭐⭐⭐⭐⭐⭐⭐⭐⭐</option>
                            <option value="10">10 ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary btnenviar">Enviar Classificação</button>
                    </form>
                     
                    <br>

                 <!-- Formulário deixar comentário -->
                <h3>Deixe um comentário:</h3>
                
                <form action="{{ route('comentarios.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_filme" value="{{ $filmes->id_filme }}">
                    <div class="form-group">
                        <textarea name="comentario" id="comentario" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btnenviar">Enviar Comentário</button>
                </form>
                @endauth
            </div>
        </div>  
        
    </body>
</html>
