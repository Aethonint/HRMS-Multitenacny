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
    Route::get('site/dashboard', [SiteController::class, 'index'])
        ->middleware('role:site_manager') // Protect this route with the 'site_manager' role
        ->name('site.dashboard');
          // Route to handle adding employee (POST request from the form)
    Route::post('/tenant/add-employee', [TenantController::class, 'addEmployee'])->name('tenant.add_employee');

    // Staff Dashboard
    Route::get('staff/dashboard', [StaffController::class, 'index'])
        ->middleware('role:staff') // Protect this route with the 'staff' role
        ->name('staff.dashboard');

    // HR Manager Dashboard
    Route::get('hr/dashboard', [HRController::class, 'index'])
        ->middleware('role:hr_manager') // Protect this route with the 'hr_manager' role
        ->name('hr.dashboard');

    // Account Manager Dashboard
    Route::get('account/dashboard', [AccountsController::class, 'index'])
        ->middleware('role:account_manager') // Protect this route with the 'account_manager' role
        ->name('account.dashboard');

        
});
     // Tenant Dashboard
    // Route::get('/dashboard', function () {
    //     return view('tenant.dashboard'); // Make tenant-specific dashboard view
    // })->middleware('auth')->name('tenant.dashboard');
   
 
  Route::get('/admin/login', [AuthenticatedSessionController::class, 'site'])->name('admin.login');
 Route::get('/login', [AuthenticatedSessionController::class, 'site'])->name('tenant.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
  

});





  Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants/store', [TenantController::class, 'store'])->name('tenants.store');
    // routes/web.php
Route::get('/sites', [TenantController::class, 'index'])->name('tenants.index');


    