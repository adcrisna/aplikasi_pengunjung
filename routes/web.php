<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;

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

Route::any('/', [IndexController::class, 'index'])->name('index');
Route::any('/pengunjung', [IndexController::class, 'pengunjung'])->name('pengunjung');
Route::any('/addPengunjung', [IndexController::class, 'addPengunjung'])->name('addPengunjung');
Route::any('/index', [LoginController::class, 'login'])->name('login');
Route::any('/proses_login', [LoginController::class, 'prosesLogin'])->name('prosesLogin');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::any('/home', [AdminController::class, 'index'])->name('admin.index');
        Route::any('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::any('/update_profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

        Route::any('/pengunjung', [AdminController::class, 'pengunjung'])->name('admin.pengunjung');
        Route::any('/deletePengunjung/{id}', [AdminController::class, 'deletePengunjung'])->name('admin.deletePengunjung');
        Route::any('/truncatePengunjung', [AdminController::class, 'truncatePengunjung'])->name('admin.truncatePengunjung');

        Route::any('/laporan_analisis', [AdminController::class, 'laporanAnalisis'])->name('admin.laporanAnalisis');
        Route::any('/analisis', [AdminController::class, 'analisis'])->name('admin.analisis');
        Route::any('/addAnalisis', [AdminController::class, 'addAnalisis'])->name('admin.addAnalisis');
        Route::any('/deleteAnalisis/{id}', [AdminController::class, 'deleteAnalisis'])->name('admin.deleteAnalisis');

        Route::any('/admin', [AdminController::class, 'admin'])->name('admin.admin');
        Route::any('/add_admin', [AdminController::class, 'addAdmin'])->name('admin.addAdmin');
        Route::any('/update_admin', [AdminController::class, 'updateAdmin'])->name('admin.updateAdmin');
        Route::any('/delete_admin/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.deleteAdmin');
    });
});
