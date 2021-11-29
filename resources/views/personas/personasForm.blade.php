@extends('layouts.windmill')

@section('content')
@if(isset($persona))
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Editar Persona</h2>
@else
<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Crear Persona</h2>
@endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($persona))
    <form action="{{ route('persona.update', $persona) }}" method="POST">
        @method('PATCH')
    @else
    <form action="{{ route('persona.store') }}" method="POST" enctype="multipart/form-data">
    @endif

        @csrf
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 " >
            <label for="nombre" class="block text-sm"><span class="text-gray-700 dark:text-gray-400">Nombre</span>
                <input type="text" name="nombre" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Jane Doe" value="{{ $persona->nombre ?? '' }}">
            </label>

            <label for="apellido_paterno" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Apellido Paterno</span>
                <input type="text" name="apellido_paterno" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="White" value="{{ $persona->apellido_paterno ?? '' }}">
            </label>

            <label for="apellido_materno" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Apellido Materno</span>
                <input type="text" name="apellido_materno" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Campbell" value="{{ $persona->apellido_materno ?? '' }}">
            </label>

            <label for="codigo" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Clave/Código</span>
                <input type="text" name="codigo" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="123456789" value="{{ $persona->codigo ?? '' }}">
            </label>

            <label for="correo" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Correo</span>
                <input type="text" name="correo" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="example@mail.com" value="{{ $persona->correo ?? '' }}">
            </label>
            
            <label for="telefono" class="block mt-4 text-sm"><span class="text-gray-700 dark:text-gray-400">Teléfono</span>
                <input type="text" name="telefono" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Enter phone number" value="{{ $persona->telefono ?? '' }}">
            </label>
            
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Area
                </span>
                <select
                  name="area_id[]" id="area_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  multiple
                >
                {{-- {{ array_search($area->id, $persona->areas->pluck('id')->toArray()) === false ? '' : 'selected'}} --}}
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ isset($persona) && array_search($area->id, $persona->areas->pluck('id')->toArray()) !== false ? 'selected' : ''}}>
                            {{ $area->nombre_area }}</option>
                    @endforeach
                </select>
              </label>

            @if(isset($persona))
            @else
            <input type="file" name="archivo" class="mt-4 flex items-center justify-center  px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
            {{-- <br>
            <input type="submit" value="Guardar"> --}}
            @endif
            
            
            
            <button
                type="submit" value="Guardar" class="mt-4 flex items-center justify-center  px-4 py-2 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
              >
                Guardar
            </button>
        </div>
    </form>
 @endsection