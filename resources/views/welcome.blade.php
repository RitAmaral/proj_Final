<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sugestões de Filmes</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

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

        /* Design do botão para ir à homepage de Filmes e Users */
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

                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btnlogin">Logout</button>
                        </form>
                    @endauth
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
            <br><br>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div>
                    <a type='button' class="btnfilme" href="{{ route('user.index') }}">User homepage</a> <!--botão user-->
                </div>
            @endif           
        </center>
    
    </body>
</html>
