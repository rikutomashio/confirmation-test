<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// フロント
Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

// 認証
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 管理画面
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.contacts.index');
    });
    //一覧
    Route::get('/contacts', [AdminContactController::class, 'index'])
        ->name('admin.contacts.index');
    //詳細
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])
        ->name('admin.contacts.show');
    // 削除
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])
        ->name('admin.contacts.destroy');
    // エクスポート
    Route::get('/contacts/export', [AdminContactController::class, 'export'])
        ->name('admin.contacts.export');
});











