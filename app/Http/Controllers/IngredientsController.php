<?php

namespace App\Http\Controllers;
use App\Models\ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\categories;

class IngredientsController extends Controller
{
    //
    public function index(){
        $categories=categories::all();
        if(Gate::denies('admin')){
            abort(403);
        }
        $url=url('/ingredientform');
        $ingredient=new ingredients;
        $title="Registration";
        $data=compact('url','title','ingredient');
        return view('Forms.ingredientform')->with($data);
    }
    public function register(Request $request){

        $ingredient = new ingredients;
        $ingredient->name=$request['ingredient'];
        $ingredient->save();
        return redirect('/ingredienttable');

    }
    public function view(){
        $categories=categories::all();
        if(Gate::denies('admin')){
            abort(403);
        }
        $ingredient=ingredients::all();
        $data=compact('ingredient','categories');
        return view('tables.IngredientsTable')->with($data);

    }

    public function delete($id){
        $ingredient=ingredients::find($id);
        if(!is_null($ingredient)){
            $ingredient->delete();
        }
            return redirect()->back();
    }

    public function edit($id){
        $categories=categories::all();
        if(Gate::denies('admin')){
            abort(403);
        }
        $ingredient=ingredients::find($id);
        if(is_null($ingredient)){
                return redirect('ingredientview');
        }
        else{
            $url=url('/ingredient/update')."/".$id;
            $title="Update";
            $data=compact('ingredient','url','title');
            return view('Forms.ingredientForm')->with($data);

        }
    }
    public function update($id,Request $request){
        $ingredient=ingredients::find($id);
        $ingredient->name=$request['ingredient'];
        
        $ingredient->save();
        return redirect('/ingredienttable');
    }
}
