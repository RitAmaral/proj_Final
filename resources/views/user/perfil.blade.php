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

    <title>Perfil do Utilizador</title>
    <style>

      /* body{
        background-color: lightblue;
      } */

      h1{
        border-bottom: 2px solid #E4A063;
        padding: 10px;
      }

      /* Design do hover / quando passamos por cima do h1 e do cabeçalho da tabela */ 
      .hover:hover{
        background-color:#E4A063;
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
            border: 2px solid #E4A063;
            border-radius: 5px;
            margin-right: 10px;
            padding: 7px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #E4A063;
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
            background-color: #E4A063;
            color: white;
        }
      
      h2{
        color: #E4A063;
      }

      /* Design do botão editar info */
      .pulser {
            width: fit-content;
            background: #E4A063;
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
            background: #E4A063;
            border-radius: 5px;
            z-index: -1;
        }

        .edit:hover{
            background-color: white;
            color: #E4A063;
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

        /* quando passo por cima de links */
        a:hover{
            color: #E4A063;
            text-decoration: none;
            font-weight: bold;
        }

        /* botao voltar ao topo*/
        .topo {
            position: fixed;
            bottom: 20px; 
            left: 20px;
            z-index: 9999; 
            padding:5px;
            background-color: white;
            color: #191970;
            border-radius: 5px;
            font-size: 16px;
            border: 2px solid #E4A063;
        }
        
        .topo:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #E4A063;
            color: white;
        }

    </style>
  </head>

  <body>
    <main>

    <canvas id="particle-canvas"></canvas> <!-- background animado -->

      <div class="back">
            <a type="button" href="/" class="btnback"> <!-- voltar à homepage-->
                <i class="icon"></i>               
            </a>
        </div>
        <div class="container">
          <center><h1>Perfil do Utilizador</h1></center>

          <br>

          @auth
              <center><a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class="btn edit pulser">Editar Informação</a></center>
          @endauth
          <br>

          <!-- informação do utilizador -->
            <h2>👤 Informações do Utilizador</h2>
            <p><b>Nome:</b> {{ $user->name }}</p>
            <p><b>Email:</b> {{ $user->email }}</p>

            <br>

            <h2>⭐ Intervenientes Preferidos</h2>
            @if ($user->intervenientesPreferidos !== null && !$user->intervenientesPreferidos->isEmpty())
                <ul>
                    @foreach ($user->intervenientesPreferidos as $interveniente)
                        <li>
                            <a href="{{ route('interveniente.show', $interveniente->id_interveniente) }}" target="_blank">
                                {{ $interveniente->interveniente }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Nenhum interveniente preferido encontrado.</p>
            @endif

            <br>

            <!-- histórico de comentários -->
            <h2>✍️ Histórico de Comentários</h2>
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

            <!-- histórico de ratings -->
            <h2>✍️ Histórico de Ratings</h2>
            @if ($userRatings->isEmpty())
                <p>Nenhum rating encontrado.</p>
            @else
                <ul class="list-unstyled">
                    @foreach ($userRatings as $userRating)
                        <li class="userating-item">
                            <p><b>Filme:</b> <a href="{{ route('filme.show', $userRating->id_filme) }}" target="_blank">{{ $userRating->titulo }}</a></p>
                            <p><b>User Rating:</b> {{ $userRating->user_rating }} ⭐</p>
                            <br>
                        </li>
                    @endforeach
                </ul>
            @endif
   
        </div>

        <a type='button' href="#top" class="topo">↑</a> <!-- botão voltar ao topo-->

        <!-- background animado -->
        <script>
            function normalPool(o){var r=0;do{var a=Math.round(normal({mean:o.mean,dev:o.dev}));if(a<o.pool.length&&a>=0)return o.pool[a];r++}while(r<100)}function randomNormal(o){if(o=Object.assign({mean:0,dev:1,pool:[]},o),Array.isArray(o.pool)&&o.pool.length>0)return normalPool(o);var r,a,n,e,l=o.mean,t=o.dev;do{r=(a=2*Math.random()-1)*a+(n=2*Math.random()-1)*n}while(r>=1);return e=a*Math.sqrt(-2*Math.log(r)/r),t*e+l}

            const NUM_PARTICLES = 600; //mudar numero de particulas
            const PARTICLE_SIZE = 0.4; //tamanho das particulas
            const SPEED = 40000; //velocidade a que as particulas andam

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
        
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
