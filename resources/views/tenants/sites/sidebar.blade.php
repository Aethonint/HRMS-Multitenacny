<aside id="leftsidebar" class="sidebar">
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <!-- User Panel -->
            <li class="sidebar-user-panel active">
                <div class="user-panel">
                    <div class="image">
                        @if(optional(Auth::user()->profile)->profile_picture)
                        <img 
                            src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}" 
                            class="user-img-style" 
                            alt="User Image" />
                        @else
                        <img src="{{ asset('default-avatar.png') }}" class="user-img-style" alt="Default Picture" width="100">
                        @endif
                    </div>
                </div>
                <div class="profile-usertitle">
                    <div class="sidebar-userpic-name">
                        {{ Auth::user()->first_name ?? 'Guest' }} {{ Auth::user()->last_name ?? 'Guest' }}
                    </div>
                    <div class="profile-usertitle-job">
                        {{ Auth::user()->getRoleNames()->first() ?? 'Guest' }}
                    </div>
                </div>
            </li>

            <!-- Dashboard -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- People -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="user"></i>
                    <span>People</span>
                </a>
                <ul class="ml-menu">
                     <li><a href="{{ route('employee.index') }}">All Employee</a></li>
                    <li><a href="{{ asset('admin/pages/employee/all-employees.html') }}">Employee Profiles</a></li>
                    <li><a href="{{ asset('admin/pages/employee/org-chart.html') }}">Org Chart</a></li>
                    <li><a href="{{ asset('admin/pages/employee/docs.html') }}">Employee Documents</a></li>
                     <li><a href="{{ route('departments.index') }}">Departments</a></li>
                    <li><a href="{{ route('designations.index') }}">Designations</a></li>
                    
                </ul>
            </li>

            <!-- Onboarding -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="user-plus"></i>
                    <span>Onboarding</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/onboarding/offer-letters.html') }}">Offer Letters</a></li>
                    <li><a href="{{ asset('admin/pages/onboarding/checklist.html') }}">New Starter Checklist</a></li>
                    <li><a href="{{ asset('admin/pages/onboarding/docs-collection.html') }}">Document Collection</a></li>
                    <li><a href="{{ asset('admin/pages/onboarding/welcome-pack.html') }}">Welcome Pack</a></li>
                    <li><a href="{{ asset('admin/pages/onboarding/progress-dashboard.html') }}">Progress Dashboard</a></li>
                </ul>
            </li>

            <!-- Time Off -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="clock"></i>
                    <span>Time Off</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/timeoff/leave-requests.html') }}">Leave Requests</a></li>
                    <li><a href="{{ asset('admin/pages/timeoff/leave-balances.html') }}">Leave Balances</a></li>
                    <li><a href="{{ asset('admin/pages/timeoff/holiday-calendar.html') }}">Holiday Calendar</a></li>
                    <li><a href="{{ asset('admin/pages/timeoff/policy-setup.html') }}">Leave Policies</a></li>
                </ul>
            </li>

            <!-- Attendance -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="book-open"></i>
                    <span>Attendance</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/attendance/checkin-out.html') }}">Check In / Out</a></li>
                    <li><a href="{{ asset('admin/pages/attendance/timesheets.html') }}">Timesheets</a></li>
                    <li><a href="{{ asset('admin/pages/attendance/absence.html') }}">Absence Tracking</a></li>
                    <li><a href="{{ asset('admin/pages/attendance/reports.html') }}">Attendance Reports</a></li>
                </ul>
            </li>

            <!-- Payroll -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="dollar-sign"></i>
                    <span>Payroll (Lite)</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/payroll/salary-records.html') }}">Salary Records</a></li>
                    <li><a href="{{ asset('admin/pages/payroll/payslips.html') }}">Payslips</a></li>
                    <li><a href="{{ asset('admin/pages/payroll/deductions-allowances.html') }}">Deductions & Allowances</a></li>
                    <li><a href="{{ asset('admin/pages/payroll/export.html') }}">Export Payroll</a></li>
                    <li><a href="{{ asset('admin/pages/payroll/history.html') }}">Payroll History</a></li>
                </ul>
            </li>

            <!-- Performance -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="trending-up"></i>
                    <span>Performance</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/performance/review-cycles.html') }}">Review Cycles</a></li>
                    <li><a href="{{ asset('admin/pages/performance/goals-kpis.html') }}">Goals & KPIs</a></li>
                    <li><a href="{{ asset('admin/pages/performance/feedback.html') }}">Feedback Notes</a></li>
                    <li><a href="{{ asset('admin/pages/performance/ratings.html') }}">Ratings</a></li>
                    <li><a href="{{ asset('admin/pages/performance/history.html') }}">Performance History</a></li>
                </ul>
            </li>

            <!-- Compliance -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="shield"></i>
                    <span>Compliance & Documents</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/compliance/policies.html') }}">HR Policies</a></li>
                    <li><a href="{{ asset('admin/pages/compliance/contracts.html') }}">Contracts & Agreements</a></li>
                    <li><a href="{{ asset('admin/pages/compliance/visa-docs.html') }}">Right-to-Work Docs</a></li>
                    <li><a href="{{ asset('admin/pages/compliance/expiry-alerts.html') }}">Expiry Alerts</a></li>
                    <li><a href="{{ asset('admin/pages/compliance/audit-trail.html') }}">Audit Trail</a></li>
                </ul>
            </li>

            <!-- Reports -->
            <li>
                <a href="#" onClick="return false;" class="menu-toggle">
                    <i data-feather="bar-chart-2"></i>
                    <span>Reports & Analytics</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="{{ asset('admin/pages/reports/headcount-report.html') }}">Headcount Report</a></li>
                    <li><a href="{{ asset('admin/pages/reports/leave-report.html') }}">Leave Report</a></li>
                    <li><a href="{{ asset('admin/pages/reports/attendance-report.html') }}">Attendance Report</a></li>
                    <li><a href="{{ asset('admin/pages/reports/payroll-report.html') }}">Payroll Report</a></li>
                    <li><a href="{{ asset('admin/pages/reports/performance-analytics.html') }}">Performance Analytics</a></li>
                    <li><a href="{{ asset('admin/pages/reports/export-options.html') }}">Export Options</a></li>
                </ul>
            </li>

            <!-- Settings -->
            <li>
    <a href="#" onClick="return false;" class="menu-toggle">
        <i data-feather="settings"></i>
        <span>Settings</span>
    </a>
    <ul class="ml-menu">

        <!-- SYSTEM -->
        <li>
            <a href="#" onClick="return false;" class="menu-toggle">SYSTEM</a>
            <ul class="ml-menu">
                <li><a href="#">Domain Settings</a></li>
                <li><a href="#">Integrations</a></li>
            </ul>
        </li>

        <!-- COMPANY -->
        <li>
            <a href="#" onClick="return false;" class="menu-toggle">COMPANY</a>
            <ul class="ml-menu">
                <li><a href="{{route('setting.site.units')}}">Org Units</a></li>
                <li><a href="#">Job Titles</a></li>
                <li><a href="#">People</a></li>
                <li><a href="#">Holidays</a></li>
                <li><a href="#">Benefits</a></li>
            </ul>
        </li>

        <!-- FEATURES -->
        <li>
            <a href="#" onClick="return false;" class="menu-toggle">FEATURES</a>
            <ul class="ml-menu">
                <li><a href="#">Time Off</a></li>
                <li><a href="#">Time Tracking</a></li>
                <li><a href="#">Task Management</a></li>
                <li><a href="#">Assets</a></li>
                <li><a href="#">Safe Voice</a></li>
            </ul>
        </li>

    </ul>
</li>

        </ul>
    </div>
    <!-- #Menu -->
</aside>
