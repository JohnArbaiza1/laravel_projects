<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\studentController;
//use App\Http\Controllers\Api\studenController;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students',function (){
    return ' Creando dato de estudiante';
});

Route::put('/students/{id}', function(){
    return 'Actualizando dato de estudiante';
});

Route::delete('/students/{id}', function(){
    return 'Eliminando un estudiante';
});
*/


Route::get('/students',[studentController::class, 'index']);
Route::post('/students', [studentController:: class,'store']);
Route::get('/students/{id}',[studentController::class, 'show']);
Route::delete('/students/{id}',[studentController::class, 'destroy']);
Route::put('/students/{id}',[studentController::class, 'update']);
Route::patch('/students/{id}',[studentController::class, 'updatePartial']);

