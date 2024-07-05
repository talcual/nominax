<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class Usuarios extends Controller
{
    public function __construct(){

    }


    public function index(){
        $usuarios = User::all();
        return view('admin.pages.usuarios', compact('usuarios'));
    }

    public function addUser(Request $request){
        try {
            User::create([
                'name'      =>  $request->name,
                'email'     =>  $request->email,
                'password'  =>  Hash::make($request->password),
                'level'     =>  $request->level
            ]);
            
            return back()->with('msg','Usuario creado con exito');  

        } catch (\Throwable $th) {
            return back()->with('msg','Falla al crear usuario.');
        }

    }

}
