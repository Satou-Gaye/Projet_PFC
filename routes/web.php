<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');


// Route::middleware(['auth', 'checkrole:admin'])->group(function () {
//     Route::get('/user/dashboard', [UserController::class, 'index']);
// });
// Route::middleware(['auth', 'checkrole:chef de filliere'])->group(function () {
//     Route::get('/chefdefilliere/dashboard1', [ChefDeFillereController::class, 'index ']);
// });
// Route::middleware(['auth', 'checkrole:chef de departement'])->group(function () {
//     Route::get('/chefdedepartement/dashboard2', [ChefDeDepartementController::class, ' index']);
// });
// Route::middleware(['auth', 'checkrole:assistant'])->group(function () {
//     Route::get('/assistantedepartement/dashboard3', [AssistanteDepartementController::class, ' index']);
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// Route::get('/ganttDhtmls',[ AnneeAcademiqueController::class, 'gantt']);
// Route::post('/create',[AnneeAcademique::class, 'create'])->name('AnneeAcademique.create');
 

Route::get('/planning', function () {
    return view('anne_academique.planning'); // => resources/views/planning.blade.php
});
Route::post('/user/{id}/assignrole', [UserController::class, 'assignRole'])->name('user.assignRole');
Route::get('/users/create', function () {
    return view('create_user');
});

Route::post('/users', [UserController::class, 'createUser'])->name('user.store');
Route::resource('users',UserController::class);

