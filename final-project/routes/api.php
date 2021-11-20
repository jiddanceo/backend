<?php

use App\Http\Controllers\PasienController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


# Method (GET) All Resource
Route::get("/pasien", [PasienController::class, 'index']);

# Method (POST) Add Resource
Route::post('/pasien', [PasienController::class, 'store']);

# Method (GET) Detail Resource
Route::get('/pasien/{id}', [PasienController::class, 'show']);

# Method (PUT) Edit Resource
Route::put('/pasien/{id}', [PasienController::class, 'update']);

# Method (DELETE) Delete Resource
Route::delete('/pasien/{id}', [PasienController::class, 'destroy']);

# Method (GET) Search Resource by name
Route::get('/pasien/search/{name}', [PasienController::class, 'search']);

# Method (GET) Positive Resource
Route::get('/pasien/status/positive', [PasienController::class, 'positive']);

# Method (GET) Recovered Resource
Route::get('/pasien/status/recovered', [PasienController::class, 'recovered']);

# Method (GET) Dead Resource
Route::get('/pasien/status/dead', [PasienController::class, 'dead']);