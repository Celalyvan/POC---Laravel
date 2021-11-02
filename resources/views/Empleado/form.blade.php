
<h1>{{$modo.' empleado.'}}</h1><!--de esta forma se esta imprimiendo la informacion que fue enviada en la inclusion: en este caso fue enviada en la variable $modo-->

@if(count ($errors)>0)<!--en caso de haber errores en la carga del formulario seran reportados en este foreach-->

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
        
               <li>{{$error}}</li>
            
            @endforeach
        </ul>
        
    </div>


@endif

<div class="form-group">
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" class="form-control" 
value="{{isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" id="Nombre">
</div>

<div class="form-group">
<label for="ApellidoPaterno">Apellido Paterno</label>
<input type="text" name="ApellidoPaterno" class="form-control" 
value="{{isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno')}}" id="ApellidoPaterno">
</div>

<div class="form-group">
<label for="ApellidoMaterno">Apellido Materno</label>
<input type="text" name="ApellidoMaterno" class="form-control" 
value="{{isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno')}}" id="ApellidoMaterno">
</div>

<div class="form-group">
<label for="Correo">Correo</label>
<input type="text" name="Correo" class="form-control" 
value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" id="Correo">
</div>

<div class="form-group">
@if(isset($empleado->Fotografia))
 <img src="{{ asset('storage').'/'.$empleado->Fotografia }}" 
 class=" img-thumbnail img-fluid"
   width="100" alt="">
@endif
<input type="file" name="Fotografia" 
value="{{ isset($empleado->Fotografia)?$empleado->Fotografia:old('Fotografia') }}" id="Fotografia" ><br>
</div>


<input type="submit" class="btn btn-success" value="{{$modo}} data">
<a href="{{ url('empleado/') }}" class="btn btn-primary">Regresar</a>