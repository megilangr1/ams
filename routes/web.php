<?php

use App\Http\Controllers\Configs\PermissionsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Configs\RolesController;
use App\Http\Controllers\Configs\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/main', [MainController::class, 'adminIndex'])->name('backend.main');

    // Roles 
    Route::resource('roles', RolesController::class);

    // Permissions
    Route::resource('permissions', PermissionsController::class);

    // Users
    Route::resource('users', UsersController::class);
    Route::put('/users/{id}/restore', [UsersController::class, 'restore'])->name('users.restore');

    // Route::controller(RolesController::class)->prefix('/hak-akses')->name('roles.')->group(function() {
    //     Route::get('/index', 'index')->name('index');
    // });
});
