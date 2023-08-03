<!-- Ir à pagina https://getbootstrap.com/docs/4.2/getting-started/introduction/ (v4.2), copiar e colocar o starter template em baixo-->
<!--o link deste site é: http://localhost:8000/users -->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Utilizadores</title>
    <style>

      body{
        background-color: lightblue;
      }

      h1{
        border-bottom: 2px solid #EB93C6;
        padding: 10px;
      }
      /* Design do hover / quando passamos por cima do h1 e do cabeçalho da tabela */ 
      .hover:hover{
        background-color:#EB93C6;
        padding: 1px;
      }
      /* Design do hover2 / quando passamos por cima da tabela */ 
      .hover2:hover{
        background-color:#fff;
        padding: 1px;
      }

      /* Design do botão back to welcome page */
      .back {
            position: absolute;
            top: 0;
            right: 0;
            padding: 20px;
            text-decoration: none;
        }

        .btnback {
            border: 2px solid #EB93C6;
            border-radius: 5px;
            margin-right: 10px;
            padding: 7px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #EB93C6;
            background-color: white;
        }

         /* Design do icon da homepage*/
        .icon {
            width: 24px; /* Defina a largura desejada para o ícone */
            height: 24px; /* Defina a altura desejada para o ícone */
            background-image: url("{{ asset('icons/homepage.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .btnback:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #EB93C6;
            color: white;
        }
      
      h2{
        color: #EB93C6;
      }

      /* Design do botão editar info */
      .pulser {
            width: fit-content;
            background: #EB93C6;
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
            background: #EB93C6;
            border-radius: 5px;
            z-index: -1;
        }

        .edit:hover{
            background-color: white;
            color: #EB93C6;
        }

    </style>
  </head>

  <body>
    <main>
      <div class="back">
            <a type="button" href="/" class="btnback"> <!-- voltar à homepage-->
                <i class="icon"></i>               
            </a>
        </div>

        <div class="container">
          <center><h1>Perfil do Utilizador</h1></center>

          <br>

          @auth
              <center><a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class="btn edit pulser">Editar Informação</a></center>
          @endauth
          <br>

            <h2>👤 Informações do Utilizador</h2>
            <p><b>Nome:</b> {{ $user->name }}</p>
            <p><b>Email:</b> {{ $user->email }}</p>

            <br>

            <h2>⭐ Intervenientes Preferidos</h2>
            @if ($user->intervenientesPreferidos !== null && !$user->intervenientesPreferidos->isEmpty())
                <ul>
                    @foreach ($user->intervenientesPreferidos as $interveniente)
                        <li>
                            <a href="{{ route('interveniente.show', $interveniente->id_interveniente) }}">
                                {{ $interveniente->interveniente }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Nenhum interveniente preferido encontrado.</p>
            @endif

            <br>

            <h2>✍️ Histórico de Comentários</h2>
            @if ($comentarios->isEmpty())
                <p>Nenhum comentário encontrado.</p>
            @else
                <ul class="list-unstyled">
                    @foreach ($comentarios as $comentario)
                        <li class="comentario-item">
                            <p><b>Data e Hora:</b> {{ $comentario->data_hora }}</p>
                            <p><b>Filme:</b> <a href="{{ route('filme.show', $comentario->id_filme) }}" target="_blank">{{ $comentario->filme->titulo }}</a></p>
                            <p><b>Comentário:</b> {{ $comentario->comentario }}</p>
                            <br>
                        </li>
                    @endforeach
                </ul>
            @endif
   
        </div>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
