<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Designation;
use App\UserStatus;
use App\RolesEnum;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\User;

class EmployeeController extends Controller
{
   public function index()
   {
    return view('tenants.sites.employee.index');
   }
     public function create()
   {
    $tenantId = auth()->user()->tenant_id;

    $managers = User::role('admin')
        ->where('tenant_id', $tenantId)
        ->where('status', 'active')
        ->get();

    $departments = Department::where('tenant_id', $tenantId)->get();
    return view('tenants.sites.employee.create',compact('managers','departments'));
   }




public function store(Request $request)
{$request->validate([
    'first_name'        => 'required|string|max:255',
    'last_name'         => 'required|string|max:255',
    'email'             => [
        'required',
        'email',
        Rule::unique('users')->where(function ($query) {
            return $query->where('tenant_id', Auth::user()->tenant_id);
        }),
    ],
    'hire_date'         => 'required|date',
    'employment_status' => 'required|string|in:Full-Time,Part-Time,Contract,Intern,Volunteer,Other',
    'phone'             => 'required|string|max:20',
    'department_id'     => 'required|exists:departments,id',
    'designation_id'    => 'required|exists:designations,id',
    'employment_type'   => 'required|string|in:Hybrid,Onsite,Remote',
    'address'           => 'required|string|max:500',
    'password'          => 'required|confirmed|min:6',
    'manager_id'        => 'nullable|exists:users,id', // keep manager optional
]);

    // Step 1: Create User
    $user = User::create([
        'first_name'        => $request->first_name,
        'last_name'         => $request->last_name,
        'email'             => $request->email,
        'joining_date'      => $request->hire_date,
        'employment_status' => $request->employment_status,
        'employment_type'   => $request->employment_type,
        'manager_id'        => $request->manager_id,
        'department_id'     => $request->department_id,
        'designation_id'    => $request->designation_id,
        'password'          => bcrypt($request->password),
        'tenant_id'         => Auth::user()->tenant_id,
        'status'            => UserStatus::ACTIVE->value,
    ]);

    // Step 2: Assign default role
    $user->assignRole(RolesEnum::STAFF->value);

    // Step 3: Create Profile
    $user->profile()->create([
        'phone'   => $request->phone,
        'address' => $request->address,
         'tenant_id'         => Auth::user()->tenant_id,
    ]);

    return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
}


































public function getDesignations($id)
{
    $designations = \App\Models\Designation::where('department_id', $id)
        ->where('tenant_id', auth()->user()->tenant_id) // ✅ tenant safe
        ->get(['id', 'title']);

    return response()->json($designations);
}


}
