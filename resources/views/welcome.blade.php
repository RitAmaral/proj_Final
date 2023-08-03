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
            background-color: #191970;
            padding: 10px;
            color: white;
        }
        /* Design do botão login */
        .login{
            position:fixed;
            top:0;
            right:0;
            padding: 20px;
            text-decoration: none;
        }

        .btnlogin{
            font-size:20px;
            border: 2px solid #B0E0E6;
            text-decoration: none;
            color: #fff;
            background-color: #B0E0E6;
            padding: 7px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btnlogin:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            color: #191970;
        }
        /* Design do Botão registar */
        .btnregister{
            font-size:20px;
            border: 2px solid #FFC0CB;
            text-decoration: none;
            color: #fff;
            background-color: #FFC0CB;
            padding: 7px;
            border-radius: 5px; 
        }

        .btnregister:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            color: #191970;
        }
        h1{
            color: white;
            font-size: 70px;
        }
        h2{
            color: #A9AAF7;
            font-size: 50px;
        }

        /* Design da animação da barra em baixo do Sugestões de Filmes */
        .grower {
            width: 200px;
            height: 5px;
            background: #A9AAF7;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            animation-name: grow;
            animation-duration: 4s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes grow {
            0% {transform: scaleX(1);}
            50% {
                transform: scaleX(2.1);
                background: white;
            }
        }

        /* Design do botão para ir à homepage de Filmes e Users e Intervenientes */
        .btnfilme{
            font-size:20px;
            width: 150px;
            border: 2px solid #FFF775;
            text-decoration: none;
            color: #191970;
            background-color: #FFF775;
            padding: 7px;
            border-radius: 5px;
            position: absolute;
            margin-left: -75px;
        }

        .btnfilme:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            background-color: white;
            border: 2px solid #191970;
            color: #191970;
            text-decoration: none;
        }

        /* Design do hover quando passamos em cima do texto "Escolhe a página a que quer aceder" */
        .escolhe{
            transition: width 2s;
        }
        .escolhe:hover{
            background-color:white;
            color: #191970;
            padding: 1px;
            font-weight: bold;
            width: 300px;
        }
        </style>
    </head>
    <body>
        @if (Route::has('login'))
                <div class="login">
                    @auth                        
                    @else
                        <a href="{{ route('login') }}" class="btnlogin">Log in</a> <!--botão login-->

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btnregister">Register</a> <!--botão registar-->
                        @endif
                    @endauth

                    <div class="login" style="display: flex;">
                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btnlogin">Logout</button>
                            </form>
                            <a href="{{ route('perfil') }}" class="btnregister" style="margin-left: 10px;">Perfil</a>
                        @endauth
                    </div>
                </div>
        @endif
        
        <center><h1>Bem-vindo!</h1></center>
        
        <center><h2>Sugestões de Filmes</h2></center>        

        <div class="grower"></div> <!--animação da barra grower-->

        <br>

        <center>
            <p>Escolha a página a que quer aceder: </p>
            <div class="escolhe">
                <!-- fazer display inline block  e mudar cor do botao user-->
            </div>

            <br>

            <div>
                <a type='button' class="btnfilme" href="{{route('filme.index')}}">Filmes homepage</a> <!--botão filmes-->
            </div>

            <br><br><br><br>

            <div>
                <a type='button' class="btnfilme" href="{{route('interveniente.index')}}">Intervenientes homepage</a> <!--botão filmes-->
            </div>

            <br><br><br>
            <br>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div>
                    <a type='button' class="btnfilme" href="{{ route('user.index') }}">Utilizadores homepage</a> <!--botão user-->
                </div>
            @endif             
        </center>

        @if(auth()->check() && auth()->user()->role === 'admin')
        <br><br><br> <!-- para nao ficar muito espaço em branco quando nao está ninguem logado, coloquei aqui o if para ver se alguem ta logado-->
        @endif 
        <br><br>

        <center><p>Alguns dos filmes presentes na nossa base de dados: </p></center>

        <br><br>

        <!-- carousel de filmes -->
        <center>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="{{ route('filme.show', ['id_filme' => 13]) }}">
                            <img src="http://localhost/proj_Final/Imagens/barbie.png" class="d-block w-40" alt="Póster da Barbie">
                        </a>
                    </div>    
                    <div class="carousel-item">
                        <a href="{{ route('filme.show', ['id_filme' => 3]) }}">
                            <img src="http://localhost/proj_Final/Imagens/starwarsv.png" class="d-block w-40" alt="Póster de Star Wars V">
                        </a>    
                    </div>
                    <div class="carousel-item">
                        <a href="{{ route('filme.show', ['id_filme' => 11]) }}">
                            <img src="http://localhost/proj_Final/Imagens/lalaland.png" class="d-block w-40" alt="Póster de La La Land">
                        </a> 
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </center>

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
