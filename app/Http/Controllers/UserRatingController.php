<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRating;

class UserRatingController extends Controller
{
    //
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_filme' => 'required|integer', //id do filme
            'id' => 'required|integer', //id do user
            'user_rating' => 'required|integer|between:1,10', //rating do user
        ]);

        $rating = new UserRating();
        $rating->id_filme = $validatedData['id_filme'];
        $rating->id = $validatedData['id'];
        $rating->user_rating = $validatedData['user_rating'];
        $rating->save();

        //atualizar a média dos votos do filme após a inserção da classificação
        $averageRating = $this->calculateAverageRating($validatedData['id_filme']);
        
        return redirect() -> route('filme.index');
    }

    private function calculateAverageRating($id_filme)
    {
        //lógica para calcular a média dos votos do filme
        $averageRating = UserRating::where('id_filme', $id_filme)->avg('user_rating');

        //atualizar a tabela tb_users_rating com a nova média
        $userRatingEntry = UserRating::where('id_filme', $id_filme)->first();
        $userRatingEntry->media_votos = $averageRating;
        $userRatingEntry->save();

        return $averageRating;
    }
}
