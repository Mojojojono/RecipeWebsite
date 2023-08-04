<?php

namespace App\Http\Controllers;
use App\Models\ingredients;
use App\Models\recipes;
use App\Models\categories;
use App\Models\instructions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use Illuminate\Http\Request;


class RecipesController extends Controller
{
    //

    public function index(){

        if(Gate::denies('admin')){
            abort(403);
        }
        $url=url('/recipeform');
      $recipes=new recipes;
        return view('recipe.recipeform',compact('recipes'));

    }

    public function view(){
        if(Gate::denies('admin')){
            abort(403);
        }
        $ingredients=ingredients::all();
        $categories=categories::all();
        $recipes=new recipes;
       $url= url('/recipeform');

        return view('Forms.recipeform',compact('categories','url','ingredients','recipes'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Instructions' => 'required',
            'Prep_time' => 'required',
            'cook_time' => 'required',
            'servings' => 'required',
            'cover' => 'required|mimes:jpg,png|max:4048',
        ]);

        $prepTime = $request->input('Prep_time');
        $cookTime = $request->input('cook_time');
        $totalTime = $prepTime + $cookTime;
        
        $filename = time().'.'.$request->cover->extension();
        $request->cover->move('cover', $filename);
        // $request->cover->storeAs('cover', $filename);
        
        $recipe = recipes::create([
            'title' => $request['title'],
            'Description' => $request['description'],
            'Instructions' => $request['Instructions'],
            'Prep_time' => $request['Prep_time'],
            'cook_time' => $request['cook_time'],
            'total_time' => $totalTime,
            'servings' => $request['servings'],
            'cover' => $filename,
        ]);

        $categoryIds = $request->input('category');
        $recipe->category()->attach($categoryIds);

        $ingredients= collect($request->input('ingredients',[]))->map(function($ingredient){
            return ['quantity'=>$ingredient];
        });
        $recipe->ingredients()->sync($ingredients);

        
        return redirect()->route('recipeview')->with('success', 'Recipe Created successfully.');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(Gate::denies('admin')){
            abort(403);
        }
        $recipes = recipes::with('ingredients', 'category')->findorfail($id);
        $ingredients=ingredients::all();
        $categories=categories::all();

        if(is_null($recipes)){
                return redirect('/recipetable');
        }
        else{
            $url=url('/recipe/update')."/".$id;
            // $title="Update";
            $data=compact('recipes','url','categories','ingredients');
            return view('Forms.recipeform')->with($data);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'Instructions' => 'required',
            'Prep_time' => 'required',
            'cook_time' => 'required',
            'servings' => 'required',
            'cover' => 'nullable|mimes:jpg,png|max:4048',
        ]);
        
        $recipe = recipes::findOrFail($id);
        
        $prepTime = $request->input('Prep_time');
        $cookTime = $request->input('cook_time');
        $totalTime = $prepTime + $cookTime;
        
        // Update recipe fields
        $recipe->title = $request->title;
        $recipe->Description = $request->description;
        $recipe->Instructions = $request->Instructions;
        $recipe->Prep_time = $request->Prep_time;
        $recipe->cook_time = $request->cook_time;
        $recipe->total_time = $totalTime;
        $recipe->servings = $request->servings;
        
        // Update cover image if provided
        if ($request->hasFile('cover')) {
            $oldCover = $recipe->cover;
        
            if ($oldCover) {
                // Delete the old cover image
                $oldCoverPath = public_path('cover/' . $oldCover);
                if (File::exists($oldCoverPath)) {
                    File::delete($oldCoverPath);
                }
            }
        
            // Upload and move the new cover image
            $filename = time() . '.' . $request->cover->extension();
            $request->cover->move('cover', $filename);
        
            // Update the recipe's cover attribute with the new filename
            $recipe->cover = $filename;
        }
        $recipe->save();
        
        // Update categories
        $categoryIds = $request->input('category');
        $recipe->category()->sync($categoryIds);
        
        // Update ingredients
        $ingredients = collect($request->input('ingredients', []))->map(function ($ingredient) {
            return ['quantity' => $ingredient];
        });
        $recipe->ingredients()->sync($ingredients);
        
        return redirect()->route('recipeview')->with('success', 'Recipe updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recipe = recipes::findOrFail($id);

        if(!is_null($recipe)){
            if ($recipe->cover) {
                $coverPath = public_path('cover/' . $recipe->cover);
                if (File::exists($coverPath)) {
                    File::delete($coverPath);
                }
            }
        
            // Delete the recipe and its related data
            $recipe->category()->detach();
            $recipe->ingredients()->detach();
            $recipe->delete();
        
            return redirect()->route('recipeview')->with('success', 'Recipe deleted successfully');
             }
            return redirect()->back();

    }

    // public function index(){
    //     $url=url('/register');
    //     $customer=new customer;
    //     $title="Registration";
    //     $data=compact('url','title','customer');
    //     return view('form')->with($data);
    // }
    // public function register(Request $request){

    //     $customer = new Customer;
    //     $customer->Username=$request['name'];
    //     $customer->Email=$request['email'];
    //     $customer->password=md5($request['password']);
    //     $customer->save();
    //     return redirect('/customer/view');

    // }
    public function table(){

        if(Gate::denies('admin')){
            abort(403);
        }
        $categories=categories::all();
        $recipes=recipes::all();
        $data=compact('recipes','categories');
        return view('tables.recipetable')->with($data);

    }

    // public function delete($id){
    //     $customer=Customer::find($id);
    //     if(!is_null($customer)){
    //         $customer->delete();
    //     }
    //         return redirect()->back();
    // }

    
    // public function update($id,Request $request){
    //     $customer=Customer::find($id);
    //     $customer->Username=$request['name'];
    //     $customer->Email=$request['email'];
    //     $customer->save();
    //     return redirect('/customer/view');
    // }

    }

