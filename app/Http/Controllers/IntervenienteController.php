<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interveniente;
use App\Models\IntervPreferido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Filme; //importar


class IntervenienteController extends Controller
{
    //
    public function index()
    {
        $intervenientes = DB::table('tb_intervenientes')
            ->select(
                'tb_intervenientes.id_interveniente',
                'tb_intervenientes.interveniente',
                'tb_paises.pais'
            )
            ->join('tb_paises', 'tb_intervenientes.id_pais', '=', 'tb_paises.id_pais')
            ->orderBy('tb_intervenientes.interveniente', 'ASC')
            ->get();

        $detailsIntervenientes = DB::table('tb_detalhesfilmes')
            ->select(
                'tb_intervenientes.id_interveniente',
                'tb_intervenientes.interveniente',
                'tb_funcoes.funcao'
            )
            ->join('tb_intervenientes', 'tb_detalhesfilmes.id_interveniente', '=', 'tb_intervenientes.id_interveniente')
            ->join('tb_detalhes', 'tb_detalhesfilmes.id_interveniente', '=', 'tb_detalhes.id_interveniente')
            ->join('tb_funcoes', 'tb_detalhes.id_funcao', '=', 'tb_funcoes.id_funcao')
            ->get();

        $intervenientesData = [];
        foreach ($detailsIntervenientes as $interveniente) {
            $idInterveniente = $interveniente->id_interveniente;
            $funcao = $interveniente->funcao;

            if (!isset($intervenientesData[$idInterveniente])) {
                $intervenientesData[$idInterveniente] = [
                    'interveniente' => $interveniente->interveniente,
                    'funcao' => $funcao
                ];
            }
        }

        return view('interveniente.intervenientes', compact('intervenientes', 'intervenientesData'));
    }

    public function show(string $id_interveniente)
    {
        $interveniente = Interveniente::find($id_interveniente);
        $filmes = Filme::whereHas('intervenientes', function ($query) use ($id_interveniente) {
            $query->where('tb_intervenientes.id_interveniente', $id_interveniente);
        })->get();
        
        return view('interveniente.intervenientes_show', compact('interveniente', 'filmes'));
    }

    //método necessário para adicionar e exibir intervenientes preferidos no perfil
    public function adicionarIntervenientePreferido(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $id_interveniente = $request->input('id_interveniente');

            // Verifique se o ID do interveniente não é nulo antes de criar o interveniente preferido
            if (!empty($id_interveniente)) {
                IntervPreferido::create([
                    'id' => $user->id,
                    'id_interveniente' => $id_interveniente,
                ]);

                return redirect()->back()->with('success', 'Interveniente adicionado aos preferidos com sucesso!');
            } else {
                return redirect()->back()->with('error', 'ID do interveniente não especificado.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Precisa de fazer login para adicionar um interveniente preferido.');
        }
    }
}
