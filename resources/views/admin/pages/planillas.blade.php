@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Acciones') }}</div>
                <div class="card-body p-1">
                    <ul class="list-group list-group-flush menu-actions">
                        @if(Auth::user()->level != 'admin')
                            <li class="list-group-item" onclick="clearForm();" data-bs-toggle="modal" data-bs-target="#crear_empleado">Crear planilla</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Planillas') }}</div>
                <div class="card-body p-1">
                
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Salario Bruto</th>
                                <th>Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @if($planillas)
                            @foreach($planillas as $planilla)
                                <tr>
                                    <td>{{ $planilla->id }}</td>
                                    <td>{{ $planilla->fecha_verificacion }}</td>
                                    <td>{{ $planilla->salario_bruto }}</td>
                                    <td>
                                        @if(Auth::user()->level != 'admin')
                                            <button class="btn btn-primary" onclick="addEmpleado({{ json_encode($planilla) }})" data-bs-toggle="modal" data-bs-target="#addToPlanilla">Add Empleados</button>
                                            <button class="btn btn-success" onclick="verPlanilla({{ $planilla->id }});"> ver planilla </button>
                                            <a class="btn btn-danger" href="{{ route('admin.delete.planilla',[$planilla->id]) }}">borrar</button>
                                        @else
                                            <button class="btn btn-success" onclick="verPlanilla({{ $planilla->id }});"> ver planilla </button>
                                        @endif

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
        <form method="POST" action="{{ route('admin.create.planilla') }}" id="create_planilla_form">
            @csrf
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha Validación</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
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


<div class="modal fade" id="addToPlanilla" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar empleado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.agregar.empleado.planilla') }}" id="add_planilla_form">
            @csrf

            <div class="mb-3">
                <label for="planilla" class="form-label">Planilla #</label>
                <input type="text" class="form-control" name="id" id="planilla" readonly>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Seleccionar Empleado</label>
                <select name="empleado" class="form-control">
                    @if($empleados)
                        <option></option>
                        @foreach($empleados as $empleado)
                            <option value="{{$empleado->id}}">{{$empleado->nombres}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="horas" class="form-label">Horas trabajadas</label>
                <input type="text" class="form-control" name="horas" id="horas" required>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>  



<div class="modal fade" id="planillaView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Planilla #<span id="number_planilla"></span></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="planilla_body">

      </div>
    </div>
  </div>
</div> 


<script>

    const myModal = new bootstrap.Modal('#planillaView', {
        keyboard: false
    })

    function addEmpleado(planilla){
        document.querySelector('#add_planilla_form').reset();
        document.querySelector('#planilla').value = planilla.id;
    }

    function clearForm(){
        document.querySelector('#create_empleado_form').reset();
    }


    async function verPlanilla(planilla){

        var url = "{{ route('admin.ver.planilla',[""]) }}/"+planilla;


        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const html = await response.text();

            document.querySelector('#number_planilla').innerText = planilla;
            document.querySelector('#planilla_body').innerHTML = html;

            myModal.show();


        } catch (error) {
            console.error(error.message);
        }

    }

</script>


@endsection
