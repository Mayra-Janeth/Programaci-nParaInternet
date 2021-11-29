<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Información de {{$persona->nombre}}</h2>
</head>
<body>
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
</body>
</html>