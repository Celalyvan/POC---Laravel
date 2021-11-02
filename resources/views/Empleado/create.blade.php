@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/empleado')}}" method="post" enctype="multipart/form-data">
@csrf <!--imprime una llave de seguridad al momento de enviar la info-->
    <br>
    @include('Empleado.form', ['modo'=>'Crear'])
    <!--
    <label for="Nombre">Nombre</label>
    <input type="text" name="Nombre"  id=""><br>

    <label for="ApellidoPaterno">Apellido Paterno</label>
    <input type="text" name="ApellidoPaterno"  id=""><br>

    <label for="ApellidoMaterno">Apellido Materno</label>
    <input type="text" name="ApellidoMaterno"  id=""><br>

    <label for="Correo">Correo</label>
    <input type="text" name="Correo"  id=""><br>
    
    <input type="file" name="Fotografia" id="" ><br>

    <input type="submit" value="send data">
    -->

</form>
</div>
@endsection