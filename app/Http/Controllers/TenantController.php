<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\UserStatus;
use App\RolesEnum;
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
        // Validate the incoming request data
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
            'name' => $request->site_name,   // Store in tenants.name
            'data' => ['name' => $request->site_name],  // Store site name in the data column
        ]);

        // Attach domain to tenant
        $tenant->domains()->create([
            'domain' => $domain,
        ]);

        // Create tenant admin (site manager) linked to tenant_id
        $user = User::create([  // This creates the user and assigns it to $user
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'email'           => $request->email,
            'password'        => bcrypt($request->password), // Hash the password
            'tenant_id'       => $tenant->id,  // Link user to the tenant
            'status'          => UserStatus::ACTIVE->value, // Set user status to 'active'
        ]);

        // Assign the 'site_manager' role using the RolesEnum
      // Ensure role exists, then assign
    $user->assignRole(RolesEnum::SITE_MANAGER->value);

        // Return success message and redirect
        return redirect()
            ->route('tenants.create')
            ->with('success', "Tenant {$request->site_name} with domain {$domain} created successfully!");
    }
     // Handle employee addition (POST request)
   public function addEmployee(Request $request)
{
    // Validate the form inputs
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email',
        'password'   => 'required|string|min:8',  // Password validation
    ]);

    // Create the user and assign the tenant_id of the authenticated user
    $user = User::create([  // This creates the user and assigns it to $user
        'first_name'    => $request->first_name,
        'last_name'     => $request->last_name,
        'email'         => $request->email,
        'password'      => bcrypt($request->password), // Hash the password
        'tenant_id'     => Auth::user()->tenant->id,  // Store the authenticated user's tenant ID
        'status'        => UserStatus::ACTIVE->value,  // Set user status to 'active'
    ]);

    // Assign the role 'staff' to the newly created user
    $user->assignRole(RolesEnum::STAFF->value);

    // Redirect back with a success message
    return back()->with('success', 'Employee added successfully!');
}

}
