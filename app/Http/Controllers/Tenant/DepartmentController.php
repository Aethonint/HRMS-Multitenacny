<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Designation;

use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
    // Index
    public function index()
{
    $tenantId = auth()->user()->tenant_id;
    $departments = Department::where('tenant_id', $tenantId)
        ->with('head')
        ->paginate(10);

    return view('tenants.sites.departments.index', compact('departments'));
}

public function create()
{
    $tenantId = auth()->user()->tenant_id;
    $users = User::where('tenant_id', $tenantId)->get();

    return view('tenants.sites.departments.create', compact('users'));
}


    // Store
    public function store(Request $request)
    {
        $tenantId = Auth::user()->tenant_id;

        $request->validate([
            'name' => 'required|string|max:255',
            'head_id' => 'nullable|exists:users,id',
            
        ]);

        Department::create([
            'tenant_id' => $tenantId,
            'name' => $request->name,
            'head_of_department' => $request->head_id,
            
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    // Edit
    public function edit($id)
    {
        $tenantId = Auth::user()->tenant_id;
        $department = Department::where('tenant_id', $tenantId)->findOrFail($id);

        $users = User::where('tenant_id', $tenantId)->get();

        return view('tenants.sites.departments.edit', compact('department', 'users'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $tenantId = Auth::user()->tenant_id;
        $department = Department::where('tenant_id', $tenantId)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'head_id' => 'nullable|exists:users,id',
            
        ]);

        $department->update([
            'name' => $request->name,
            'head_id' => $request->head_id,
            
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    // Destroy
    public function destroy($id)
    {
        $tenantId = Auth::user()->tenant_id;
        $department = Department::where('tenant_id', $tenantId)->findOrFail($id);

        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}

