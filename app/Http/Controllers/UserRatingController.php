<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRating;
use App\Models\Filme;
use Illuminate\Support\Facades\Auth;

class UserRatingController extends Controller
{
    //guardar user rating
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_filme' => 'required|integer',
            'user_rating' => 'required|integer|between:1,10',
        ]);
    
        $id_filme = $validatedData['id_filme'];
        $user = Auth::user();
    
        // Verificar se o user já deu rating ao filme
        $existingRating = UserRating::where('id_filme', $id_filme)
                                    ->where('id', $user->id)
                                    ->first();
    
        if ($existingRating) {
            // Se já tiver dado rating, atualizar o rating que tinha dado
            $existingRating->user_rating = $validatedData['user_rating'];
            $existingRating->save();
        } else {
            // Dar o rating pela primeira vez
            $userRating = new UserRating();
            $userRating->id_filme = $id_filme;
            $userRating->id = $user->id;
            $userRating->user_rating = $validatedData['user_rating'];
            $userRating->save();
        }
    
        return redirect()->route('filme.index');
    }

}
