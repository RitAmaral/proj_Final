<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    // Comentario controller necessário para users criarem comentarios e para que sejam armazenados na base de dados e exibidos nos detalhes de filmes e perfil do user
    public function index($id_filme)
    {
        $comentarios = DB::table('tb_comentarios')
            ->where('id_filme', $id_filme)
            ->get();
        return view('comentarios.index', compact('comentarios'));
    }

    //exibir o formulário de criação de comentários
    public function create($id_filme)
    {
        return view('comentarios.create', compact('id_filme'));
    }

    //armazenar o comentário na base de dados
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $id_filme = $request->input('id_filme');
            $comentario = $request->input('comentario');

            //aalvar o comentário na base de dados
            Comentario::create([
                'comentario' => $comentario,
                'id_filme' => $id_filme,
                'id' => $user->id,
            ]);

            //redirecionar para a página do filme
            return redirect()->route('filme.show', $id_filme)->with('success', 'Comentário adicionado com sucesso!');
        } else {
            //user não tem login feito, redirecionar para a página de login
            return redirect()->route('login')->with('error', 'Precisa de fazer login para adicionar um comentário.');
        }
    }
}
