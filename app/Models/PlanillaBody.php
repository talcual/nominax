<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PlanillaBody extends Model
{
    use HasFactory;

    protected $table = 'planilla_body';


    public function empleado(): HasOne{
        return $this->hasOne(Empleado::class,'id', 'id_empleado');
    }

}
