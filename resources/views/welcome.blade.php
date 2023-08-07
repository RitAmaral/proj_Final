<!DOCTYPE html> <!-- PÁGINA PRINCIPAL/INICIAL DOS FILMES-->
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

        <!-- Styles css -->
        <style>

        body{
            /*background-color: #191970;*/
            padding: 10px;
            color: white;
        }
        
        /* Design do botão login/logout */
        .login{
            position:fixed;
            top:0;
            right:0;
            padding: 20px;
            text-decoration: none;
        }

        .btnlogin{
            font-size:20px;
            border: 2px solid #C960A5;
            text-decoration: none;
            color: #fff;
            background-color: #C960A5;
            padding: 7px;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btnlogin:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            color: black;
        }

        /* Design do Botão registar/perfil */
        .btnregister{
            font-size:20px;
            border: 2px solid #D66D48;
            text-decoration: none;
            color: #fff;
            background-color: #D66D48;
            padding: 7px;
            border-radius: 5px; 
        }

        .btnregister:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            color: black;
        }

        h1{
            color: white;
            font-size: 70px;
        }

        h2{
            color: #C960A5;
            font-size: 50px;
        }

        /* Design da animação da barra em baixo do Sugestões de Filmes */
        .grower {
            width: 220px;
            height: 5px;
            background: #C960A5;
            position: relative;
            margin-left: auto;
            margin-right: auto;
            animation-name: grow;
            animation-duration: 5s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes grow {
            0% {transform: scaleX(1);}
            50% {
                transform: scaleX(2.1);
                background: #D66D48;
            }
        }

        /* Design do botão para ir à homepage de Filmes e Users e Intervenientes */
        .btnfilme{
            font-size:20px;
            width: 150px;
            border: 2px solid #D66D48;
            text-decoration: none;
            color: white;
            background-color: #D66D48;
            padding: 7px;
            border-radius: 5px;
            position: absolute;
            margin-left: -75px;
        }

        .btnfilme:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            background-color: white;
            border: 2px solid #D66D48;
            color: #D66D48;
            text-decoration: none;
        }

        /* background animado */
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        #particle-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgb(10, 10, 50) 0%, rgb(60, 10, 60) 100%);
            z-index: -1;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
        }


        </style>
    </head>
    <body>
    <canvas id="particle-canvas"></canvas> <!-- background animado -->

        <!-- se o user tiver logado, vão aparecer botões logout e perfil, se não vão aparecer login e register-->
        @if (Route::has('login'))
                <div class="login">
                    @auth                        
                    @else
                        <a href="{{ route('login') }}" class="btnlogin">Login</a> <!--botão login-->

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

         <!-- background animado -->
         <script>
            function normalPool(o){var r=0;do{var a=Math.round(normal({mean:o.mean,dev:o.dev}));if(a<o.pool.length&&a>=0)return o.pool[a];r++}while(r<100)}function randomNormal(o){if(o=Object.assign({mean:0,dev:1,pool:[]},o),Array.isArray(o.pool)&&o.pool.length>0)return normalPool(o);var r,a,n,e,l=o.mean,t=o.dev;do{r=(a=2*Math.random()-1)*a+(n=2*Math.random()-1)*n}while(r>=1);return e=a*Math.sqrt(-2*Math.log(r)/r),t*e+l}

            const NUM_PARTICLES = 600; //mudar numero de particulas
            const PARTICLE_SIZE = 0.5; //tamanho das particulas
            const SPEED = 20000; //velocidade a que as particulas andam

            let particles = [];

            function rand(low, high) {
            return Math.random() * (high - low) + low;
            }

            function createParticle(canvas) { //mudar cor das particulas
            const colour = {
                r: 255,
                g: randomNormal({ mean: 125, dev: 20 }),
                b: 50,
                a: rand(0, 1),
            };
            return {
                x: -2,
                y: -2,
                diameter: Math.max(0, randomNormal({ mean: PARTICLE_SIZE, dev: PARTICLE_SIZE / 2 })),
                duration: randomNormal({ mean: SPEED, dev: SPEED * 0.1 }),
                amplitude: randomNormal({ mean: 16, dev: 2 }),
                offsetY: randomNormal({ mean: 0, dev: 10 }),
                arc: Math.PI * 2,
                startTime: performance.now() - rand(0, SPEED),
                colour: `rgba(${colour.r}, ${colour.g}, ${colour.b}, ${colour.a})`,
            }
            }

            function moveParticle(particle, canvas, time) {
            const progress = ((time - particle.startTime) % particle.duration) / particle.duration;
            return {
                ...particle,
                x: progress,
                y: ((Math.sin(progress * particle.arc) * particle.amplitude) + particle.offsetY),
            };
            }

            function drawParticle(particle, canvas, ctx) {
            canvas = document.getElementById('particle-canvas');
            const vh = canvas.height / 100;

            ctx.fillStyle = particle.colour;
            ctx.beginPath();
            ctx.ellipse(
                particle.x * canvas.width,
                particle.y * vh + (canvas.height / 2),
                particle.diameter * vh,
                particle.diameter * vh,
                0,
                0,
                2 * Math.PI
            );
            ctx.fill();
            }

            function draw(time, canvas, ctx) {
            // Move particles
            particles.forEach((particle, index) => {
                particles[index] = moveParticle(particle, canvas, time);
            })

            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw the particles
            particles.forEach((particle) => {
                drawParticle(particle, canvas, ctx);
            })

            // Schedule next frame
            requestAnimationFrame((time) => draw(time, canvas, ctx));
            }

            function initializeCanvas() {
            let canvas = document.getElementById('particle-canvas');
            canvas.width = canvas.offsetWidth * window.devicePixelRatio;
            canvas.height = canvas.offsetHeight * window.devicePixelRatio;
            let ctx = canvas.getContext("2d");

            window.addEventListener('resize', () => {
                canvas.width = canvas.offsetWidth * window.devicePixelRatio;
                canvas.height = canvas.offsetHeight * window.devicePixelRatio;
                ctx = canvas.getContext("2d");
            })

            return [canvas, ctx];
            }

            function startAnimation() {
            const [canvas, ctx] = initializeCanvas();

            // Create a bunch of particles
            for (let i = 0; i < NUM_PARTICLES; i++) {
                particles.push(createParticle(canvas));
            }
            
            requestAnimationFrame((time) => draw(time, canvas, ctx));
            };

            // Start animation when document is loaded
            (function () {
            if (document.readystate !== 'loading') {
                startAnimation();
            } else {
                document.addEventListener('DOMContentLoaded', () => {
                startAnimation();
                })
            }
            }());
        </script>

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
