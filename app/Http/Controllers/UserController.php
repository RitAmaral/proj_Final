<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //------Vamos criar uma variável: $user
        //o User a verde (em baixo) já estava feito (app->models->User.php)
        $users=User::get(); //---get ou all, colocam tudo
        return view ('user.users', [
            'users'=>$users
        ]); //---retornar view que está dentro da pasta views -> pasta user, na página users.blade.php  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //adicionar tem 2 funções, criar (create) e guardar (store) na base de dados
        return view ('user.users_create'); //user pasta, ficheiro users_create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\User\UserStoreRequest $request) //guarda na basa de dados; 2ªForma: o request valida os dados; como criamos pasta Request, trocar o nome para UserStoreRequest, e colocar o caminho onde ele UserStore está
    {
        /* //-------------------1ª Forma de Validação de dados--------a 2ª forma é criar pasta Request, e escrever isto no ficheiro criado na pasta Request----------
        $request->validate([
            'name'=>'string|required', //podemos escrever isto de 2 formas. Ou esta, ou a de baixo.
            //'name'=>['string','required']
            'email'=>'string|required|unique:users|email', //required = obrigatório, unique = único na base de dados da tabela users no campo email
            'password'=>'required|string|min:6|max:10'
        ]);
        */

        //criar variável data (de dados e não data)
        $data=$request->only(['name', 'email', 'password']);
        User::create($data); //Este User:: é o documento que está na app->http->models->User (lá tem os dados do User)
        return redirect() -> route('user.index'); //depois volta para a página index
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //procurar (find) pelo id
        $users=User::find($id);
        //dd($users); //------aparece a ficha do cliente se carregar no botão ver
        return view('user.users_show',
            ['user'=>$users]); //pasta view -> pasta user -> ficheiro users_show

        //----dd é uma janela; imprime no ecrã os dados
        //dd($id); //-----aparece o id se carregar no botão ver

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        //dd('estou aqui'); //para ver se o caminho funciona bem
        $users=User::find($id);
        //dd($users); //para ver se vai buscar os users
        return view('user.users_edit',
            ['user'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\User\NewUserUpdateRequest $request, string $id)
    {
        //
        //criar variável data de dados; requisitos vem do outro lado
        $data=$request -> only(['name', 'email']);
        //dd($data);
        $user=User::find($id); //usar $user pq é só um utilizador
        $user->update($data);

        //return redirect() ->back(); //depois de gravar, volta para trás. 
        return redirect() ->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //dd('cheguei aqui');
        $user=User::find($id); //vai buscar e destruir o user que clicarmos com o id correspondente
        $user->delete();
        return redirect() -> route('user.index');
    }

    //método necessário para exibir a página do perfil
    public function perfil()
    {
        // Obter o utilizador logado
        $user = Auth::user();

        // Obter os comentários do utilizador para os filmes
        $comentarios = Comentario::where('id', $user->id)->get();

        return view('user.perfil', compact('user', 'comentarios'));
    }
}
