<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use App\Models\Tenant;
use App\Models\User;

use App\Http\Controllers\Tenant\AdminController;

Route::group([
    'domain'=>config('tenancy.central_domains.0')
],function(){



    

 Route::get('/', [TenantController::class, 'index'])->name('tenant.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




   Route::middleware(['auth', 'role:tenant_manager'])->group(function () {

    Route::get('tenantadmin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/tenants/create', [TenantController::class, 'create'])
        ->name('tenants.create');

    Route::get('/all/tenants', [TenantController::class, 'tenatsmangersideall'])
        ->name('tenantsmangerside.index');

    Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])
        ->name('tenants.destroy');

    Route::patch('/tenants/{tenant}/toggle-status', [TenantController::class, 'toggleStatus'])
        ->name('tenants.toggleStatus');

    Route::get('/tenants/manager/profile/edit', [TenantController::class, 'profileedit'])
        ->name('super.admin.profile');

    Route::patch('/tenants/manager/profile/update', [TenantController::class, 'profileupdate'])
        ->name('tenantmanager.profile.update');
});
    

    

});

require __DIR__.'/auth.php';



});


