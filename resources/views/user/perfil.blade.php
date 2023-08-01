<!-- Ir à pagina https://getbootstrap.com/docs/4.2/getting-started/introduction/ (v4.2), copiar e colocar o starter template em baixo-->
<!--o link deste site é: http://localhost:8000/users -->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
      
      h2{
        color: #EB93C6;
      }

    </style>
  </head>

  <body>
    <main>
      <div class="back">
          <a type="button" href="/" class="btnback">Voltar à Homepage</a>   
      </div>

        <div class="container">
          <center><h1>Perfil do Utilizador</h1></center>

            <h2>Informações do Utilizador</h2>
            <p><b>Nome:</b> {{ $user->name }}</p>
            <p><b>Email:</b> {{ $user->email }}</p>

            <br>

            <h2>Histórico de Comentários</h2>
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
