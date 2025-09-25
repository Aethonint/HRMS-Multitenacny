<?php

namespace App\Http\Controllers\Auth;
use App\Models\Tenant;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\RolesEnum;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
     public function site(): View
    {
        return view('tenants.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(Request $request): RedirectResponse
{
    // Validate the incoming request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Add tenant_id if available
    $credentials = $request->only('email', 'password');
    
    if ($tenantId = tenant('id')) {
        $credentials['tenant_id'] = $tenantId;

        // Check if the user is active and has the appropriate roles within the tenant context
        $checkSiteUser = User::where('status', 'active')
            ->where('tenant_id', $tenantId)
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', [
                    RolesEnum::TENANT_MANAGER->value, 
                    RolesEnum::MANAGER->value, 
                    RolesEnum::STAFF->value, 
                    RolesEnum::SITE_MANAGER->value, 
                    RolesEnum::HR_MANAGER->value, 
                    RolesEnum::ACCOUNT_MANAGER->value
                ]);
            })
            ->first(); // Fetch a user if one exists with the status 'active' and valid role

        // If no active site user exists, return error
        if (!$checkSiteUser) {
            return back()->withInput()->withErrors([
                'email' => 'This site is inactive or you do not have access. Please contact support.',
            ]);
        }
    }

    // Attempt to authenticate the user
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $user = Auth::user();

        // Ensure that the user's status is 'active'
        if ($user->status !== 'active') {
            Auth::logout(); // Log the user out if the account is inactive
            return back()->withInput()->withErrors([
                'email' => 'Your account is inactive. Please contact support.',
            ]);
        }

        // Redirect user to their respective dashboard after successful login
        return $this->redirectUser($user);
    }

    // Authentication failed: the credentials didn't match
    return back()->withInput()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

private function redirectUser($user): RedirectResponse
{
    // Check the user's role and redirect accordingly
    if ($user->hasRole(RolesEnum::TENANT_MANAGER->value)) {
        // Redirect to tenant manager dashboard
        return redirect()->intended(route('tenants.dashboard'));  // This route should point to the tenant dashboard
    } elseif ($user->hasRole(RolesEnum::SITE_MANAGER->value)) {
        // Redirect to site manager dashboard
        return redirect()->intended(route('site.dashboard'));
    } elseif ($user->hasRole(RolesEnum::MANAGER->value) || $user->hasRole(RolesEnum::STAFF->value)) {
        // Redirect to staff manager dashboard
        return redirect()->intended(route('staff.dashboard'));
    } elseif ($user->hasRole(RolesEnum::HR_MANAGER->value)) {
        // Redirect to HR manager dashboard
        return redirect()->intended(route('hr.dashboard'));
    } elseif ($user->hasRole(RolesEnum::ACCOUNT_MANAGER->value)) {
        // Redirect to account manager dashboard
        return redirect()->intended(route('account.dashboard'));
    }

    // Fallback redirect if no role matches
    return redirect()->intended(route('/'));  // Redirect to a default route (home or login page)
}

// public function store(Request $request): RedirectResponse
// {
//     // Validate the incoming request data
//     $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     // Add tenant_id if available
//     $credentials = $request->only('email', 'password');
    
//     if ($tenantId = tenant('id')) {
//         $credentials['tenant_id'] = $tenantId;

//         // Check if the user is active and has the appropriate roles within the tenant context
//         $checkSiteUser = User::where('status', 'active')
//             ->where('tenant_id', $tenantId)
//             ->whereHas('roles', function ($query) {
//                 $query->whereIn('name', [
//                     'tenant_manager', 'manager', 'staff', 'site_manager', 'hr_manager', 'account_manager'
//                 ]);
//             })
//             ->first(); // Fetch a user if one exists with the status 'active' and valid role

//         // If no active site user exists, return error
//         if (!$checkSiteUser) {
//             return back()->withInput()->withErrors([
//                 'email' => 'This site is inactive or you do not have access. Please contact support.',
//             ]);
//         }
//     }

//     // Attempt to authenticate the user
//     if (Auth::attempt($credentials, $request->boolean('remember'))) {
//         $user = Auth::user();

//         // Check if the user's status is 'active'
//         if ($user->status !== 'active') {
//             Auth::logout();
//             return back()->withInput()->withErrors([
//                 'email' => 'Your account is inactive. Please contact support.',
//             ]);
//         }

//         // Redirect user to their respective dashboard after successful login
//         return $this->redirectUser($user);
//     }

//     // Authentication failed, redirect back with an error
//     return back()->withInput()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ]);
// }

// private function redirectUser($user): RedirectResponse
// {
//     // Check the user's role and redirect accordingly
//     if ($user->hasRole('superadmin')) {
//         // Redirect to superadmin dashboard
//         return redirect()->intended(route('admin.dashboard'));
//     } elseif ($user->hasRole('tenant_manager') || $user->hasRole('site_manager')) {
//         // Redirect to site manager dashboard
//         return redirect()->intended(route('site.dashboard'));
//     } elseif ($user->hasRole('manager') || $user->hasRole('staff')) {
//         // Redirect to staff manager dashboard
//         return redirect()->intended(route('staff.dashboard'));
//     } elseif ($user->hasRole('hr_manager')) {
//         // Redirect to HR manager dashboard
//         return redirect()->intended(route('hr.dashboard'));
//     } elseif ($user->hasRole('account_manager')) {
//         // Redirect to account manager dashboard
//         return redirect()->intended(route('account.dashboard'));
//     }

//     // Fallback redirect in case none of the roles match (optional)
//     return redirect()->intended(route('/'));
// }



// private function redirectUser($user): RedirectResponse
// {
//     // Check the user's role and redirect accordingly
//     if ($user->hasRole('superadmin')) {
//         // Redirect to superadmin dashboard
//         return redirect()->intended(route('admin.dashboard'));
//     } elseif ($user->hasRole('tenant_manager') || $user->hasRole('site_manager')) {
//         // Redirect to site manager dashboard
//         return redirect()->intended(route('site.dashboard'));
//     } elseif ($user->hasRole('manager') || $user->hasRole('staff')) {
//         // Redirect to staff manager dashboard
//         return redirect()->intended(route('staff.dashboard'));
//     } elseif ($user->hasRole('hr_manager')) {
//         // Redirect to HR manager dashboard
//         return redirect()->intended(route('hr.dashboard'));
//     } elseif ($user->hasRole('account_manager')) {
//         // Redirect to account manager dashboard
//         return redirect()->intended(route('account.dashboard'));
//     }

//     // Fallback redirect in case none of the roles match (optional)
//     return redirect()->intended(route('default.dashboard'));
// }

   public function destroy(Request $request)
    {
        Auth::logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/'); // Redirect to login page
    }

    /**
     * Destroy an authenticated session.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
}
