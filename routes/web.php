<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PDC\documentsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;
use Symfony\Component\CssSelector\Node\FunctionNode;

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




Route::get('/show', [PackController::class, 'index']);
Route::post('/upload', [PackController::class, 'store'])->name('uploadFile');

// pdc routes
Route::get('/pdc', function () {
    return view("pdc.documents.send_document");
});
////////////////////////////////////////////////////////////////////

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user/list', [UserController::class, 'index'])->name('user.view');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/save', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/permission/list/{id}', [UserController::class, 'get_user_permission'])->name('user.permission_list');
    Route::post('/user/permission/store', [UserController::class, 'storePermission'])->name('permission.store');
    Route::get('/user/permission/{id}', [UserController::class, 'user_permission_list'])->name('user.permission.list');
    Route::get('/user/permission/delete/{id}', [UserController::class, 'user_permission_delete'])->name('user.permission.delete');




    // pdc routes
    Route::get('/pdc/documents', [documentsController::class, 'index'])->name('pdc.document');

    Route::get('/table', function () {
        return view('components.table');
    });

    Route::get('/form', function () {
        return view('components.form');
    });

    Route::get('/card', function () {
        return view('components.card');
    });

    Route::get('/profile', function () {
        return view('components.profile');
    });
});

// login
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
//logout
Route::post('/logout', [AuthController::class, 'signOut'])->name('logout');
