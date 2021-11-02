@extends('layouts.app')
@section('content')<!-- tiene un endsection al f no se pueden agregar los @ en comentarios xq los lee igual-->
<div class="container">
<!--estos 3 elementos agregan una interfaz de manejo de sesion + estetica que ya vienen configurados cuando se genero la interfaz por consola-->


@if(Session::has('mensaje')) <!--pregunta si la sesion viene con algun mensaje, si hay lo muestra-->

    <div class="alert alert-success alert-dismissible" role="alert">
    
        {{Session::get('mensaje')}}
      
        <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
            <span arial-hidden="true">&times;</span>
        </button>
        
    </div>
    
@endif

<a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo</a>
<br><br>
<table class="table table-dark">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Fotografia</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{$empleado->id}}</td>
            <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Fotografia }}" width="100" alt=""></td>
            
            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>  
            <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}" class="btn btn-warning">
            Editar
            </a>    
            
            |
            
            <form action="{{ url('/empleado/'.$empleado->id ) }}" method = "post" class="d-inline">
                @csrf
                {{method_field('DELETE')}}<!--cambia  el metodo de post a DELETE para que Laravel sepa a que metodo de la controladora derivar esta informacion-->
                <input type="submit" class="btn btn-danger"
                onclick="return confirm('desea borrar?')" value="Borrar">
            </form>
            </td>
        </tr>
        @endforeach  
    </tbody>
</table>
{!!$empleados->links()!!}
</div>
@endsection