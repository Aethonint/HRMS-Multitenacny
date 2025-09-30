<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantAdminController extends Controller
{
     public function index()
    {
        return view('tenants.admin.dashboard');
    }
}
