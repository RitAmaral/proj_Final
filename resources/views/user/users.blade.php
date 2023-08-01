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
        text-shadow: 5px 5px 10px #EB93C6;
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

    </style>
  </head>
  <body>
    <main class="container">

        <center><div class="hover"><h1>Utilizadores na nossa base de dados</h1></div></center>
        <br>
        <table class="table">
            <thead>
                <tr class="hover">
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Criado em</th>
                    <th colspan=3><center>Botões de acção</center></th>
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
