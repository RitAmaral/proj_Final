<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interveniente;
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
}
