@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Acciones') }}</div>
                <div class="card-body p-1">
                    <ul class="list-group list-group-flush menu-actions">
                        <li class="list-group-item" onclick="clearForm();" data-bs-toggle="modal" data-bs-target="#agregar_usuario">Agregar usuario</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usuarios') }}</div>
                <div class="card-body p-1">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @if($usuarios)
                             @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->level }}</td> 
                                    <td>
                                        <button class="btn btn-primary" onclick="setupdate({{ json_encode($usuario) }})" data-bs-toggle="modal" data-bs-target="#crear_usuario">editar</button>
                                        <a class="btn btn-danger" href="{{ route('admin.delete.usuario',[$usuario->id]) }}">borrar</button>
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


<div class="modal fade" id="agregar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>    
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.create.usuario') }}" id="create_empleado_form">
            @csrf
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="name" id="nombres">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>

            <div class="mb-3">
                <label for="tipo_pago" class="form-label">Level</label>
                <select name="level" class="form-control" id="tipo_pago">
                    <option selected=selected>Seleccionar tipo de usuario</option>
                    <option value="admin">Admin</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tasa" class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="password" id="tasa" >
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
