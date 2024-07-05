<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('planilla_body', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilla');
            $table->integer('id_empleado');
            $table->integer('horas_trabajadas');
            $table->string('tasa');
            $table->integer('salario_bruto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
