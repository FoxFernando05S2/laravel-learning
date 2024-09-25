<?php

use App\Enums\SpecialityEnum;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TestMiddleware;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\TypeUserController;
use App\Http\Middleware\Authentication;
use App\Models\Speciality;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[AuthController::class, 'login'])->withoutMiddleware(Authentication::class);


Route::group([
    'prefix' => 'profiles',
    'controller' => ProfileController::class,
], static function () {
    // Route::get('/', 'index');
    Route::get('/', 'index');
    Route::get('/{profile}', 'show');
    /* Route::get('/profiles/{id}', [ProfileController::class, 'show']); */
    Route::post('/', 'store');
    Route::patch('/{profile}', 'update');
    Route::delete('/{profile}', 'delete');
});

Route::group([
    'prefix' => 'users',
    'controller' => UserController::class,
], static function () {
    Route::get('/', 'index'); //->middleware('checkType:alumno,profesor')
    Route::get('/{user}', 'show')->middleware(CheckUserType::class . ':' . SpecialityEnum::STUDENT->value); 
    Route::post('/', 'store')->middleware(CheckUserType::class.':profesor');
});

Route::group([
    'prefix' => 'specialities',
    'controller' => SpecialityController::class,
], static function () {
    Route::post('/', 'store')->middleware(CheckUserType::class . ':' . SpecialityEnum::TEACHER->value);
});

Route::group(['prefix' => 'type-users'], function () {
    Route::post('/assign/{user}', [TypeUserController::class, 'assignTypeToUser']);
    Route::get('/{user}/types', [TypeUserController::class, 'getUserTypes']);
    Route::delete('/{user}/types/{type}', [TypeUserController::class, 'removeTypeFromUser']);
});


Route::group([
    'prefix' => 'users',
    'controller' => UserController::class,
], routes: static function () {
    Route::post('/specialities', 'assignSpeciality')->middleware(CheckUserType::class . ':' . SpecialityEnum::TEACHER->value);
});

Route::group([
    'prefix' => 'users',
    'controller' => UserController::class,
], routes: static function () {
    Route::post('/blocks', 'assignBlock')->middleware(CheckUserType::class . ':' . SpecialityEnum::TEACHER->value);
});
