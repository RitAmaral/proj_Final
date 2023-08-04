<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme; //importar o Modelo Filme
use Illuminate\Support\Facades\DB; //importar
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $filmes = DB::table('tb_filmes')
        ->select(
            'tb_filmes.id_filme',
            'tb_filmes.titulo',
            'tb_filmes.ano',
            'tb_filmes.rating',
            'tb_paises.pais',
            'tb_classificacoes.classificacao',
            'tb_plataformas.plataforma',
            'tb_filmes.link_imdb'
        )
        ->join('tb_paises', 'tb_filmes.id_pais', '=', 'tb_paises.id_pais')
        ->join('tb_classificacoes', 'tb_filmes.id_classificacao', '=', 'tb_classificacoes.id_classificacao')
        ->join('tb_plataformas', 'tb_filmes.id_plataforma', '=', 'tb_plataformas.id_plataforma')
        ->orderBy('tb_filmes.rating', 'DESC')
        ->get();


        //tabelas tb_detalhesfilmes + tb_intervenientes + tb_funcoes:
        $detalhesIntervenientes = DB::table('tb_detalhesfilmes')
             ->select(
                'tb_intervenientes.interveniente',
                'tb_funcoes.funcao'
             )
             ->join('tb_intervenientes', 'tb_detalhesfilmes.id_interveniente', '=', 'tb_intervenientes.id_interveniente')
             ->join('tb_detalhes', 'tb_detalhesfilmes.id_interveniente', '=', 'tb_detalhes.id_interveniente')
             ->join('tb_funcoes', 'tb_detalhes.id_funcao', '=', 'tb_funcoes.id_funcao')
             ->get();
        
        //tabelas tb_filmesgeneros + tb_generos + tb_filmes:
        $filmesGeneros = DB::table('tb_filmesgeneros')
            ->select(
                'tb_filmes.id_filme',
                'tb_generos.genero'
            )
            ->join('tb_generos', 'tb_filmesgeneros.id_genero', '=', 'tb_generos.id_genero')
            ->join('tb_filmes', 'tb_filmesgeneros.id_filme', '=', 'tb_filmes.id_filme')
            ->get();

        //dd($filmes);

        $filmesComGeneros = [];
        foreach ($filmesGeneros as $filmeGenero) {
            $idFilme = $filmeGenero->id_filme;
            $genero = $filmeGenero->genero;
            if (!isset($filmesComGeneros[$idFilme])) {
                $filmesComGeneros[$idFilme] = [];
            }
            $filmesComGeneros[$idFilme][] = $genero;
        }
        
        $plataformas = DB::table('tb_plataformas')->get(); //criar esta variável, para passar para a view, onde vamos querer filtrar filmes por plataforma
        $classificacoes = DB::table('tb_classificacoes')->get(); //para filtrar por classificações
        $paises = DB::table('tb_paises')->get(); //para filtrar tb por paises
        $usersrating = DB::table('tb_users_rating')->get(); //para filtrar por user rating, com a média calculada embaixo 

        //calcular a média dos ratings dos users
        foreach ($filmes as $filme) {
            $id_filme = $filme->id_filme;
            $averageUserRating = DB::table('tb_users_rating')->where('id_filme', $id_filme)->avg('user_rating');
            $filme->averageUserRating = $averageUserRating;
        }
            
        //criar array associativo para passar todas as informações/variáveis para a view:
            $dados = [
                'filmes' => $filmes,
                'detalhesIntervenientes' => $detalhesIntervenientes,
                'filmesComGeneros' => $filmesComGeneros,
                'generos' => $filmesGeneros,
                'plataformas' => $plataformas,
                'classificacoes' => $classificacoes,
                'paises' => $paises,
                'usersrating' => $usersrating,
                'averageUserRating' =>  $averageUserRating,
            ];

        return view('filme.filmes', $dados);

        //return view('filme.filmes', ['filmes'=>$filmes]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //adicionar tem 2 funções, criar (create) e guardar (store) na base de dados
        return view ('filme.filmes_create'); //filme pasta, ficheiro filmes_create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\Filme\FilmeStoreRequest $request) //guarda na basa de dados; o request valida os dados; criar pasta Request, trocar o nome para FilmeStoreRequest, e colocar o caminho onde ele FilmeStore está
    {
        //
        //criar variável data (de dados e não data)
        $data=$request->only(['titulo', 'ano', 'id_classificacao', 'id_pais', 'id_plataforma', 'rating', 'link_imdb']);
        Filme::create($data); //Este Filme:: é o documento que está na app->http->models->Filme (lá tem os dados do Filme)
        return redirect() -> route('filme.index'); //depois volta para a página index
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_filme)
    {
        //tabelas tb_filmes + tb_paises + tb_classificacoes + tb_plataformas:
        $filmes = DB::table('tb_filmes')
            ->select(
                'tb_filmes.id_filme',
                'tb_filmes.titulo',
                'tb_filmes.ano',
                'tb_filmes.rating',
                'tb_paises.pais',
                'tb_classificacoes.classificacao',
                'tb_plataformas.plataforma',
                'tb_filmes.link_imdb',
                'tb_filmes.imagem'
            )
            ->join('tb_paises', 'tb_filmes.id_pais', '=', 'tb_paises.id_pais')
            ->join('tb_classificacoes', 'tb_filmes.id_classificacao', '=', 'tb_classificacoes.id_classificacao')
            ->join('tb_plataformas', 'tb_filmes.id_plataforma', '=', 'tb_plataformas.id_plataforma')
            ->where('id_filme', $id_filme)
            ->first();

        //tabelas tb_detalhesfilmes + tb_intervenientes + tb_funcoes:
        $detalhesIntervenientes = DB::table('tb_detalhesfilmes')
             ->select(
                'tb_intervenientes.interveniente',
                'tb_funcoes.funcao'
             )
             ->join('tb_intervenientes', 'tb_detalhesfilmes.id_interveniente', '=', 'tb_intervenientes.id_interveniente')
             ->join('tb_detalhes', 'tb_detalhesfilmes.id_interveniente', '=', 'tb_detalhes.id_interveniente')
             ->join('tb_funcoes', 'tb_detalhes.id_funcao', '=', 'tb_funcoes.id_funcao')
             ->where('tb_detalhesfilmes.id_filme', $id_filme)
             ->get();
        
        //tabelas tb_filmesgeneros + tb_generos + tb_filmes:
        $generos = DB::table('tb_filmesgeneros')
            ->select(
                'tb_generos.genero'
            )
            ->join('tb_generos', 'tb_filmesgeneros.id_genero', '=', 'tb_generos.id_genero')
            ->join('tb_filmes', 'tb_filmesgeneros.id_filme', '=', 'tb_filmes.id_filme')
            ->where('tb_filmesgeneros.id_filme', $id_filme)
            ->get();

        //dd($filmes);

        //para ver os comentarios dos users em cada filme
        $comentarios = DB::table('tb_comentarios')
            ->join('users', 'tb_comentarios.id', '=', 'users.id')
            ->where('tb_comentarios.id_filme', $id_filme)
            ->select('tb_comentarios.*', 'users.name')
            ->get();
        
        //para ver avg user rating em cada filme
        $usersrating = DB::table('tb_users_rating')
            ->join('users', 'tb_users_rating.id', '=', 'users.id')
            ->where('tb_users_rating.id_filme', $id_filme)
            ->select('tb_users_rating.*', 'user_rating')
            ->get();

            $averageRating = $this->calculateAverageRating($id_filme); //nota: a função calculateAverageRating está no fim desta página
            
        //criar array associativo para passar todas as informações para a view:
        $dados = [
            'filmes' => $filmes,
            'detalhesIntervenientes' => $detalhesIntervenientes,
            'generos' => $generos,
            'comentarios' => $comentarios,
            'usersrating' => $usersrating,
            'averageRating' => $averageRating,
        ];
        
        return view('filme.filmes_show', $dados);

        //para mostrar a imagem de cada filme:
        $filme = Filme::find($id_filme);

        //verificar se o user está logado
        $user = Auth::user();

        //formulário de classificação se o user estiver logado
        if ($user) {
            return view('filme.show', compact('filme'))->with('filme', 'user');
        } else {
            return view('filme.show', compact('filme'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_filme)
    {
        //
        $filme = Filme::find($id_filme);
        return view('filme.filmes_edit', ['filme' => $filme]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\Filme\FilmeUpdateRequest $request, string $id_filme)
    {
        //
        $filme = Filme::find($id_filme);
        $filme->update($request->all());
        return redirect()->route('filme.show', ['id_filme' => $filme->id_filme]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_filme)
    {
        //
        //funciona bem:
        $deleted = DB::table('tb_filmes')->where('id_filme', $id_filme)->delete();
        return redirect() -> route('filme.index'); //apos eliminar filme, volta à pagina de filmes

    }

    //criar função para fazer média do user rating em cada filme
    private function calculateAverageRating($id_filme)
    {
        //calcular a média dos ratings dos users em cada filme
        $averageRating = DB::table('tb_users_rating')
            ->where('id_filme', $id_filme)
            ->avg('user_rating');

        return number_format($averageRating, 1); //formata a média com uma casa decimal
    }
}
