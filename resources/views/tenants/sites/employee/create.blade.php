@extends('tenants.sites.app')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Employees</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Employee</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Show global validation errors --}}
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input:
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Add</strong> Employee</h2>
                </div>

                <div class="body">
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf

                        <!-- ================= Personal Information ================= -->
                        <h5 class="mt-3">Personal Information</h5>
                        <div class="row clearfix">
                            <!-- First Name -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" 
                                           name="first_name" 
                                           class="form-control @error('first_name') is-invalid @enderror" 
                                           value="{{ old('first_name') }}"
                                           placeholder="Enter First Name" >
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" 
                                           name="last_name" 
                                           class="form-control @error('last_name') is-invalid @enderror" 
                                           value="{{ old('last_name') }}"
                                           placeholder="Enter Last Name" >
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Email -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}"
                                           placeholder="Enter Email" >
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Hire Date -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="hire_date">Hire Date</label>
                                    <input type="date" 
                                           name="hire_date" 
                                           class="form-control @error('hire_date') is-invalid @enderror" 
                                           value="{{ old('hire_date') }}"
                                           >
                                    @error('hire_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Employment Status -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="employment_status">Employment Status</label>
                                    <select name="employment_status" 
                                            class="form-control @error('employment_status') is-invalid @enderror" 
                                            >
                                        <option value="">-- Select Status --</option>
                                        <option value="Full-Time" {{ old('employment_status') == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                        <option value="Part-Time" {{ old('employment_status') == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                        <option value="Contract" {{ old('employment_status') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                        <option value="Intern" {{ old('employment_status') == 'Intern' ? 'selected' : '' }}>Intern</option>
                                        <option value="Volunteer" {{ old('employment_status') == 'Volunteer' ? 'selected' : '' }}>Volunteer</option>
                                        <option value="Other" {{ old('employment_status') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('employment_status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" 
                                           name="phone" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone') }}"
                                           placeholder="Enter Phone Number">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- ================= Job Information ================= -->
                        <h5 class="mt-4">Job Information</h5>
                        <div class="row clearfix">
                            <!-- Manager -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="manager_id">Manager</label>
                                    <select name="manager_id" class="form-control @error('manager_id') is-invalid @enderror">
                                        <option value="">-- Select Manager --</option>
                                        @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>
                                                {{ $manager->first_name }} {{ $manager->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('manager_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="department_id" 
                                            class="form-control @error('department_id') is-invalid @enderror" 
                                            >
                                        <option value="">-- Select Department --</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Designation -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="designation_id">Designation</label>
                                    <select name="designation_id" id="designation_id" 
                                            class="form-control @error('designation_id') is-invalid @enderror" 
                                            >
                                        <option value="">-- Select Designation --</option>
                                    </select>
                                    @error('designation_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Employment Type -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="employment_type">Employment Type</label>
                                    <select name="employment_type" 
                                            class="form-control @error('employment_type') is-invalid @enderror">
                                        <option value="">-- Select Type --</option>
                                        <option value="Hybrid" {{ old('employment_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        <option value="Onsite" {{ old('employment_type') == 'Onsite' ? 'selected' : '' }}>Onsite</option>
                                        <option value="Remote" {{ old('employment_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                    </select>
                                    @error('employment_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" 
                                              class="form-control @error('address') is-invalid @enderror" 
                                              placeholder="Enter Address">{{ old('address') }}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label>Password</label>
                                <input type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror" >
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" >
                            </div>
                        </div>

                        <div class="col-lg-12 p-t-20 text-start">
                            <button type="submit" class="btn btn-primary waves-effect m-r-15">Submit</button>
                            <button type="reset" class="btn btn-danger waves-effect">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
