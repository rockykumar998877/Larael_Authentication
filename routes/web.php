<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidUser;


Route::get('/register', function () {
    return view ('Auth.register');
})->name('/register')->middleware(ValidUser::class); 

Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/login',function(){
    return view('auth.login');
})->name('loginform');

Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/',[AuthController::class,'usershow'])->name('/index');
Route::middleware(['auth:sanctum'])->group(function(){  
    
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::get('/user/{id}', [AuthController::class, 'find'])->name('user-profile');
Route::get('/user/{id}/edit', [AuthController::class, 'edit'])->name('edit-user');
Route::patch('/user/{id}', [AuthController::class, 'update'])->name('update-user');
Route::delete('/user/{id}', [AuthController::class, 'destroy'])->name('delete-user');
Route::get('/users-list', [AuthController::class, 'usershow'])->name('users-list');



// UserController
Route::get('/usershow',[UserController::class,'showUsers'])->name('usershow');



//Test Session
Route::get('/session',function(){
    $value = session()->all();
    echo "<pre>";
    print_r($value);
    echo "</pre>";
});