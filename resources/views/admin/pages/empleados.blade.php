@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Acciones') }}</div>
                <div class="card-body p-1">
                    <ul class="list-group list-group-flush menu-actions">
                        <li class="list-group-item" onclick="clearForm();" data-bs-toggle="modal" data-bs-target="#crear_empleado">Crear empleado</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Empleados') }}</div>
                <div class="card-body p-1">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Tipo Pago</th>
                                <th>Tasa Pago</th>
                                <th>Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @if($empleados)
                             @foreach($empleados as $empleado)
                                <tr>
                                    <td>{{ $empleado->id }}</td>
                                    <td>{{ $empleado->nombres }}</td>
                                    <td>{{ $empleado->tipo_pago }}</td>
                                    <td>{{ $empleado->tasa_pago }}</td> 
                                    <td>
                                        <button class="btn btn-primary" onclick="setupdate({{ json_encode($empleado) }})" data-bs-toggle="modal" data-bs-target="#crear_empleado">editar</button>
                                        <a class="btn btn-danger" href="{{ route('admin.delete.empleado',[$empleado->id]) }}">borrar</button>
                                    </td>   
                                </tr>
                             @endforeach
                            @endif
                        </tbody>

                    </table>
                
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="crear_empleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Empleado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.create.empleado') }}" id="create_empleado_form">
            @csrf
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Pedro Perez">
            </div>
            <div class="mb-3">
                <label for="tipo_pago" class="form-label">Tipo pago</label>
                <select name="tipo_pago" class="form-control" id="tipo_pago">
                    <option selected=selected>Seleccionar tipo de pago</option>
                    <option value="horas">Horas</option>
                    <option value="minimo">Salario minimo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tasa" class="form-label">Tasa de pago</label>
                <input type="text" class="form-control" name="tasa_pago" id="tasa" placeholder="12.00">
            </div>

            <input type="hidden" name="id">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>  


<script>

function setupdate(empleado){
        document.querySelector('input[name=id]').value = empleado.id;
        document.querySelector('input[name=nombres]').value = empleado.nombres;
        document.querySelector('select[name=tipo_pago] option[value='+ empleado.tipo_pago +']').selected = true;
        document.querySelector('input[name=tasa_pago]').value = empleado.tasa_pago;
}

function clearForm(){
    document.querySelector('#create_empleado_form').reset();
}

</script>

@endsection
