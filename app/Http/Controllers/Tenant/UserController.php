<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;


use App\UserStatus;
use App\RolesEnum;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        // $users = User::with('profile', 'roles')->where('tenant_id', tenant('id'))->get();
          $users = User::with(['profile', 'roles'])
        ->where('tenant_id', tenant('id'))
        ->where('id', '!=', auth()->id()) // exclude logged-in user
        ->get();
        return view('tenants.sites.roles.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['tenant_manager', 'site_manager','hr_manager','account_manager','manager','staff'])->get();

        return view('tenants.sites.roles.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role'       => 'required|string|exists:roles,name',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string|max:255',
            'status'     => 'required|in:active,inactive',
           'password' => 'required|confirmed|min:8', // ✅ confirms with password_confirmation
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'status'     => $request->status,
            'password'   => Hash::make($request->password),
            'tenant_id'  => tenant('id'),
        ]);

        $user->assignRole($request->role);

        Profile::create([
            'user_id'   => $user->id,
            'tenant_id' => tenant('id'),
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        return redirect()->route('tenant.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->authorizeUser($user);
        $roles = Role::whereNotIn('name', ['tenant_manager', 'site_manager'])->get();
        return view('tenants.sites.roles.edit', compact('user', 'roles'));
    }
    public function show(User $user)
{
    $user->load('profile', 'roles'); // eager load profile + roles

    return view('tenants.sites.roles.show', compact('user'));
}


    public function update(Request $request, User $user)
    {
        $this->authorizeUser($user);

        $request->validate([
            'role'       => 'required|string|exists:roles,name',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'status'     => 'required|in:active,inactive',
            'password'   => 'nullable|string|min:6|confirmed',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'status'     => $request->status,
            'password'   => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        $user->syncRoles([$request->role]);

        $user->profile->update([
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('tenant.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorizeUser($user);
        $user->delete();
        return redirect()->route('tenant.users.index')->with('success', 'User deleted successfully.');
    }

    private function authorizeUser(User $user)
    {
        if ($user->tenant_id !== tenant('id')) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function toggleStatus(User $user)
{
     if (!Auth::user()->hasRole(RolesEnum::SITE_MANAGER->value)) {
            abort(code: 403);
        }
    $user->status = $user->status === 'active' ? 'inactive' : 'active';
    $user->save();

    return redirect()->route('tenant.sites.roles.index')->with('success', 'User status updated successfully.');
}

}
