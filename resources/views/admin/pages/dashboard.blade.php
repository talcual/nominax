@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if(Auth::user()->level == 'admin')
                        <a href="{{ route('admin.usuarios') }}" class="btn btn-primary">Administrar Usuarios</a>
                        <a href="{{ route('admin.planillas') }}" class="btn btn-primary">Planillas</a>
                    @else
                        <a href="{{ route('admin.planillas') }}" class="btn btn-primary">Registrar Nomina</a>
                        <a href="{{ route('admin.empleados') }}" class="btn btn-primary">Empleados</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
