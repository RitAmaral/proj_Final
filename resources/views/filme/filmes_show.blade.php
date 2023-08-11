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
        
        /* Design do botão back to filmes page */
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

         /* Design do icon da homepage */
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

        /* Estilo para a lista de comentários */
        ul.list-unstyled {
            padding: 0;
        }

        /* .comentario-item {
            margin-bottom: 20px; 
            border: 1px solid #ddd; 
            padding: 10px;
            background-color: #f9f9f9; 
        } */

        /* Design do botão enviar comentario e classificação */
        .btnenviar{
            font-size:16px;
            border: 2px solid #C960A5;
            text-decoration: none;
            color: #fff;
            background-color: #C960A5;
            padding: 7px;
            border-radius: 5px;
        }

        .btnenviar:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            background-color: white;
            color: #C960A5;
            border: 2px solid #C960A5;
        }

        .marginhor{
            margin-right: 15px;
            margin-left: 15px;
        }
        
        </style>
    </head>
    <body>
        <canvas id="particle-canvas"></canvas> <!-- background animado -->
      
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
                    <h3 class="card-title" style="color: #C960A5;">{{$filmes->titulo}}</h3>
                    <p class="card-text">
                        <b>Ano: </b> {{$filmes->ano}} <br>
                        <b>IMDb Rating: </b> {{$filmes->rating}} <br>
                        <b>User Rating: </b> {{ $averageRating }} <br>   
                        <b>Classificação: </b> {{$filmes->classificacao}} <br>
                        <b>País: </b> {{$filmes->pais}} <br>
                        <b>Plataforma: </b> {{$filmes->plataforma}}  
                            @if ($plataforma)
                                <img src="http://localhost/proj_Final/Imagens/{{ $plataforma->imagem }}" class="card-img-top" alt="" style="width:50px; height:50px;">
                            @endif
                            <br>
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
            <div class="container">
            <!-- Comentários dos users -->
            <div class="row">
                <div class="col-md-6">
                    <h3>Comentários:</h3>

                    @if ($comentarios->isEmpty())
                        <p>Nenhum comentário ainda.</p>
                    @else
                        <ul class="list-unstyled">
                            @foreach ($comentarios as $comentario)
                            <li>
                                <div class="card border-dark mb-3" style="max-width: 34rem; background-color: rgba(255, 255, 255, 0.7);">
                                    <div class="card-header bg-transparent border-dark"><b>Por: </b>{{ $comentario->name }}</div>
                                        <div class="card-body text-success">
                                            <p class="card-text" style="color:#C960A5;">{{ $comentario->comentario }}</p>
                                        </div>
                                    <div class="card-footer bg-transparent border-dark"><b>Data e Hora: </b>{{ $comentario->data_hora }}</div>
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
        </div>

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
