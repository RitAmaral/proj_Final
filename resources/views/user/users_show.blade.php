<!-- Esta página é o que vemos quando carregamos no botão ver da página users -->

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

      /* Design do hover / quando passamos por cima do h1 e do title card */
      .hover:hover{
          background-color:#EB93C6;
          padding: 1px;
      }

      /* Design do botão back to users page */
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
            background-image: url("{{ asset('icons/usericon.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            margin-right: 5px;
        }

        .btnback:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #191970;
            color: white;
        }

    </style>
  </head>
  <body>
    <main class="container">

      <div class="back">
          <a type="button" href="{{ route('user.index') }}" class="btnback"> <!-- voltar à pagina dos users-->
            <i class="icon"></i>
          </a>   
      </div>

        <center><div class="hover"><h1>Detalhes do Utilizador</h1></div></center>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Criado em</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <th scope="row">{{$user->id}}</th> <!--id, name, email, created_at são os dados que aparecerem no mysql-->
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                </tr>
                
            </tbody>
        </table>
        <br>
        <!-- Title Card -->
        <div class="card hover" style="width: 18rem;">
          <img src="" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">{{$user->name}}</h5>
            <p class="card-text"><u>{{$user->name}}</u> is a cool person, whose email is: <u>{{$user->email}}</u> </p>
            <a href="https://www.google.com/" target="_blank" class="btn btn-primary">Google</a>
          </div>
        </div>

    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
