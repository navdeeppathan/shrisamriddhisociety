<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\UserController;
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


Route::get('/admin-register', [AuthController::class, 'showRegister'])->name('admin.register');
Route::post('/admin-register', [AuthController::class, 'register'])->name('admin.register.store');

Route::get('/admin-login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin-login', [AuthController::class, 'login'])->name('admin.login.check');

Route::post('/admin-logout', [AuthController::class, 'logout'])->name('admin.logout');


Route::get('/user-login', [AuthController::class, 'showUserLogin'])->name('user.login');
Route::post('/user-login', [AuthController::class, 'userlogin'])->name('user.login.check');

Route::post('/user-logout', [AuthController::class, 'userlogout'])->name('user.logout');


Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', [DashboardController::class,'userindex'])
        ->name('dashboard');

    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');    
    
    Route::get('/my-loans', [LoanController::class,'userindex'])->name('loans');  
    Route::get('/my-loan-payments', [LoanPaymentController::class,'userindex'])
        ->name('loan.payments'); 
        
    Route::get('/my-deposits', [DepositController::class,'userindex'])
        ->name('deposits');    
                    
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

    
    Route::get('/users',[UserController::class,'index'])->name('users.index');

    Route::post('/users',[UserController::class,'store'])->name('users.store');

    Route::put('/users/{id}',[UserController::class,'update'])->name('users.update');

    Route::delete('/users/{id}',[UserController::class,'destroy'])->name('users.destroy');

    Route::get('/deposits',[DepositController::class,'index'])->name('deposits.index');

    Route::post('/deposits',[DepositController::class,'store'])->name('deposits.store');

    Route::put('/deposits/{id}',[DepositController::class,'update'])->name('deposits.update');

    Route::delete('/deposits/{id}',[DepositController::class,'destroy'])->name('deposits.destroy');

    Route::get('/loans',[LoanController::class,'index'])->name('loans.index');

    Route::post('/loans',[LoanController::class,'store'])->name('loans.store');

    Route::put('/loans/{id}',[LoanController::class,'update'])->name('loans.update');

    Route::delete('/loans/{id}',[LoanController::class,'destroy'])->name('loans.destroy');

    Route::get('/loan-payments',[LoanPaymentController::class,'index'])->name('loan.payments.index');

    Route::post('/loan-payments',[LoanPaymentController::class,'store'])->name('loan.payments.store');

    Route::put('/loan-payments/{id}',[LoanPaymentController::class,'update'])->name('loan.payments.update');

    Route::delete('/loan-payments/{id}',[LoanPaymentController::class,'destroy'])->name('loan.payments.destroy');
                    
});        
// Route::get('/', function () {
//     return view('welcome');
// });
