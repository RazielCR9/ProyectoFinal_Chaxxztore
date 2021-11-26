<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //para mostrar solo lo del usuario logeado
        //$personas = Persona::where('user_id', Auth::id())->get();
        //$personas = Auth::user()->personas;

        //para mostrar todo con todos los usuarios
        //$personas = Persona::all();
        //Eager loading
        $personas = Persona::with('areas')->get();
        //
        return view('personas/personasIndex', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $areas = Area::all();
        return view('personas/personasForm', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'correo' => 'required|email',
            'identificador' => 'required|max:10|unique:App\Models\Persona',
            'telefono' => 'max:15|required'
        ]);

        //request->file('archivo');
        $ruta = $request->archivo->store('imagenes');
        $mime = $request->archivo->getClientMimeType();
        $nombre_original = $request->archivo->getClientOriginalName();
        $request->merge([
            'archivo_original' => $nombre_original,
            'archivo_ruta' => $ruta,
            'mime' => $mime,
            'user_id' => Auth::id(),
            'apellido_materno' => $request->apellido_materno ?? ''
        ]);
        //Creamos la persona
        $persona = Persona::create($request->all());
        //Creamos la relacion con areas en la tabla pivote
        $persona->areas()->attach($request->area_id);
        /*
        $contacto = new Persona();
        $contacto->nombre = $request->nombre;
        $contacto->apellido_paterno = $request->apellido_paterno;
        $contacto->apellido_materno = $request->apellido_materno ?? '';
        $contacto->identificador = $request->identificador;
        $contacto->telefono = $request->telefono;
        $contacto->correo = $request->correo;
        $contacto->save();*/

        return redirect()->route('persona.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
        return view('personas/personasShow', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
        $areas = Area::all();
        return view('personas/personasForm',compact('persona','areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'correo' => 'required|email',
            'identificador' => [
                'required',
                'max:10',
                Rule::unique('personas')->ignore($persona->id),
            ],
            'telefono' => 'max:15|required'
        ]);
        /* $ruta = $request->archivo->store('imagenes');
        $mime = $request->archivo->getClientMimeType();
        $nombre_original = $request->archivo->getClientOriginalName(); */
        $request->merge([
            /* 'archivo_original' => $nombre_original,
            'archivo_ruta' => $ruta,
            'mime' => $mime, */
            'apellido_materno' => $request->apellido_materno ?? ''
        ]);
        Persona::where('id',$persona->id)->update($request->except('_token','_method','area_id','archivo'));
        $persona->areas()->sync($request->area_id);
        /*
        $persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno ?? '';
        $persona->identificador = $request->identificador;
        $persona->telefono = $request->telefono;
        $persona->correo = $request->correo;
        $persona->save();*/

        // return redirect()->route('persona/show', $persona);
        return redirect()->route('persona.show', $persona->id);
        // {{route('persona.show',$persona->id)}}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
        $persona->delete();
        return redirect()->route('persona.index');
    }

    public function descargarArchivo(Persona $persona)
    {
        $headers = ['Content-Type' => $persona->mime];
        return Storage::download($persona->archivo_ruta, $persona->archivo_original, $headers);
    }
}
