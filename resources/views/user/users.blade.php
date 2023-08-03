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

    </style>
  </head>
  <body>
    <main class="container">

        <div class="back">
            <a type="button" href="/" class="btnback"> <!-- voltar à homepage-->
                <i class="icon"></i>               
            </a>
        </div>

        <center><h1>Utilizadores na nossa base de dados</h1></center>
        <br>
        <table class="table">
            <thead>
                <tr class="hover">
                    <th scope="col">🆔</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email 📧</th>
                    <th scope="col">Criado em</th>
                    <th colspan=3><center>Ações 👀 🚧 ❌</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user) <!--função foreach, para todos os users da Base de Dados, escrever individualmente como user?-->
                <tr class="hover2">
                    <th scope="row">{{$user->id}}</th> <!--id, name, email, created_at são os dados que aparecerem no mysql-->
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a type='button' class="btn btn-success" href="{{ route('user.show', $user->id)}}">Ver</a> <!--ir à route, e está lá user.show; buscar aos users o id-->
                    </td>
                    <td>
                        <a type='button' class="btn btn-warning" href="{{ route('user.edit', $user->id)}}">Editar</a>
                    </td>
                    <td>
                        <form action ="{{ route('user.delete', $user->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Eliminar">

                        </form>
                    </td>
                </tr>
                @endforeach <!--fim da função foreach-->
            </tbody>
        </table>

    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
