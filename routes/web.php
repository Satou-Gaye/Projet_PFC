<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcsController;

 ;

Route::get('/ecs', [EcsController::class, 'index'])->name('ecs.index');

 

Route::get('/ecs', [EcsController::class, 'index'])->name('ecs.index'); // liste des ECs
Route::get('/ecs/{codeEc}', [EcsController::class, 'show'])->name('ecs.show'); // détail d'un EC


Route::get('/', function () {
    return view('welcome');
});
