<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\RolesEnum;
use Illuminate\Support\Facades\Storage;
class SiteController extends Controller
{
    public function index()
    {
        return view('tenants.sites.dashboard');
    }
    public function profileedit()
    {
          $user = auth()->user()->load('profile'); // load profile relation
        return view('tenants.sites.profile',compact('user'));
    }
public function profileupdate(Request $request)
{
    $user = $request->user();

    // ✅ Validate inputs
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
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp',
    ]);

    DB::transaction(function () use ($user, $validated, $request) {
        // ✅ Update User table
        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        // ✅ Profile Data
        $profileData = collect($validated)->only([
            'employee_no',
            'phone',
            'address',
            'dob',
            'employment_type',
            'emergency_contact_name',
            'emergency_contact_relation',
            'emergency_contact_phone',
            'document_status_percentage',
            'country',
        ])->toArray();

          // ✅ Always include tenant_id (required field)
        $profileData['tenant_id'] = $user->tenant_id ?? tenant('id');

    
if ($request->hasFile('profile_picture')) {
    // delete old file if present
    if ($user->profile && $user->profile->profile_picture) {
        Storage::disk('global_public')->delete($user->profile->profile_picture);
    }

    // store new file in storage/app/public/profile_pictures
    $path = $request->file('profile_picture')->store('profile_pictures', 'global_public');

    // save only the relative path to DB: "profile_pictures/abc.png"
    $profileData['profile_picture'] = $path;
     // ✅ Always include tenant_id
       
}

        // ✅ Update or create profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );
    });

    return redirect()
        ->back()
        ->with('success', 'Profile updated successfully.');
}
public function updateLogo(Request $request)
{
    $user = $request->user();

    // ✅ Only allow SITE_MANAGER role
    if (! $user->hasRole(RolesEnum::SITE_MANAGER->value)) {
        abort(403, 'Only site managers can update tenant logo.');
    }

    $tenant = function_exists('tenant') ? tenant() : $user->tenant;

    $request->validate([
        'logo' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:4096',
    ]);

    // Delete old logo if exists
    if ($tenant->logo) {
        Storage::disk('global_public')->delete($tenant->logo);
    }

    // Store new logo under "logos/{tenant_id}"
    $path = $request->file('logo')->store("logos/{$tenant->id}", 'global_public');

    $tenant->update(['logo' => $path]);

    return back()->with('success', 'Tenant logo updated successfully.');
}



}
