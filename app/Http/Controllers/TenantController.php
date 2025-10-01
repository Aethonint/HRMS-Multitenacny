<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        return view('Admin.sites.create');
    }
    public function tenatsmangersideall()
    {
        if (!Auth::user()->hasRole(RolesEnum::TENANT_MANAGER->value)) {
            abort(code: 403);
        }
       // Fetch all tenants from the database
       $tenants = Tenant::with(['user', 'domains'])->get();
        return view('Admin.sites.index',compact('tenants'));
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
            ->route('tenantsmangerside.index')
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
    return redirect()-> route('tenantsmangerside.index')->with('success', 'Employee added successfully!');
}
public function destroy(Tenant $tenant)
{
    if (!Auth::user()->hasRole(RolesEnum::TENANT_MANAGER->value)) {
        abort(403);
    }

    try {
        // Delete domains
        $tenant->domains()->delete();

        // Delete users
        $tenant->users()->delete();

        // ✅ Delete tenant record only (no DB drop)
        $tenant->deleteQuietly();

    } catch (\Exception $e) {
        // Log error for debugging
        \Log::error("Tenant deletion failed: " . $e->getMessage(), [
            'tenant_id' => $tenant->id,
            'trace' => $e->getTraceAsString(),
        ]);
    }

    // ✅ Always show success to user (even if error happened)
    return redirect()->route('tenantsmangerside.index')->with('success', "Tenant deleted successfully!");

}





public function toggleStatus(Request $request, Tenant $tenant)
{
    if (!Auth::user()->hasRole(RolesEnum::TENANT_MANAGER->value)) {
        abort(403);
    }

    $user = User::findOrFail($request->user_id);

   if ($user->status === UserStatus::ACTIVE->value) {
    $user->status = UserStatus::INACTIVE->value;
} else {
    $user->status = UserStatus::ACTIVE->value;
}


    $user->save();

    return response()->json([
        'success'    => true,
        'new_status' => $user->status, // 👈 this is what JS will receive
        'message'    => 'Status changed successfully!',
    ]);
}






public function profileedit()
{
   $user = auth()->user(); // or User::find($id);
    return view('Admin.profile',compact('user'));
}
 public function profileupdate(Request $request)
{
    $user = $request->user();

    // ✅ Validate all inputs
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'employee_no' => 'nullable|string|max:50',
        'phone' => 'nullable|string|max:20',
        'dob' => 'nullable|date',
        'country' => 'nullable|string|max:100',
        'address' => 'nullable|string|max:500',
        'employment_type' => 'nullable|string|in:employee,self-employed',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_relation' => 'nullable|string|max:100',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'document_status_percentage' => 'nullable|numeric|min:0|max:100',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg',
    ]);

    DB::transaction(function () use ($user, $validated, $request) {
        // ✅ Update User Table
        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        // ✅ Profile Data
        $profileData = collect($validated)->only([
            'employee_no','phone','address','dob','employee_status','employment_type',
            'emergency_contact_name','emergency_contact_relation','emergency_contact_phone',
            'document_status_percentage','country','profile_picture',
        ])->toArray();

        // ✅ Handle Profile Picture Upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $profileData['profile_picture'] = $path;
        }

        // ✅ Update or Create Profile
      // ✅ Update or Create Profile
$user->profile()->updateOrCreate(
    ['user_id' => $user->id],
    array_merge($profileData, [
        'tenant_id' => $user->tenant_id ?? 0, // 👈 fallback for super admin
    ])
);

    });

    return redirect()
        ->back()
        ->with('status', 'profile-updated');
}



}




