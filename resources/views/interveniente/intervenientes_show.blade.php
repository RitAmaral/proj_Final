<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

        <title>Detalhes do Interveniente</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Styles -->
        <style>
        body{
            /*background-color: #A9AAF7;*/
            padding: 10px;
            color: black;
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
            padding: 10px;
        }
        
        /* Design do botão back to intervenientes page */
        .back {
            position: absolute;
            top: 0;
            right: 0;
            padding: 20px;
            text-decoration: none;
        }

        .btnback {
            border: 2px solid #C960A5;
            border-radius: 5px;
            margin-right: 10px;
            padding: 7px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #C960A5;
            background-color: white;
        }

         /* Design do icon da homepage*/
        .icon {
            width: 24px; /* Defina a do ícone */
            height: 24px; /* Defina a altura do ícone */
            background-image: url("{{ asset('icons/moviestar.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .btnback:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #C960A5;
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
            color: #C960A5;
            font-size: 40px;
            border-bottom: 2px solid white;
            padding: 10px;
        }

        h2{
            color: white;
        }

        /* quando passo por cima de links */
        a:hover{
            color: #C960A5;
            text-decoration: none;
            font-weight: bold;
        }

        /* Design do botão Adicionar Filme */
        .pulser {
            width: fit-content;
            background: #C960A5;
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
            background: #C960A5;
            border-radius: 5px;
            z-index: -1;
        }

        .add:hover{
            background-color: #fff;
            color:#C960A5;
        }

        /* barra de navegação */
        nav{
            position: fixed;
            background-color: #0C0A33;
            width: 100%;
            z-index: 100;
        }
        
        </style>
    </head>
    <body>

    <canvas id="particle-canvas"></canvas> <!-- background animado -->

    <nav class="nav"> <!-- navigation bar -->
        <a class="nav-link active" style="color:#C960A5;" href="/">Página Inicial</a>
        @auth
            <a class="nav-link" style="color:#C960A5;" href="{{ route('perfil') }}">Perfil</a> <!-- se tiver logado-->
        @endauth
        <a class="nav-link" style="color:#C960A5;" href="{{route('filme.index')}}">Filmes</a>
        <a class="nav-link" style="color:#C960A5;" href="{{route('interveniente.index')}}">Intervenientes</a>
        @if(auth()->check() && auth()->user()->role === 'admin') <!-- só visto por admins-->
            <a class="nav-link" style="color:#C960A5;" href="{{route('user.index')}}">Utilizadores</a>
        @endif 
    </nav>

    <br>
        <center>
            <h1>Detalhes do Interveniente</h1>
        </center>
        <br>

        @auth
            <form action="{{ route('adicionar.interv.preferido') }}" method="post">
                @csrf
                <input type="hidden" name="id_interveniente" value="{{ $interveniente->id_interveniente }}">
                <center><button type="submit" class="btn add pulser">Adicionar aos favoritos ⭐</button></center>
            </form>
        @endauth
        <br>

        <!-- Title Card -->
        <center>
          <div class="card hover" style="width: 16rem;">

            <img src="http://localhost/proj_Final/Imagens/{{ $interveniente->imagem }}" class="card-img-top" alt="{{ $interveniente->imagem }}">
            <div class="card-body">
              <h3 class="card-title" style="color: #C960A5;">{{ $interveniente->interveniente }}</h3>
              <p class="card-text"><b>País:</b> {{ $pais->pais }}</p>
              <p class="card-text"><b>Função:</b> 
                @foreach (collect($detalhesIntervenientes)->unique('funcao') as $interveniente)
                    {{ $interveniente->funcao }}
                @endforeach
                </p>
                <p class="card-text"><b>Filmes em que participou:</b> <br>
                    @foreach ($filmes->sortByDesc('ano') as $filme) <!-- sort by desc: ano ordenado do mais recentes a mais antigo -->
                        <p><a target=blank href="{{ route('filme.show', $filme->id_filme) }}">{{ $filme->titulo }}</a> - {{ $filme->ano }}<br></p>
                    @endforeach
                </p>             
            </div>
          </div>
        </center>

        <!-- background animado -->
        <script>
            function normalPool(o){var r=0;do{var a=Math.round(normal({mean:o.mean,dev:o.dev}));if(a<o.pool.length&&a>=0)return o.pool[a];r++}while(r<100)}function randomNormal(o){if(o=Object.assign({mean:0,dev:1,pool:[]},o),Array.isArray(o.pool)&&o.pool.length>0)return normalPool(o);var r,a,n,e,l=o.mean,t=o.dev;do{r=(a=2*Math.random()-1)*a+(n=2*Math.random()-1)*n}while(r>=1);return e=a*Math.sqrt(-2*Math.log(r)/r),t*e+l}

            const NUM_PARTICLES = 600; //mudar numero de particulas
            const PARTICLE_SIZE = 0.4; //tamanho das particulas
            const SPEED = 30000; //velocidade a que as particulas andam

            let particles = [];

            function rand(low, high) {
            return Math.random() * (high - low) + low;
            }

            function createParticle(canvas) {
            const colour = {
                r: 201,
                g: randomNormal({ mean: 100, dev: 25 }),
                b: 165,
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
    </body>
</html>
