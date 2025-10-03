<?php

declare(strict_types=1);

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Tenant\AdminController;
use App\Http\Controllers\Tenant\SiteController;
use App\Http\Controllers\Tenant\StaffController;
use App\Http\Controllers\Tenant\HRController;
use App\Http\Controllers\Tenant\AccountsController;
use App\Http\Controllers\Tenant\DefaultController;
use App\Http\Controllers\Tenant\ManagerController;
use App\Http\Controllers\Tenant\TenantAdminController;
use App\Http\Controllers\Tenant\UserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Tenant\DepartmentController;
use App\Http\Controllers\Tenant\DesignationController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Route::get('/', function () {
    //     $user=User::all();
    //     dd($user-> toArray());
    //     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });

   Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('tenant.logout');
    

Route::middleware(['auth'])->group(function () {

    // Super Admin Dashboard
   

    // Site Manager Dashboard
   // Group routes by role
        Route::middleware(['role:site_manager'])->group(function () {
            Route::get('site/dashboard', [SiteController::class, 'index'])->name('site.dashboard');
             Route::resource('users', UserController::class, [
        'as' => 'tenant' // tenant.users.index etc.
    ]);
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('tenant.users.toggleStatus');
      Route::get('site/profile/edit', [SiteController::class, 'profileedit'])->name('site.profile.view');
      Route::Patch('site/profile/update', [SiteController::class, 'profileupdate'])->name('site.profile.update');
       Route::put('password', [PasswordController::class, 'update'])->name('site.password.update');

         Route::patch('/tenant/logo', [SiteController::class, 'updateLogo'])
            ->name('tenant.logo.update');

            Route::resource('departments', DepartmentController::class);
Route::resource('designations', DesignationController::class);
    

        });



        
         // Admin
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [TenantAdminController::class, 'index'])->name('tenantadmin.dashboard');
    });


         // HR Manager
    Route::middleware(['role:hr_manager'])->prefix('hr')->group(function () {
        Route::get('/dashboard', [HRController::class, 'index'])->name('hr.dashboard');
    });

    // Staff
    Route::middleware(['role:staff'])->prefix('staff')->group(function () {
        Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
         Route::get('/profile/edit', [StaffController::class, 'profileedit'])->name('profile');
         Route::patch('/profile/updare', [StaffController::class, 'profileupdate'])->name('staff.profile.update');
        
    });

    // Account Manager
    Route::middleware(['role:account_manager'])->prefix('account')->group(function () {
        Route::get('/dashboard', [AccountsController::class, 'index'])->name('account.dashboard');
    });

    // Manager
    Route::middleware(['role:manager'])->prefix('manager')->group(function () {
        Route::get('/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    });

   
        
});
     // Tenant Dashboard
    // Route::get('/dashboard', function () {
    //     return view('tenant.dashboard'); // Make tenant-specific dashboard view
    // })->middleware('auth')->name('tenant.dashboard');
   
 
  Route::get('/admin/login', [AuthenticatedSessionController::class, 'site'])->name('admin.login');
 Route::get('/login', [AuthenticatedSessionController::class, 'site'])->name('tenant.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
  

});






    // routes/web.php
Route::get('/sites', [TenantController::class, 'index'])->name('tenants.index');


    