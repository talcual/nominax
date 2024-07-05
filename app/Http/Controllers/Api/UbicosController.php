<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ubicos;

class UbicosController extends Controller
{

    public function list(){

    }

    public function mapa(Request $request){
        return view('admin.pages.mapa');
    }

}
