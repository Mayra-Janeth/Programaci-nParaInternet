<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function(){
    return view('inicio');
});

// Route::get('/personas', 'PersonaController@index');
// Route::get('/personas/create', 'PersonaController@create');
// Route::post('/personas/create', 'PersonaController@store');


Route::resource('persona', PersonaController::class);
Route::get('descargar-archivo/{persona}', 'PersonaController@descargarArchivo')->name('descargar');
Route::get('/pdf/{persona}', 'PDFController@PDF')->name('descargarPDF');
Route::get('enviar-correo', 'PersonaController@enviarReporte')->name('enviar-correo');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/auth/github/redirect', function(){
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/github/callback', function(){
    $githubUser = Socialite::driver('github')->user();
    //dd($githubUser);
    //create new user
    $user = User::firstOrCreate(
        [
            'provider_id' => $githubUser->getId()
        ],
        [
            'email' => $githubUser->getEmail(),
            'name' => $githubUser->getName(),
        ]
    );
    // User::create([
    //     'email' => $githubUser->getEmail(),
    //     'name' => $githubUser->getName(),
    //     'provider_id' => $githubUser->getId(),
    // ]);
    //log in
    auth()->login($user, true);

    //redirect
    return redirect('dashboard');
});

