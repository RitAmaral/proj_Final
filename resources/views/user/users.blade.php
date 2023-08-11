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

    <title>Utilizadores Homepage</title>
    <style>

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

      h1{
        border-bottom: 2px solid white;
        padding: 10px;
        color: #E4A063;
      }
      /* Design do hover / quando passamos por cima do cabeçalho da tabela */ 
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

        /* quando passo por cima de links */
        a:hover{
            color: #E4A063;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
  </head>
  <body>
    

      <canvas id="particle-canvas"></canvas> <!-- background animado -->

      <nav class="nav"> <!-- navigation bar -->
            <a class="nav-link active" style="color:#E4A063;" href="/">Página Inicial</a>
            @auth
                <a class="nav-link" style="color:#E4A063;" href="{{ route('perfil') }}">Perfil</a> <!-- se tiver logado-->
            @endauth
            <a class="nav-link" style="color:#E4A063;" href="{{route('filme.index')}}">Filmes</a>
            <a class="nav-link" style="color:#E4A063;" href="{{route('interveniente.index')}}">Intervenientes</a>
            @if(auth()->check() && auth()->user()->role === 'admin') <!-- só visto por admins-->
                <a class="nav-link" style="color:white; font-weight:bold;" href="{{route('user.index')}}">Utilizadores</a>
            @endif 
        </nav>

    <main class="container">

        <center><h1>Utilizadores na nossa base de dados</h1></center>

        <br>

        <!-- form para pesquisar utilizadores -->
        <center>
            <label for="pesquisar" style="margin: 10px;">Pesquisar por nome:</label>
            <input type="text" id="searchInput" placeholder="Pesquisar utilizadores por nome..."  style="width: 400px;"> 
        </center>

        <!-- form para pesquisar utilizadores -->
        <center>
            <label for="pesquisarEmail" style="margin: 10px;">Pesquisar por email:</label>
            <input type="text" id="searchInputEmail" placeholder="Pesquisar utilizadores por email..."  style="width: 400px;"> 
        </center>

        <br>       

        <table class="table">
            <thead>
                <tr class="hover">
                    <th scope="col">🆔</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email 📧</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Criado em</th>
                    <th colspan=3><center>Ações</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user) <!--função foreach, para todos os users da Base de Dados, escrever individualmente como user?-->
                <tr class="hover2 utilizadores-item"> <!-- colocar class utilizadores-item por causa do javascript -->
                    <th scope="row">{{$user->id}}</th> <!--id, name, email, created_at são os dados que aparecerem no mysql-->
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                        <a type='button' class="btn btn-success" href="{{ route('user.show', $user->id)}}">🔎</a> <!--ir à route, e está lá user.show; buscar aos users o id-->
                    </td>
                    <td>
                        <a type='button' class="btn btn-primary" href="{{ route('user.edit', $user->id)}}">✏️</a>
                    </td>
                    <td>
                        <form action ="{{ route('user.delete', $user->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" class="btn btn-danger" value="⛌">

                        </form>
                    </td>
                </tr>
                @endforeach <!--fim da função foreach-->
            </tbody>
        </table>

        <!-- Javascript - necessário para a pesquisa de utilizadores por nome ir diminuindo  -->
        <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('searchInput'); //mesmo id do form
                    const utilizadorItems = document.querySelectorAll('.utilizadores-item'); //colocar class na tabela

                    searchInput.addEventListener('input', function (event) {
                        const searchTerm = event.target.value.trim().toLowerCase();

                        utilizadorItems.forEach(item => {
                            const nomeUtilizador = item.querySelector('td:nth-child(2)').textContent.toLowerCase(); //2ª linha da tabela
                            if (nomeUtilizador.includes(searchTerm)) {
                                item.style.display = ''; //exibir a linha
                            } else {
                                item.style.display = 'none'; //ocultar a linha
                            }
                        });
                    });
                });
        </script>

        <!-- Javascript - necessário para a pesquisa de utilizadores por email ir diminuindo  -->
        <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('searchInputEmail'); //mesmo id do form
                    const utilizadorItems = document.querySelectorAll('.utilizadores-item'); //colocar class na tabela

                    searchInput.addEventListener('input', function (event) {
                        const searchTerm = event.target.value.trim().toLowerCase();

                        utilizadorItems.forEach(item => {
                            const emailUtilizador = item.querySelector('td:nth-child(3)').textContent.toLowerCase(); //3ª linha da tabela corresponde ao email
                            if (emailUtilizador.includes(searchTerm)) {
                                item.style.display = ''; //exibir a linha
                            } else {
                                item.style.display = 'none'; //ocultar a linha
                            }
                        });
                    });
                });
        </script>

         <!-- background animado -->
         <script>
            function normalPool(o){var r=0;do{var a=Math.round(normal({mean:o.mean,dev:o.dev}));if(a<o.pool.length&&a>=0)return o.pool[a];r++}while(r<100)}function randomNormal(o){if(o=Object.assign({mean:0,dev:1,pool:[]},o),Array.isArray(o.pool)&&o.pool.length>0)return normalPool(o);var r,a,n,e,l=o.mean,t=o.dev;do{r=(a=2*Math.random()-1)*a+(n=2*Math.random()-1)*n}while(r>=1);return e=a*Math.sqrt(-2*Math.log(r)/r),t*e+l}

            const NUM_PARTICLES = 600; //num de particulas
            const PARTICLE_SIZE = 0.5; //tamanho das particulas
            const SPEED = 20000; //veloc das particulas

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

    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
