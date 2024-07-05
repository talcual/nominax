
<table class="table table-striped">
    <thead>
        <tr>
            <th>Empleado</th>
            <th>Horas Trabajadas</th>
            <th>Tasa</th>
            <th>Salario Bruto</th>
        </tr>
    </thead>
    <tbody>
        @if($registros)
            @foreach($registros as $registro)
                <tr>
                    <td>{{$registro->empleado->nombres}}</td>
                    <td>{{$registro->horas_trabajadas}}</td>
                    <td>{{$registro->tasa}}</td>
                    <td>{{$registro->salario_bruto}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>