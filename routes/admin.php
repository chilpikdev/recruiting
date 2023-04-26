<?php

use App\Http\Controllers\Admin\GetVakancyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\VakancyController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\SkillController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login_process', [AuthController::class, 'login'])->name('login_process');
});

/**
 * WE ARE USED THIS ROLES
 *
 * dashboard, employer menu, job seeker menu, manage users, settings, additional
 */
Route::middleware('auth:admin')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['can:dashboard']], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name("dashboard");
    });

    Route::group(['middleware' => ['can:manage users']], function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });

    Route::group(['middleware' => ['can:settings']], function () {
        Route::get('settings', [SettingController::class, 'index'])->name("settings.index");
        Route::get('settings/{id}/edit', [SettingController::class, 'edit'])->name("settings.edit");
        Route::put('settings/{id}', [SettingController::class, 'update'])->name("settings.update");
    });

    Route::group(['middleware' => ['can:employer menu']], function () {
        Route::resource('vakancies', VakancyController::class);
        Route::get('getcheckeds', [GetVakancyController::class, 'getCheckeds'])->name('getcheckeds');
    });

    Route::group(['middleware' => ['can:job seeker menu']], function () {
        Route::resource('resumes', ResumeController::class);
        Route::get('getvakancies', [GetVakancyController::class, 'getVakancies'])->name('getvakancies');
        Route::put('checkvakancy/{vakancy_id}/{author_id}/{resume_id}', [GetVakancyController::class, 'check'])->name('checkvakancy');
    });

    Route::group(['middleware' => ['can:additional']], function () {
        Route::resource('positions', PositionController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('languages', LanguageController::class);
    });
});
