<?php

namespace App\Http\Controllers;

use App\Models\ingredients;
use App\Models\recipes;
use App\Models\categories;
use App\Models\instructions;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function toggleFavorite(Request $request)
    {
        $recipeId = $request->input('recipeId');
        $user = auth()->user();
    
        $recipe = Recipe::findOrFail($recipeId);
    
        if ($user->favoriteRecipes()->where('recipe_id', $recipeId)->exists()) {
            $user->favoriteRecipes()->detach($recipeId);
            $message = 'Recipe removed from favorites.';
        } else {
            $user->favoriteRecipes()->attach($recipeId);
            $message = 'Recipe added to favorites.';
        }
    
        return response()->json(['message' => $message]);
    }
}
