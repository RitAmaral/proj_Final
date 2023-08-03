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
            background-color: #A9AAF7;
            padding: 10px;
            color: black;
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
            border: 2px solid #191970;
            border-radius: 5px;
            margin-right: 10px;
            padding: 7px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #191970;
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
            background-color: #191970;
            color: white;
        }

        h1{
            color: white;
            font-size: 40px;
            border-bottom: 2px solid white;
            padding: 10px;
        }

        /* Design do hover / quando passamos por cima do cabeçalho da tabela */ 
        .hover:hover{
            background-color:#FFF775;
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
            color: #191970;
            border-radius: 5px;
            font-size: 16px;
            border: 2px solid #191970;
        }
        
        .topo:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            text-decoration: none;
            background-color: #191970;
            color: white;
        }

        </style>
    </head>
    <body>
        <main>
        <div class="back">
            <a type="button" href="/" class="btnback">
                <i class="icon"></i>               
            </a>
        </div>

            <center>
                <h1>Os intervenientes da nossa base de dados de filmes</h1>
            </center>

            <br>

            <input type="text" id="searchInput" placeholder="Pesquisar intervenientes...">

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

            <center>
                <br>
                <table class="table">
                    <thead>
                        <tr class="hover">
                        <th scope="col">Interveniente 👤</th>
                        <th scope="col">País 🌍</th>
                        <th scope="col">Função</th>
                        <th scope="col">Ver 👀</th>
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
                            <a type='button' class="btn btn-success" href="{{ route('interveniente.show', $interveniente->id_interveniente)}}">Ver</a> 
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </center>
            <br>
            <a type='button' href="#top" class="topo">↑</a> <!-- botão voltar ao topo-->

        </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
