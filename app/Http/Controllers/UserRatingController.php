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
        $user_id = auth()->id();
        $user_rating = $validatedData['user_rating'];
    
        $rating = new UserRating();
        $rating->id_filme = $id_filme;
        $rating->id = $user_id;
        $rating->user_rating = $user_rating;
        $rating->save();
    
        return redirect()->route('filme.index');
    }

}
