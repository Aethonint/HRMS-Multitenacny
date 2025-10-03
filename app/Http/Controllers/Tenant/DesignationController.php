<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id; // get current tenant ID

        $designations = Designation::with('department')
            ->where('tenant_id', $tenantId)
            ->paginate(10);

        return view('tenants.sites.designation.index', compact('designations'));
    }

public function create()
{
    $tenantId = auth()->user()->tenant_id;

    $departments = Department::where('tenant_id', $tenantId)->get();
    $designations = Designation::where('tenant_id', $tenantId)->with('department')->get();

    return view('tenants.sites.designation.create', compact('departments', 'designations'));
}



    public function store(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Designation::create([
            'tenant_id'     => $tenantId,
            'department_id' => $request->department_id,
            'title'         => $request->title,
            'description'   => $request->description,
             'added_by' => Auth::id(),
        ]);

        return redirect()->route('designations.index')
            ->with('success', 'Designation created successfully.');
    }

    public function show(Designation $designation)
    {
        $this->authorizeTenant($designation);

        return view('sites.designation.show', compact('designation'));
    }

    public function edit(Designation $designation)
    {
        $this->authorizeTenant($designation);

        $departments = Department::where('tenant_id', auth()->user()->tenant_id)->get();

        return view('tenants.sites.designation.edit', compact('designation', 'departments'));
    }

    public function update(Request $request, Designation $designation)
    {
        $this->authorizeTenant($designation);

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $designation->update([
            'department_id' => $request->department_id,
            'title'         => $request->title,
            'description'   => $request->description,
        ]);

        return redirect()->route('designations.index')
            ->with('success', 'Designation updated successfully.');
    }

    public function destroy(Designation $designation)
    {
        $this->authorizeTenant($designation);

        $designation->delete();

        return redirect()->route('designations.index')
            ->with('success', 'Designation deleted successfully.');
    }

    /**
     * Ensure designation belongs to logged-in tenant
     */
    private function authorizeTenant(Designation $designation)
    {
        if ($designation->tenant_id !== auth()->user()->tenant_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
