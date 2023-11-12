<?php

use App\Http\Controllers\Admin\StudentControler;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserPredictionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/prediction/show', [UserPredictionController::class,'index'])->name('prediction.index');
    Route::get('/prediction', [UserPredictionController::class,'create'])->name('prediction.create');
    Route::post('/prediction', [UserPredictionController::class,'store'])->name('prediction.store');
    Route::delete('/prediction/{id}', [UserPredictionController::class,'destroy'])->name('prediction.destroy');
    Route::get('/edit/profile', [App\Http\Controllers\User\UserProfileController::class,'index'])->name('edit.profile');
    Route::put('/update/profile', [App\Http\Controllers\User\UserProfileController::class,'profileUpdate'])->name('update.profile');
});

//admin route
Route::prefix('admin')->middleware(['auth', 'admin'])->group( function (){
   Route::resource('student', StudentControler::class);
   Route::resource('user', UserController::class);
});
