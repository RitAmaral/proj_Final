<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

        <title>Editar Filme</title>

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

         /* Design do icon da homepage*/
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

        h1{
            color: white;
            font-size: 40px;
            border-bottom: 2px solid white;
            padding: 10px;
        }

        /* Design do botão editar */
        .btnedit{
            font-size:16px;
            border: 2px solid #C960A5;
            text-decoration: none;
            color: #fff;
            background-color: #C960A5;
            padding: 7px;
            border-radius: 5px;
        }

        .btnedit:hover{
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
            text-decoration: none;
            background-color: white;
            color:#C960A5;
            border: 2px solid #C960A5;
        }
        
        /* Para colocar alguns elementos do formulário em inline-block */
        .inlineblock{
            display:inline-block;
            margin-right: 22px;
            margin-left: 22px;
        }
        
        </style>
    </head>
    <body>

    <canvas id="particle-canvas"></canvas> <!-- background animado -->
    <div class="container">

        <div class="back">
            <a type="button" href="{{ route('filme.index') }}" class="btnback"> <!-- voltar aos filmes page-->
                <i class="icon"></i>      
            </a>  
        </div>

        <center>
            <h1>Editar Filme</h1>
        </center>
        <br><br>
        <!-- métodos: get ou post: get aparece no endereço os campos; o post não aparece-->
        <center>
        <form method="post" action="{{ route('filme.update', $filme->id_filme) }}">
            <!-- Método para validar se os dados estão a sair deste formulário: csrf -->
            @csrf <!-- para protecção -> link: https://laravel.com/docs/10.x/csrf -->
            @method ('put') <!-- o método no html é post, mas no php/laravel é 'put'-->
            <div class="form-group">
                <label for="titulo">Título</label> <!-- em baixo, só quero que apareça a classe "is-invalid" se houve erro no titulo -->
                <input type="text" style="width:700px" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{$filme->titulo}}"> <!--"titulo" é o nome do campo da base de dados-->
                @error('titulo')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
                
            </div>
            <div class="form-group inlineblock">
                <label for="ano">Ano</label>
                <input type="ano" style="width:100px" class="form-control @error('ano') is-invalid @enderror" name="ano" value="{{$filme->ano}}">
                @error('ano')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group inlineblock">
                <label for="id_classificacao">Classificação</label>
                <input type="id_classificacao" style="width:100px" class="form-control @error('id_classificacao') is-invalid @enderror" name="id_classificacao" value="{{$filme->id_classificacao}}">
                @error('id_classificacao')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group inlineblock">
                <label for="id_pais">País</label>
                <input type="id_pais" style="width:100px" class="form-control @error('id_pais') is-invalid @enderror" name="id_pais" value="{{$filme->id_pais}}">
                @error('id_pais')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group inlineblock">
                <label for="id_plataforma">Plataforma</label>
                <input type="id_plataforma" style="width:100px" class="form-control @error('id_plataforma') is-invalid @enderror" name="id_plataforma" value="{{$filme->id_plataforma}}">
                @error('id_plataforma')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group inlineblock">
                <label for="rating">Rating</label>
                <input type="rating" style="width:100px" class="form-control @error('rating') is-invalid @enderror" name="rating" value="{{$filme->rating}}">
                @error('rating')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="link_imdb">Link IMDb</label>
                <input type="link_imdb" style="width:700px" class="form-control @error('link_imdb') is-invalid @enderror" name="link_imdb" value="{{$filme->link_imdb}}">
                @error('link_imdb')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
            </div>
        <br>
        <button type="submit" class="btn btn-primary btnedit">Gravar alteração</button>
        </form>
        </center>

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
        
    </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>
