<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ECController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\UserController;


Route::get('/logout', [UserController::class, 'create'])->name('welcome');


Route::middleware(['auth', 'checkrole:admin'])->group(function () {
     Route::get('/user/dashboard', [UserController::class, 'index']);
 });
Route::middleware(['auth', 'checkrole:chef de filliere'])->group(function () {
    Route::get('/chefdefilliere/dashboard1', [ChefDeFillereController::class, 'index ']);
});
Route::middleware(['auth', 'checkrole:chef de departement'])->group(function () {
    Route::get('/chefdedepartement/dashboard2', [ChefDeDepartementController::class, ' index']);
 });
 Route::middleware(['auth', 'checkrole:assistant'])->group(function () {
    Route::get('/assistantedepartement/dashboard3', [AssistanteDepartementController::class, ' index']);
 });

Route::get('/admin_chefD/planning', function () {
     return view('admin_chefD.planning');
})->name('admin_chefD.planning');

Route::get('/dashboard', function () {
     return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 });

require __DIR__.'/auth.php';

Route::get('/Suivi/suivi', [ECController::class, 'suiviTousCoursParModule'])->name('Suivi.suiv');

Route::get('/reporting/suivi-cours', [ECController::class, 'reportingCompletSuiviCours'])->name('Reproting.suivi_cours');

Route::get('/semestres/analyse', [SemestreController::class, 'analyse'])->name('semestres.analyse');


Route::get('/ganttDhtmls',[ AnneeAcademiqueController::class, 'gantt']);
Route::post('/create',[AnneeAcademique::class, 'create'])->name('AnneeAcademique.create');
 

Route::get('/planning', function () {
    return view('anne_academique.planning'); // => resources/views/planning.blade.php
});
 
Route::get('/user/create_user', [UserController::class, 'createUser'])->name('user.create_user');
Route::post('/user/create_user', [UserController::class, 'createUser'])->name('user.create_user');
Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

