<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

        <title>Intervenientes Homepage</title>

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
        
        /* Design do botão back to welcome page */
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
            width: 24px; /* Defina a largura desejada para o ícone */
            height: 24px; /* Defina a altura desejada para o ícone */
            background-image: url("{{ asset('icons/homepage.png') }}");
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
            color: #C960A5;
            font-size: 40px;
            border-bottom: 2px solid white;
            padding: 10px;
        }

        /* Design do hover / quando passamos por cima do cabeçalho da tabela */ 
        .hover:hover{
            background-color:#C960A5;
            padding: 1px;
        }

        /* Design do hover2 / quando passamos por cima da tabela */ 
        .hover2:hover{
            background-color:#fff;
            padding: 1px;
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

        /* Design do botão Adicionar Filme */
        .pulser {
            width: fit-content;
            background: #191970;
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
            background: #191970;
            border-radius: 5px;
            z-index: -1;
        }

        .add:hover{
            background-color: #fff;
            color: #191970;
        }

        .interveniente-item {
            display: table-row;
        }
        
        /* botao voltar ao topo*/
        .topo {
            position: fixed;
            bottom: 20px; 
            left: 20px;
            z-index: 9999; 
            padding:5px;
            background-color: white;
            color: #C960A5;
            border-radius: 5px;
            font-size: 16px;
            border: 2px solid #C960A5;
        }
        
        .topo:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #C960A5;
            color: white;
        }

        </style>
    </head>
    <body>
        <main>
        <canvas id="particle-canvas"></canvas> <!-- background animado -->
        <div class="container">
            
        <div class="back">
            <a type="button" href="/" class="btnback">
                <i class="icon"></i>               
            </a>
        </div>

            <center>
                <h1>Os intervenientes da nossa base de dados de filmes</h1>
            </center>

            <br>

            <!-- form para pesquisar intervenientes -->
            <center>
                <label for="pesquisar" style="margin: 10px;">Pesquisar:</label>
                <input type="text" id="searchInput" placeholder="Pesquisar intervenientes..."  style="width: 400px;"> 
            </center>
            <br>
            
            <center>
                <!-- form para ordenar titulo por ASC e DESC -->
                <form id="ordenarInterv" style="display: inline;">
                    <label for="ordenar">Interveniente:</label>
                    <select name="ordenar" id="ordenar">
                        <option value="asc">A-Z ↑</option>
                        <option value="desc">A-Z ↓</option>
                    </select>
                </form>

                <!-- form para filtrar filmes por paises -->
                <form id="filtrarPorPaisForm" style="display: inline;">
                    <label for="pais">País:</label>
                    <select name="pais" id="pais">
                        <option value="">Todos</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais->pais }}">{{ $pais->pais }}</option>
                        @endforeach
                    </select>
                </form>  

                <form id="filtrarPorFuncaoForm" style="display: inline;">
                    <label for="funcao">Função:</label>
                    <select name="funcao" id="funcao">
                        <option value="">Todos</option>
                        @foreach (collect($intervenientesData)->unique('funcao') as $intervenienteData)
                            <option value="{{ $intervenienteData['funcao'] }}">{{ $intervenienteData['funcao'] }}</option>
                        @endforeach
                    </select>
                </form>
            </center>

            <center>
                <br>
                <table class="table">
                    <thead>
                        <tr class="hover">
                        <th scope="col">Interveniente 👤</th>
                        <th scope="col">País 🌍</th>
                        <th scope="col">Função</th>
                        <th scope="col">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($intervenientes as $interveniente)
                        <tr class=" hover2 interveniente-item">
                            <td>{{ $interveniente->interveniente }}</td>
                            <td>{{ $interveniente->pais }}</td>
                            <td>
                                @if (isset($intervenientesData[$interveniente->id_interveniente]))
                                    {{ $intervenientesData[$interveniente->id_interveniente]['funcao'] }}
                                @endif
                            </td>
                            <td>
                            <a type='button' class="btn btn-success" href="{{ route('interveniente.show', $interveniente->id_interveniente)}}">🛈</a> 
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </center>
            <br>
            <a type='button' href="#top" class="topo">↑</a> <!-- botão voltar ao topo-->

        <!-- Javascript - necessário para a pesquisa de intervenientes ir diminuindo  -->
        <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('searchInput');
                    const intervenienteItems = document.querySelectorAll('.interveniente-item');

                    searchInput.addEventListener('input', function (event) {
                        const searchTerm = event.target.value.trim().toLowerCase();

                        intervenienteItems.forEach(item => {
                            const nomeInterveniente = item.querySelector('td:nth-child(1)').textContent.toLowerCase();
                            if (nomeInterveniente.includes(searchTerm)) {
                                item.style.display = ''; //exibir a linha
                            } else {
                                item.style.display = 'none'; //ocultar a linha
                            }
                        });
                    });
                });
        </script>

        <!-- Javascript - necessário para ordenar intervenientes ASC e DESC -->
        <script>
                document.getElementById('ordenar').addEventListener('change', function () {
                    const ordenar = this.value;
                    const intervenienteItems = Array.from(document.querySelectorAll('.interveniente-item'));

                    intervenienteItems.sort(function (a, b) {
                        const intervA = a.querySelector('td:nth-child(1)').textContent.toLowerCase();
                        const intervB = b.querySelector('td:nth-child(1)').textContent.toLowerCase();

                        if (ordenar === 'asc') {
                            return intervA.localeCompare(intervB);
                        } else {
                            return intervB.localeCompare(intervA);
                        }
                    });

                    const table = document.querySelector('.table tbody');
                    intervenienteItems.forEach(interveniente => table.appendChild(interveniente));
                });
        </script>

        <!-- Javascript - necessário para selecionar intervenientes por pais -->
        <script>
                document.getElementById('filtrarPorPaisForm').addEventListener('change', function () {
                    event.preventDefault();
                    const paisSelecionado = document.getElementById('pais').value.trim().toLowerCase();
                    const intervItems = document.querySelectorAll('.interveniente-item');

                    intervItems.forEach(item => {
                        const paisesInterv = item.querySelector('td:nth-child(2)').textContent.toLowerCase(); 
                        if (!paisSelecionado || paisesInterv.includes(paisSelecionado)) {
                            item.style.display = ''; //mostra os intervenientes por pais
                        } else {
                            item.style.display = 'none'; //ocultar os intervenientes que nao sao do pais selecionado
                        }
                    });
                });
            </script>

        <!-- Javascript - necessário para selecionar intervenientes por função -->
        <script>
                document.getElementById('filtrarPorFuncaoForm').addEventListener('change', function () {
                    event.preventDefault();
                    const funcaoSelecionado = document.getElementById('funcao').value.trim().toLowerCase();
                    const intervItems = document.querySelectorAll('.interveniente-item');

                    intervItems.forEach(item => {
                        const funcaoInterv = item.querySelector('td:nth-child(3)').textContent.toLowerCase(); 
                        if (!funcaoSelecionado || funcaoInterv.includes(funcaoSelecionado)) {
                            item.style.display = ''; //mostra os intervenientes por pais
                        } else {
                            item.style.display = 'none'; //ocultar os intervenientes que nao sao do pais selecionado
                        }
                    });
                });
        </script>

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

        </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
