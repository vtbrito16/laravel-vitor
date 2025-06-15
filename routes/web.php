<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//chamando rotas organizadas
foreach(File::allFiles(__DIR__.'/web') as $route_file){
    require $route_file->getPathname();
}

require __DIR__.'/auth.php';

//Rota Admin Login
Route::get('admin/login',[AdminController::class, 'login'])->name('admin.login');

//Rota Admin recuperar senha
Route::get('admin/forgot-password',[AdminController::class, 'forgot'])->name('admin.forgot');

//rota slider destroy
Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('Slider.destroy');

