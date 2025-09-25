<?php

declare(strict_types=1);

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\Tenant;
use App\Models\User;

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
    Route::get('/', function () {
        $user=User::all();
        dd($user-> toArray());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});

 Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants/store', [TenantController::class, 'store'])->name('tenants.store');
    // routes/web.php
Route::get('/sites', [TenantController::class, 'index'])->name('tenants.index');
