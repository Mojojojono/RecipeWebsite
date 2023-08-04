<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ingredients;
use App\Models\recipes;
use App\Models\categories;
use App\Models\instructions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //

    public function index(){
        $url=url('/userform');
        $user=new User;
        $title="Registration";
        $data=compact('url','title','user');
        return view('Forms.Userform')->with($data);
    }
    public function register(Request $request){

        $user = new User;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->role_id=$request['role'];

        $user->password=md5($request['password']);
        $user->save();
        return redirect('/usertable');

    }
    public function view(){
        $user=User::all();
        $categories=categories::all();
        $data=compact('user','categories');
        return view('tables.UserTable')->with($data);

    }

    public function delete($id){
        $user=User::find($id);
        if(!is_null($user)){
            $user->delete();
        }
            return redirect()->back();
    }

    public function edit($id){
        $user=User::find($id);
        if(is_null($user)){
                return redirect('userview');
        }
        else{
            $url=url('/user/update')."/".$id;
            $title="Update";
            $data=compact('user','url','title');
            return view('Forms.UserForm')->with($data);

        }
    }
    public function update($id,Request $request){
        $user=User::find($id);
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->save();
        return redirect('/usertable');
    }

}
