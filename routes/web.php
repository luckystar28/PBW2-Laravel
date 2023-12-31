<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes

  Togi Samuel Simarmata
  6706223067
  D3 RPLA 46-03
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/userStore', [RegisteredUserController::class, 'store'])->name('user.store');
    Route::get('/user', [UserController::class, 'index'])->name('user.daftarPengguna');
    Route::get('/userRegistration', [UserController::class, 'create'])->name('user.registrasi');
    Route::get('/userView/{username}', [UserController::class, 'showUser'])->name('user.infoPengguna');

    Route::post('/koleksiStore', [KoleksiController::class, 'store'])->name('koleksi.store');
    Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.daftarKoleksi');
    Route::get('/koleksiTambah', [KoleksiController::class, 'create'])->name('koleksi.registrasi');
    Route::get('/koleksiView/{id}', [KoleksiController::class, 'show'])->name('koleksi.infoKoleksi');
});

require __DIR__.'/auth.php';
