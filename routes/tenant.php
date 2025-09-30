<?php

declare(strict_types=1);

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Tenant\AdminController;
use App\Http\Controllers\Tenant\SiteController;
use App\Http\Controllers\Tenant\StaffController;
use App\Http\Controllers\Tenant\HRController;
use App\Http\Controllers\Tenant\AccountsController;
use App\Http\Controllers\Tenant\DefaultController;
use App\Http\Controllers\Tenant\ManagerController;
use App\Http\Controllers\Tenant\UserController;

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

        });


           // HR Manager Dashboard
    Route::get('hr/dashboard', [HRController::class, 'index'])
        ->middleware('role:hr_manager') // Protect this route with the 'hr_manager' role
        ->name('hr.dashboard');

    // Staff Dashboard
    Route::get('staff/dashboard', [StaffController::class, 'index'])
        ->middleware('role:staff') // Protect this route with the 'staff' role
        ->name('staff.dashboard');
        

 

    // Account Manager Dashboard
    Route::get('account/dashboard', [AccountsController::class, 'index'])
        ->middleware('role:account_manager') // Protect this route with the 'account_manager' role
        ->name('account.dashboard');


        // manager Manager Dashboard
    Route::get('manager/dashboard', [ManagerController::class, 'index'])
        ->middleware('role:manager') // Protect this route with the 'account_manager' role
        ->name('manager.dashboard');



         // Admin Manager Dashboard
    Route::get('admin/dashboard', [adminController::class, 'index'])
        ->middleware('role:admin') // Protect this route with the 'account_admin' role
        ->name('tenantadmin.dashboard');

        
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


    