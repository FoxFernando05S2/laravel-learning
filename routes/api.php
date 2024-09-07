<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'profiles',
    'controller' => ProfileController::class,
], static function () {
    Route::get('/', 'index');
    Route::get('/{profile}', 'show');
    Route::post('/', 'store');
    Route::patch('/{profile}', 'update');
    Route::delete('/{profile}', 'delete');
});