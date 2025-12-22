<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// フロント
Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

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
});

// 認証
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ログイン・ログアウト
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 管理画面：検索（一覧と同じURL）
Route::get('/admin/contacts', [AdminContactController::class, 'index'])
    ->name('admin.contacts.index');


// その他
Route::get('/auth/search', [AuthController::class, 'search']);
Route::get('/auth/reset', [AuthController::class, 'reset']);
// エクスポート機能
Route::get('/admin/contacts/export', [AdminContactController::class, 'export'])
    ->name('admin.contacts.export');


// 問い合わせ削除
Route::delete('/admin/contacts/{contact}', [AdminContactController::class, 'destroy'])
    ->name('admin.contacts.destroy');

//
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

