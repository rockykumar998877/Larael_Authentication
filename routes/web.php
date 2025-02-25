<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidUser;


Route::get('/',[AuthController::class,'usershow'])->name('/index');


Route::get('/register', function () {
    return view ('Auth.register');
})->name('/register')->middleware(ValidUser::class); 

Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/login',function(){
    return view('auth.login');
});

Route::post('/login',[AuthController::class,'login'])->name('login');



Route::get('/user/{id}', [AuthController::class, 'find'])->name('user-profile');
Route::get('/user/{id}/edit', [AuthController::class, 'edit'])->name('edit-user');
Route::patch('/user/{id}', [AuthController::class, 'update'])->name('update-user');
Route::delete('/user/{id}', [AuthController::class, 'destroy'])->name('delete-user');
Route::get('/users-list', [AuthController::class, 'usershow'])->name('users-list');

Route::get('/order',[OrderController::class,'show']);