@extends('layouts.windmill')

@section('content')
{{-- <x-mi-layout> --}}

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Información de {{$persona->nombre}}</h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 " >
        <a href="{{ route('persona.index') }}" class="text-blue-500 hover:text-blue-800">Listado de Personas</a>
        
        <section class="max-w-xl px-4 py-3 mb-8 px-5 py-4 mx-auto rounded-md">
            <div class="px-6 py-3 mx-5 mt-4 overflow-y-auto bg-white border border-gray-300 rounded-md max-h-72 dark:bg-gray-800 dark:border-transparent">
                <h3 class="font-medium text-gray-700 dark:text-gray-100 hover:underline">{{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</h3>
                <h3 class="font-medium text-gray-700 dark:text-gray-100 hover:underline">{{ $persona->codigo }}</h3>
                <h3 class="font-medium text-gray-700 dark:text-gray-100 hover:underline">{{ $persona->correo }}</h3>
                <h3 class="font-medium text-gray-700 dark:text-gray-100 hover:underline">{{ $persona->telefono }}</h3>
            </div>
        </section>
        <hr>
        Usuario Creador: {{ $persona->user->name}} ({{ $persona->user->email}})
        <hr>
        <a href="{{ route('persona.edit', $persona) }}" class="text-blue-500 hover:text-blue-800">Editar</a>
        
        <hr>
        <a href="{{ route('enviar-correo') }}" class="text-blue-500 hover:text-blue-800">Enviar Correo</a>

        <hr>
        <h3>
            Archivo:
        </h3>
        <h5>
            <a href="{{ route('descargar', $persona) }}" class="text-blue-500 hover:text-blue-800">{{ $persona->archivo_original }}</a>
        </h5>
        <hr>
        <h5>
            <a href="{{ route('descargarPDF', $persona) }}" class="text-blue-500 hover:text-blue-800">Descargar PDF</a>
        </h5>
        <hr>
        <form action="{{  route('persona.destroy', $persona)  }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="mt-4 flex items-center justify-center  px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray" type="submit" value="Borrar">
        </form>
    </div>
{{-- </x-mi-layout> --}}
</body>
@endsection