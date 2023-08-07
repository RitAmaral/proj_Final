<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{{ asset('icons/movieicon.png') }}"> <!-- icon do website-->

        <title>Filmes Homepage</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Styles -->
        <style>

            body{
                /*background-color: #A9AAF7; */
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

            /* Design do icon da homepage */
            .icon {
                width: 24px; /* Defina a largura do icon */
                height: 24px; /* Defina a altura do icon */
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

            /* Design do hover2 / quando passamos por cima das rows da tabela */ 
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
                background-color: white;
                color: #C960A5;
            }

            /* Botao voltar ao topo */
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
                    <h1>A nossa base de dados de filmes</h1>
                </center>

                <br>

                <!-- form para pesquisar pelo titulo do filme -->
                <center>
                    <label for="pesquisar" style="margin: 10px;">Pesquisar:</label>
                    <input type="text" id="searchInput" placeholder="Pesquisar filmes..."  style="width: 400px;"> 
                </center>

                <br>
                <center>
                        <!-- form para ordenar titulo por ASC e DESC -->
                        <form id="ordenarForm" style="display: inline;">
                            <label for="ordenacao">Título:</label>
                            <select name="ordenacao" id="ordenacao">
                                <option value="asc">A-Z ↑</option>
                                <option value="desc">A-Z ↓</option>
                            </select>
                        </form>

                        <!-- form para ordenar ano por ASC e DESC -->
                        <form id="ordenarFormAno" style="display: inline;">
                            <label for="ordenacaoAno">Ano:</label>
                            <select name="ordenacaoAno" id="ordenacaoAno">
                                <option value="asc">Ano ↑</option>
                                <option value="desc">Ano ↓</option>
                            </select>
                        </form>

                        <!-- form para ordenar filmes por rating IMDb ASC e DESC -->
                        <form id="ordenarFormRating" style="display: inline;">
                            <label for="ordenacaoRating">IMDb Rating:</label>
                            <select name="ordenacaoRating" id="ordenacaoRating">
                                <option value="asc">⭐ ↑</option>
                                <option value="desc">⭐ ↓</option>
                            </select>
                        </form>

                        <!-- form para ordenar filmes por user rating ASC e DESC -->
                        <form id="ordenarUserRating" style="display: inline;">
                            <label for="userRating">User Rating:</label>
                            <select name="userRating" id="userRating">
                                <option value="asc">⭐ ↑</option>
                                <option value="desc">⭐ ↓</option>
                            </select>
                        </form>

                        <!-- form para filtrar filmes por género -->
                        <form id="filtrarPorGeneroForm" style="display: inline;">
                            <label for="genero">Género:</label>
                            <select name="genero" id="genero">
                                <option value="">Todos</option>
                                @foreach ($generos->unique('genero') as $genero) <!-- unique é para o nome do genero aparecer apenas 1x -->
                                    <option value="{{ $genero->genero }}">{{ $genero->genero }}</option>
                                @endforeach
                            </select>
                        </form>

                        <br>
                        
                        <!-- form para filtrar filmes por plataforma -->
                        <form id="filtrarPorPlataformaForm" style="display: inline;">
                            <label for="plataforma">Plataforma:</label>
                            <select name="plataforma" id="plataforma">
                                <option value="">Todos</option>
                                @foreach ($plataformas as $plataforma)
                                    <option value="{{ $plataforma->plataforma }}">{{ $plataforma->plataforma }}</option>
                                @endforeach
                            </select>
                        </form>

                        <!-- form para filtrar filmes por classificação etária -->
                        <form id="filtrarPorClassificacaoForm" style="display: inline;">
                            <label for="classificacao">Classificação:</label>
                            <select name="classificacao" id="classificacao">
                                <option value="">Todos</option>
                                @foreach ($classificacoes as $classificacao)
                                    <option value="{{ $classificacao->classificacao }}">{{ $classificacao->classificacao }}</option>
                                @endforeach
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
                </center>

                
                <!-- tabela de filmes -->
                <center>
                    <br>
                    <a type='button' class="btn add pulser" href="{{route('filme.create')}}">Adicionar Filme</a>
                    <br><br>
                    <table class="table">
                        <thead>
                            <tr class="hover">
                            <th scope="col">Título 🎥</th>
                            <th scope="col">Ano 📅</th>
                            <th scope="col">Classificação</th>
                            <th scope="col">País 🌍</th>
                            <th scope="col">Plataforma</th>
                            <th scope="col">Género</th>
                            <th scope="col">IMDb Rating ⭐</th>
                            <th scope="col">User Rating ⭐</th>
                            <th scope="col">IMDb</th>
                            <th colspan=3><center>Ações</th></center>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filmes as $filme) 
                                <tr class="hover2 filme-item">
                                <td>{{ $filme->titulo }}</td>
                                <td class="filme-ano">{{ $filme->ano }}</td>
                                <td>{{ $filme->classificacao }}</td>
                                <td>{{ $filme->pais }}</td>                               
                                <td>{{ $filme->plataforma }}                             
                                </td>
                                <td>
                                @if (isset($filmesComGeneros[$filme->id_filme]))
                                    @foreach ($filmesComGeneros[$filme->id_filme] as $genero)
                                        {{ $genero }} <br>
                                    @endforeach
                                @endif
                                </td>
                                <td class="filme-rating">{{ $filme->rating }}</td> <!-- imdb rating -->
                                <td class="user-rating">
                                    @if ($filme->averageUserRating !== null)
                                        {{ number_format($filme->averageUserRating, 1) }} <!-- average rating do user com uma casa decimal -->
                                    @else
                                        <p>0.0</p> <!-- se nao tiver ratings colocar 0.0 -->
                                    @endif
                                </td>    
                                <td><a href="{{ $filme->link_imdb }}" target="_blank" class="imdbbutton">IMDb</a></td>
                                <td>
                                    <a type='button' class="btn btn-success" href="{{ route('filme.show', $filme->id_filme)}}">🛈</a> <!--ir à route, e está lá user.show; buscar aos users o id-->
                                </td>
                                @if(auth()->check() && auth()->user()->role === 'admin') <!-- só admins têm acesso a editar e eliminar-->
                                    <td>
                                        <a type='button' class="btn btn-primary" href="{{ route('filme.edit', $filme->id_filme)}}">✏️</a>
                                    </td>
                                    <td>
                                        <form action ="{{ route('filme.delete', $filme->id_filme)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="submit" class="btn btn-danger" value="⛌">
                                        </form>
                                    </td>       
                                @endif                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </center>
                <br>
        </div>
            <a type='button' href="#top" class="topo">↑</a> <!-- botão voltar ao topo-->


            <!-- Javascript - necessário para a pesquisa de filmes por titulo ir diminuindo os filmes presentes na tabela -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('searchInput');
                    const filmeItems = document.querySelectorAll('.filme-item'); //obter todas as linhas da tabela com a classe 'filme-item'

                    searchInput.addEventListener('input', function (event) {
                        const searchTerm = event.target.value.trim().toLowerCase();

                        //mostra apenas as linhas da tabela que correspondem à pesquisa
                        filmeItems.forEach(item => {
                            const titulo = item.querySelector('td:nth-child(1)').textContent.toLowerCase();
                            if (titulo.includes(searchTerm)) {
                                item.style.display = ''; //exibir a linha
                            } else {
                                item.style.display = 'none'; //ocultar a linha
                            }
                        });
                    });
                });
            </script>

            <!-- Javascript - necessário para ordenar filmes por titulo ASC e DESC -->
            <script>
                document.getElementById('ordenacao').addEventListener('change', function () {
                    const ordenacao = this.value;
                    const filmes = Array.from(document.querySelectorAll('.filme-item'));

                    filmes.sort(function (a, b) {
                        const tituloA = a.querySelector('td:nth-child(1)').textContent.toLowerCase();
                        const tituloB = b.querySelector('td:nth-child(1)').textContent.toLowerCase();

                        if (ordenacao === 'asc') {
                            return tituloA.localeCompare(tituloB);
                        } else {
                            return tituloB.localeCompare(tituloA);
                        }
                    });

                    const table = document.querySelector('.table tbody');
                    filmes.forEach(filme => table.appendChild(filme));
                });
            </script>

            <!-- Javascript - necessário para ordenar ano por ASC e DESC -->
            <script>
                document.getElementById('ordenacaoAno').addEventListener('change', function () {
                    const ordenacaoAno = this.value;
                    const filmes = Array.from(document.querySelectorAll('.filme-item'));

                    filmes.sort(function (a, b) {
                        const anoA = parseFloat(a.querySelector('.filme-ano').textContent);
                        const anoB = parseFloat(b.querySelector('.filme-ano').textContent);

                        if (ordenacaoAno === 'asc') {
                            return anoA - anoB; //ordena por menor
                        } else {
                            return anoB - anoA; //ordena por maior
                        }
                    });

                    const table = document.querySelector('.table tbody');
                    filmes.forEach(filme => table.appendChild(filme));
                });
            </script>

            <!-- Javascript - necessário para ordenar filmes por imdb rating ASC e DESC -->
            <script>
                document.getElementById('ordenacaoRating').addEventListener('change', function () {
                    const ordenacao = this.value;
                    const filmes = Array.from(document.querySelectorAll('.filme-item'));

                    filmes.sort(function (a, b) {
                        const ratingA = parseFloat(a.querySelector('.filme-rating').textContent);
                        const ratingB = parseFloat(b.querySelector('.filme-rating').textContent);

                        if (ordenacao === 'asc') {
                            return ratingA - ratingB; //ordena por menor rating (ASC)
                        } else {
                            return ratingB - ratingA; //ordena por maior rating (DESC)
                        }
                    });

                    const table = document.querySelector('.table tbody');
                    filmes.forEach(filme => table.appendChild(filme));
                });
            </script>

            <!-- Javascript - necessário para ordenar filmes por user rating ASC e DESC -->
            <script>
                 document.getElementById('ordenarUserRating').addEventListener('change', function () {
                    const ordenacaoUserRating = this.value; // verifique se o nome da variável está correto

                    const ufilmes = Array.from(document.querySelectorAll('.filme-item'));

                    ufilmes.sort(function (a, b) {
                        const uratingA = parseFloat(a.querySelector('.user-rating').textContent);
                        const uratingB = parseFloat(b.querySelector('.user-rating').textContent);

                        if (ordenacaoUserRating === 'asc') {
                            return uratingA - uratingB; // ordena por menor rating (ASC)
                        } else {
                            return uratingB - uratingA; // ordena por maior rating (DESC)
                        }
                    });

                    const table = document.querySelector('.table tbody');
                    ufilmes.forEach(filme => table.appendChild(filme));
                });
            </script>

            <!-- Javascript - necessário para selecionar filmes por género -->
            <script>
                document.getElementById('filtrarPorGeneroForm').addEventListener('change', function () { //change faz com que seja logo alterado após clicado
                    event.preventDefault();
                    const generoSelecionado = document.getElementById('genero').value.trim().toLowerCase();
                    const filmeItems = document.querySelectorAll('.filme-item');

                    filmeItems.forEach(item => {
                        const generosFilme = item.querySelector('td:nth-child(6)').textContent.toLowerCase();
                        if (!generoSelecionado || generosFilme.includes(generoSelecionado)) {
                            item.style.display = ''; //mostra os filmes com o genero correspondente os genero selecionado
                        } else {
                            item.style.display = 'none'; //oculta o filme caso o genero do filme não corresponda ao genero selecionado
                        }
                    });
                });
            </script>

            <!-- Javascript - necessário para selecionar filmes por plataforma -->
            <script>
                document.getElementById('filtrarPorPlataformaForm').addEventListener('change', function () {
                    event.preventDefault();
                    const plataformaSelecionada = document.getElementById('plataforma').value.trim().toLowerCase();
                    const filmeItems = document.querySelectorAll('.filme-item');

                    filmeItems.forEach(item => {
                        const plataformasFilme = item.querySelector('td:nth-child(5)').textContent.toLowerCase(); 
                        if (!plataformaSelecionada || plataformasFilme.includes(plataformaSelecionada)) {
                            item.style.display = ''; //mostra os filmes com plataforma do filme correspondente à plataforma selecionada
                        } else {
                            item.style.display = 'none'; //ocultar o filme caso a plataforma do filme não corresponda à plataforma selecionada
                        }
                    });
                });
            </script>

            <!-- Javascript - necessário para selecionar filmes por classificação etária -->
            <script>
                document.getElementById('filtrarPorClassificacaoForm').addEventListener('change', function () {
                    event.preventDefault();
                    const classificacaoSelecionada = document.getElementById('classificacao').value.trim().toLowerCase();
                    const filmeItems = document.querySelectorAll('.filme-item');

                    filmeItems.forEach(item => {
                        const classificacoesFilme = item.querySelector('td:nth-child(3)').textContent.toLowerCase(); 
                        if (!classificacaoSelecionada || classificacoesFilme.includes(classificacaoSelecionada)) {
                            item.style.display = ''; //mostra os filmes com classificacao do filme correspondente à classificacao selecionada
                        } else {
                            item.style.display = 'none'; //ocultar o filme caso a classificacao do filme não corresponda à classificacao selecionada
                        }
                    });
                });
            </script>

            <!-- Javascript - necessário para selecionar filmes por pais -->
            <script>
                document.getElementById('filtrarPorPaisForm').addEventListener('change', function () {
                    event.preventDefault();
                    const paisSelecionado = document.getElementById('pais').value.trim().toLowerCase();
                    const filmeItems = document.querySelectorAll('.filme-item');

                    filmeItems.forEach(item => {
                        const paisesFilme = item.querySelector('td:nth-child(4)').textContent.toLowerCase(); 
                        if (!paisSelecionado || paisesFilme.includes(paisSelecionado)) {
                            item.style.display = ''; //mostra os filmes do pais selecionado
                        } else {
                            item.style.display = 'none'; //oculta os filmes que nao sao do país selecionado
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
