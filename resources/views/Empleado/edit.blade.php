<!---->
@extends('layouts.app')

@section('content')



<div class="container">
<form action="{{url('/empleado/'.$empleado->id )}}" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data" encripta la informacion de la foto, consecuentemente NO  deben haber espacios en el string-->
@csrf

{{method_field('PATCH')}} <!--avisa que este formulario se va a enviar al metodo patch, necesario para alterar la informacion de este ID en la tabla-->

@include('Empleado.form', ['modo'=>'Editar'])<!--include('Empleado.form',[toda la informacion alocada aca va a ser enviada a la inclusion] ])  en este caso se envia informacion con un array asociativo donde seria 'identificador de informacion'=>'informacion'-->

</form>
</div>
@endsection