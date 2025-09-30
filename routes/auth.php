<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Models\Tenant;
use App\Models\User;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\AdminController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

     Route::get('tenantadmin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

     Route::post('admin/login', [AuthenticatedSessionController::class, 'store'])->name('adminlogin');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
        
});

Route::middleware('auth')->group(function () {

 Route::get('tenantadmin/dashboard', [AdminController::class, 'index'])
        ->middleware('role:tenant_manager') // Protect this route with the 'superadmin' role
        ->name('admin.dashboard');
          Route::get('/tenants/create', [TenantController::class, 'create'])->middleware('role:tenant_manager')->name('tenants.create');
            Route::get('/all/tenants', [TenantController::class, 'tenatsmangersideall'])->middleware('role:tenant_manager')->name('tenantsmangerside.index');
          Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->middleware('role:tenant_manager')
    ->name('tenants.destroy');
          Route::patch('/tenants/{tenant}/toggle-status', [TenantController::class, 'toggleStatus'])->middleware('role:tenant_manager')
    ->name('tenants.toggleStatus');

     Route::get('/tenants/manager/profile/edit', [TenantController::class, 'profileedit'])->middleware('role:tenant_manager')->name('super.admin.profile');
    


         
    Route::post('/tenants/store', [TenantController::class, 'store'])->middleware('role:tenant_manager')->name('tenants.store');



    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
