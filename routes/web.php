<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Empleados;
use App\Http\Controllers\Planillas;
use App\Http\Controllers\Usuarios;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::name('admin.')->prefix('admin')->group(function () {
    
    Route::get('login',[AuthController::class,'login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', function () {
        return view('admin.pages.dashboard');
    })->name('admin.dashboard')->middleware('auth:sanctum');

    Route::get('/', function(){
        return redirect('/admin/dashboard');
    });
    
    Route::get('planillas', [Planillas::class, 'index'])->name('planillas')->middleware('auth:sanctum');
    Route::post('crear_planilla', [Planillas::class, 'create'])->name('create.planilla')->middleware('auth:sanctum');
    Route::get('delete_planilla/{id}', [Planillas::class, 'delete'])->name('delete.planilla')->middleware('auth:sanctum');

    Route::post('add_empleado_planilla', [Planillas::class, 'addEmpleado'])->name('agregar.empleado.planilla')->middleware('auth:sanctum');
    Route::get('ver_planilla/{planilla}', [Planillas::class, 'viewPlanilla'])->name('ver.planilla')->middleware('auth:sanctum');
    Route::post('update_planilla', [Planillas::class, 'changeEstado'])->name('update.estado.planilla')->middleware('auth:sanctum');


    Route::get('empleados', [Empleados::class, 'index'])->name('empleados')->middleware('auth:sanctum');
    Route::post('crear_empleado', [Empleados::class, 'create'])->name('create.empleado')->middleware('auth:sanctum');
    Route::post('delete_empleado/{id}', [Empleados::class, 'delete'])->name('delete.empleado')->middleware('auth:sanctum');

    Route::get('usuarios', [Usuarios::class, 'index'])->name('usuarios')->middleware('auth:sanctum');
    Route::post('crear_usuario', [Usuarios::class, 'addUser'])->name('create.usuario')->middleware('auth:sanctum');
    Route::get('delete_usuario/{id}', [Usuarios::class, 'delete'])->name('delete.usuario')->middleware('auth:sanctum');


});


Auth::routes(); 

