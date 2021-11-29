@extends('layouts.windmill')

@section('content')
{{-- @extends('layouts.mi-layout') --}}

{{-- @section('contenido') --}}
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Listado de Personas</h2>

<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800  overflow-x-auto" >
    <a href="{{  route('persona.create') }}" class="text-blue-500 hover:text-blue-800">Agregar Persona</a>
    <div class="mt-4 max-w-3xl px-4 py-3 mb-8 overflow-x-auto rounded-lg shadow-xs  ">
        <div class="overflow-x-auto ">
          <table class="whitespace-no-wrap ">
            <thead>
              <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="w-1/2 px-4 py-3">Area(s)</th>
                <th class="w-1/4 px-4 py-3">Usuario</th>
                <th class="px-4 py-3">ID</th>
                <th class="w-1/4 px-4 py-3">Nombre</th>
                <th class="w-1/4 px-4 py-3">Apellido Paterno</th>
                <th class="w-1/4 px-4 py-3">Apellido Materno</th>
                <th class="w-1/4 px-4 py-3">Código</th>
                <th class="w-1/4 px-4 py-3">Correo</th>
                <th class="w-1/4 px-4 py-3">Teléfono</th>
                <th class="w-1/4 px-4 py-3">Nombre Completo</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($personas as $persona)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <ol>
                                        @foreach($persona->areas as $area)
                                            <li class="font-semibold">{{  $area->nombre_area }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm"> {{ $persona->user->name }}</td>
                        <td class="px-4 py-3 text-sm"><a href="{{ route('persona.show', $persona->id) }}">{{ $persona->id }}</a></td>
                        <td class="px-4 py-3 text-sm">{{  $persona->nombre  }}</td>
                        <td class="px-4 py-3 text-sm">{{  $persona->apellido_paterno  }}</td>
                        <td class="px-4 py-3 text-sm">{{  $persona->apellido_materno  }}</td>
                        <td class="px-4 py-3 text-sm">{{  $persona->codigo  }}</td>
                        <td class="px-4 py-3 text-sm">{{  $persona->correo  }}</td>
                        <td class="px-4 py-3 text-sm">{{  $persona->telefono  }}</td>
                        <td class="px-4 py-3 text-sm">{{  $persona->nombre_completo  }}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {{-- <hr>
        <h5>
            <a href="{{ route('descargarPDF') }}" class="text-blue-500 hover:text-blue-800">Descargar PDF</a>
        </h5> --}}
</div>    

{{-- @endsection --}}
@endsection