<?php

namespace App\Http\Controllers;
use App\Models\ingredients;
use App\Models\recipes;
use App\Models\categories;
use App\Models\instructions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(Request $request){
        $categories=categories::all();

        $searchTerm = $request->input('term');
    $query = recipes::query()->with('category');

    if (!empty($searchTerm)) {
        $query->where('title', 'like', '%'.$searchTerm.'%');
    }

    $recipes = $query->paginate(30);

        return view('welcome',compact('recipes','categories'));
    }
    public function dashboard(){
        $categories=categories::all();
        $recipes=recipes::with('category')->paginate(30);
        return view('dashboard',compact('recipes','categories'));
    }

    public function viewrecipe($id){

        $recipe = recipes::with('ingredients', 'category')->findorfail($id);

        return view('mainviews.recipeview',compact('recipe'));
    }

    public function viewcategory($id){
        $types=categories::all();
        $category = categories::findOrFail($id);
        $recipes = $category->recipe;

        return view('mainviews.categoryview',compact('recipes','category','types'));
    }

    
    public function aboutus(){
        $categories=categories::all();
        return view('AboutUs',compact('categories'));
    }

}
