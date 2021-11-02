<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    public function create(){
        return view('Empleado.create');
    }

    public function index(){
        
        $datos['empleados']=Empleado::paginate(5);///levanta los <numero especificado> primeros registros de ese modelo

        return view('Empleado.index', $datos );
    }

    public function store(Request $request)
    {
        //$datosEmpleado = request()->all();
        //die();

        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            
        ];
        
        $mensaje=[
            'required'=>'El :attribute es requerido', //  ":attribute" es un comodin que se rellena con el nombre del campo a reportar
            
        ];
        // valida en ese request que se cumplan los campos, caso de no cumplirse envia ese mensaje

        if(!$request->hasFile('Fotografia')){
            $campos['Fotografia']='required|max:10000|mimes:jpeg,png,jpg';//de esta forma estamos agregando un nuevo key => value a nuestro array asociativo

            $mensaje['Foto.required']='La Foto es requerida';
        }//sirve para validar si el usuario ya tiene una foto cargada en caso de estar queriendo validar una edicion

        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except('_token');//trae todos los elementos del request menos el token

        if($request->hasFile('Fotografia')){
            $datosEmpleado['Fotografia'] = $request->file('Fotografia')->store('upload','public');
        }

        
        Empleado::insert($datosEmpleado);

        //return response()->json($datosEmpleado);
        return redirect('empleado/')->with('mensaje','empleado agregado satisfactoriamente');
    }
    
    public function destroy($id)
    {
        $empleado=Empleado::findOrFail($id);
        
        if(Storage::delete('public/'.$empleado->Fotografia)){
            Empleado::destroy($id);
        }else{
            return redirect('empleado/')->with('mensaje','no se encuentra la foto, eliminacion cancelada');
        }

        return redirect('empleado/')->with('mensaje','empleado eliminado');
    }

    public function edit($id)
    {

        $empleado=Empleado::findOrFail($id);
        return view('Empleado.edit', compact('empleado'));// compact pasa la informacion a la view edit
    }

    public function update(Request $request, $id)
    {
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido', //  ":attribute" es un comodin que se rellena con el nombre del campo a reportar
            
        ];
        // valida en ese request que se cumplan los campos, caso de no cumplirse envia ese mensaje

        if($request->hasFile('Fotografia')){
            $campos=['Fotografia'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida'];
        }//sirve para validar si el usuario ya tiene una foto cargada en caso de estar queriendo validar una edicion


        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except(['_token','_method']);

        
        if($request->hasFile('Fotografia')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Fotografia);
            $datosEmpleado['Fotografia'] = $request->file('Fotografia')->store('upload','public');

        } 

        Empleado::where('id', '=', $id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);
        //return view('Empleado.edit', compact('empleado'));

        return redirect('empleado')->with('mensaje','Empleado modificado');
    }
}
