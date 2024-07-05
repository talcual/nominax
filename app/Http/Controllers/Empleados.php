<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Empleado;

class Empleados extends Controller
{


    public function __construct(){

    }


    public function index(Request $request){
        $empleados = Empleado::where(['estado' => 'active', 'owner' => Auth::user()->id])->get();
        return view('admin.pages.empleados', compact('empleados'));
    }


    public function create(Request $request){

        if(!$request->id){
            $empleado = new Empleado();
            $empleado->nombres   = $request->nombres;
            $empleado->tipo_pago = $request->tipo_pago;
            $empleado->tasa_pago = $request->tasa_pago;
            $empleado->owner     = Auth::user()->id;
            $empleado->save();

            return back()->with('msg','Empleado creado con exito');
        }else{
            $this->update($request);
            return back()->with('msg','Empleado actualizado con exito');
        }

    }

    public function update(Request $request){
        $empleado = Empleado::where(['id' => $request->id])->first();
        $empleado->nombres   = $request->nombres;
        $empleado->tipo_pago = $request->tipo_pago;
        $empleado->tasa_pago = $request->tasa_pago;
        $empleado->save();
    }

    public function delete(Request $request){
        $empleado = Empleado::where(['id' => $request->id])->first();
        $empleado->estado = 'deleted';
        $empleado->save();

        return back()->with('msg','Empleado deshabilitado');
    }

}
