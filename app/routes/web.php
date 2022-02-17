<?php

use App\Http\Controllers\Dashboard\Company\CompanyController;
use App\Http\Controllers\Dashboard\Staff\StaffController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    // return redirect()->route('dashboard.index');
    return redirect()->route('company.all');
});

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    /**
     * Разделы dashboard
     */

    // Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/', function () {
        return redirect()->route('company.all');
    })->name('dashboard.index');

    // Компании
    Route::group(['prefix' => 'company'], function () {
        Route::get('/all', [CompanyController::class, 'all'])->name('company.all');
        Route::get('/show/{id}', [CompanyController::class, 'show'])->name('company.show');

        // create
        Route::get('/create', [CompanyController::class, 'createForm'])->name('company.create_form');
        Route::post('/create', [CompanyController::class, 'store'])->name('company.store');

        // update
        Route::get('/update/{id}', [CompanyController::class, 'updateForm'])->name('company.update_form');
        Route::post('/update/{id}', [CompanyController::class, 'update'])->name('company.update');

        // delete
        Route::get('/delete/{id}', [CompanyController::class, 'delete'])->name('company.delete');

        // Tables
        Route::get('/show', [CompanyController::class, 'show'])->name('company.show.table'); //обманка для front(table)
        Route::get('/table/all', [CompanyController::class, 'tablesShowData'])->name('company.table_data.all');
    });

    // Сотрудники
    Route::group(['prefix' => 'staff'], function () {
        //all
        Route::get('/all', [StaffController::class, 'all'])->name('staff.all');
        //show
        Route::get('/show/{id}', [StaffController::class, 'show'])->name('staff.show');

        // create
        Route::get('/create', [StaffController::class, 'createForm'])->name('staff.create_form');
        Route::post('/create', [StaffController::class, 'store'])->name('staff.store');

        // update
        Route::get('/update/{id}', [StaffController::class, 'updateForm'])->name('staff.update_form');
        Route::post('/update/{id}', [StaffController::class, 'update'])->name('staff.update');
        // delete
        Route::get('/delete/{id}', [StaffController::class, 'delete'])->name('staff.delete');
        // Route::post('/delete/{id}', [StaffController::class, 'update'])->name('staff.update');

        // Tables
        Route::get('/show', [StaffController::class, 'show'])->name('staff.show.table'); //обманка для front(table)
        Route::get('/table/all', [StaffController::class, 'tablesShowData'])->name('staff.table_data.all');
    });
});
