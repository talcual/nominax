<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Planilla as PlanillaModel;
use App\Models\PlanillaBody;
use App\Models\Empleado;

class Planillas extends Controller
{
    public function __construct(){

    }


    public function index(Request $request){

        if(Auth::user()->level == 'admin'){
            $filter = [];
        }else{
            $filter = ['owner' => Auth::user()->id];
        }

        $planillas = PlanillaModel::where($filter)->get();
        $empleados = Empleado::where(['owner' => Auth::user()->id, 'estado' => 'active'])->get();

        return view('admin.pages.planillas', compact('planillas', 'empleados'));
    }

    public function create(Request $request){

        try {
            $planilla = new PlanillaModel();
            $planilla->fecha_verificacion = $request->fecha; 
            $planilla->salario_bruto      = 0;
            $planilla->owner              = Auth::user()->id;
            $planilla->estado             = 'Pendiente';
            $planilla->notas              = '';

            $planilla->save();

            return back()->with('msg','Planilla creada con exito');

        } catch (\Throwable $th) {
            return back()->with('msg','Error al crear la planilla');
        }

    }


    public function viewPlanilla(Request $request){
        $registros = PlanillaBody::where(['id_planilla' => $request->planilla])->with('empleado')->get();
        return view('admin.pages.componentPlanilla', compact('registros'));
    }


    public function addEmpleado(Request $request){
        
        $empleado = new PlanillaBody();
        $dataEmpleado = Empleado::where(['id' => $request->empleado])->first();
        $planilla = PlanillaModel::where(['id' => $request->id])->first(); 

        try {
            
            $empleado->id_planilla      = $request->id;
            $empleado->id_empleado      = $request->empleado;
            $empleado->horas_trabajadas = $request->horas;
            $empleado->tasa             = $dataEmpleado->tasa_pago;
            $empleado->salario_bruto    = ($dataEmpleado->tipo_pago == 'minimo') ? $dataEmpleado->tasa_pago : $request->horas * $dataEmpleado->tasa_pago;

            $planilla->salario_bruto += $empleado->salario_bruto;
            $planilla->save();
            
            $empleado->save();

            return back()->with('msg','Empleado agregado con exito.');

        } catch (\Throwable $th) {

            return back()->with('msg','Error al agregar a el empleado.'.$th);
        }


    }

}
