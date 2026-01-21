<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\ContactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [ContactFormController::class, 'index']);
Route::get('/contacts/confirm', [ContactFormController::class, 'showForm']);
Route::post('/contacts/confirm', [ContactFormController::class, 'confirm']);
Route::post('/thanks', [ContactFormController::class, 'store']);
Route::get('/thanks', [ContactFormController::class, 'thanks']);



Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'index'])->name('admin');
    Route::get('/admin/export', [ContactController::class, 'export'])->name('export');
    Route::get('/reset', function () {
        return redirect()->route('admin'); })->name('admin.reset');
});

Route::get('/search', [ContactController::class, 'index'])->name('admin.search'); 

Route::post('/delete', [ContactController::class, 'destroy'])->name('contacts.delete');