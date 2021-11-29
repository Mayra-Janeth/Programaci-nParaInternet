<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteAsistencia;
use Illuminate\Support\Facades\Storage;

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
        $personas = Persona::with('areas')->get();
        //$personas = Persona::where('user_id', Auth::id())->get();
        //$personas = Auth::user()->personas()->get();
        return view('personas/personasIndex', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'nombre' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'max:255',
            //'codigo' => 'required|max:255|unique:App\Models\Persona,codigo',
            //'correo' => 'email|max:255',
            'telefono' => 'max:50',
        ]);

        $ruta = $request->archivo->store('imagenes');
        $mime = $request->archivo->getClientMimeType();
        $nombre_original = $request->archivo->getClientOriginalName();

        $request-> merge([
            'archivo_original' => $nombre_original,
            'archivo_ruta' => $ruta,
            'mime' => $mime,
            'user_id' => Auth::id(),
            'apellido_materno' => $request->apellido_materno ?? ''
        ]);
        $persona = Persona::create($request->all());

        $persona->areas()->attach($request->area_id);
        //Crear registro utilizando modelo
        /*$persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno ?? '';
        $persona->codigo = $request->codigo;
        $persona->correo = $request->correo ?? '';
        $persona->telefono = $request->telefono ?? '';
        $persona->save();*/

        return redirect()->route('persona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
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
        $areas = Area::all();
        return view('personas/PersonasForm', compact('persona', 'areas'));
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
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'max:255',
            'codigo' => [
                'required',
                Rule::unique('personas', 'codigo')->ignore($persona->id),
            ],
            'correo' => 'email|max:255',
            'telefono' => 'max:50',
        ]);

        // $ruta = $request->archivo->store('imagenes');
        // //  ?? $persona->archivo_ruta;
        // $mime = $request->archivo->getClientMimeType();
        // //  ?? $persona->mime;
        // $nombre_original = $request->archivo->getClientOriginalName();
        // //  ?? $persona->archivo_original;

        $request-> merge([
            'archivo_original' => $persona->archivo_original,
            'archivo_ruta' => $persona->archivo_ruta,
            'mime' => $persona->mime,
            'apellido_materno' => $request->apellido_materno ?? ''
        ]);
        Persona::where('id', $persona->id)->update($request->except('_token','_method', 'area_id'));
        
        $persona->areas()->sync($request->area_id);
        //Crear registro utilizando modelo
        /*$persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno ?? '';
        $persona->codigo = $request->codigo;
        $persona->correo = $request->correo ?? '';
        $persona->telefono = $request->telefono ?? '';
        $persona->save();*/

        return redirect()->route('persona.show', $persona);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        // if (Gate::denies('eliminar-persona', $persona)){
        //     abort(403);
        // }

        $persona->delete();
        return redirect()->route('persona.index');
    }

    public function enviarReporte()
    {
        Mail::to('alguien@test.com')->send(new ReporteAsistencia);
        return redirect()->back();
    }

    public function descargarArchivo(Persona $persona)
    {
        $headers = ['Content-Type' => $persona->mime];
        return Storage::download($persona->archivo_ruta, $persona->archivo_original, $headers);
    }
}
