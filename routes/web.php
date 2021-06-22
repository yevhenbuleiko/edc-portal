<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* --- Frontend --- */
use App\Http\Controllers\Frontend\Home\HomeController;
/* --- Backend --- */
use App\Http\Controllers\Backend\Dashboard\AdminDashboardController;
// User
use App\Http\Controllers\Backend\User\User\AdminUserController;
// Access
use App\Http\Controllers\Backend\Access\AdminPermissionController;

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

// Frontend
Route::prefix('/{fnd}')->group(function () {
    // Home
    Route::get('/', HomeController::class)->name('home');

    // ---
});


// Backend
Route::middleware(['auth:sanctum', 'verified'])->prefix('/{fnd}/admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', AdminDashboardController::class)->name('admin.dashboard');

    // -- Access
    Route::resource('access/permissions', AdminPermissionController::class, ['as' => 'admin'])->except(['create','store','destroy']);
    // -- User
    // User
    Route::resource('users', AdminUserController::class, ['as' => 'admin']);
    // Unions
    // ---
});



// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');