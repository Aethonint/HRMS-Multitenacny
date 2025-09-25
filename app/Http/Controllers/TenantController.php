<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Models\Domain;


class TenantController extends Controller
{
    public function index()
{
    // Load all domains with tenant relation
    $domains = Domain::with('tenant')->get();

    return view('tenants.index', compact('domains'));
}
    public function create()
    {
        return view('tenants.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'site_name'   => 'required|string|max:255',
        'domain'      => 'required|string|unique:domains,domain',
        'first_name'  => 'required|string|max:255',
        'last_name'   => 'required|string|max:255',
        'email'       => 'required|email|unique:users,email',
        'password'    => 'required|string|min:6|confirmed',
    ]);
   

    // Normalize domain: ensure it ends with ".localhost"
    $domain = strtolower($request->domain);
    if (! str_ends_with($domain, '.localhost')) {
        $domain .= '.localhost';
    }

    // Create tenant
    $tenant = Tenant::create([
        'id'   => Str::uuid(),
         'name' => $request->site_name,   // ✅ stored in tenants.name
     
        'data' => ['name' => $request->site_name],
    ]);

    // Attach domain to tenant
    $tenant->domains()->create([
        'domain' => $domain,
    ]);

    // Create tenant admin linked to tenant_id
    User::create([
        'first_name'      => $request->first_name,
        'last_name'      =>  $request->last_name,
        'email'     => $request->email,
        'password'  => bcrypt($request->password),
        'role'      => 'tenant_admin',
        'tenant_id' => $tenant->id,
    ]);

    return redirect()
        ->route('tenants.create')
        ->with('success', "Tenant {$request->site_name} with domain {$domain} created successfully!");
}
}
