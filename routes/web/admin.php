<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\Backend\CategoriaController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;

// rota admin//
Route::get('admin/dashboard', [AdminController::class, 'dashboard'])
->middleware(['auth', 'admin'])
->name('admin.dashboard');

// rota admin ver perfil//
Route::get('admin/profile', [ProfileController::class, 'index'])
->middleware(['auth', 'admin'])
->name('admin.profile');

// rota admin atualizar perfil//
Route::post('admin/profile/update', [ProfileController::class, 'update'])
->middleware(['auth', 'admin'])
->name('admin.profile.update');

// rota admin atualizar Senha//
Route::post('admin/profile/update/password', [ProfileController::class, 'updatePassword'])
->middleware(['auth', 'admin'])
->name('admin.profile.password');

// rota Slider destaque//
Route::resource('admin/Slider', SliderController::class)
->middleware(['auth', 'admin']);


// rota Slider destaque//
Route::resource('admin/categoria',CategoriaController::class)
->middleware(['auth', 'admin']);
