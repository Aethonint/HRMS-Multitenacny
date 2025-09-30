@extends('tenants.sites.app')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Edit User</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Edit</strong> User</h2>
                </div>

                <div class="body">
                    <form action="{{ route('tenant.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <!-- Role -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <div class="form-line">
                                        <select name="role" id="role" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}" 
                                                    {{ $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- First Name -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <div class="form-line">
                                        <input type="text" name="first_name" class="form-control" 
                                               value="{{ old('first_name', $user->first_name) }}">
                                    </div>
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Last Name -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <div class="form-line">
                                        <input type="text" name="last_name" class="form-control" 
                                               value="{{ old('last_name', $user->last_name) }}">
                                    </div>
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control" 
                                               value="{{ old('email', $user->email) }}">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Phone -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <div class="form-line">
                                        <input type="text" name="phone" class="form-control" 
                                               value="{{ old('phone', $user->profile->phone ?? '') }}">
                                    </div>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="form-line">
                                        <input type="text" name="address" class="form-control" 
                                               value="{{ old('address', $user->profile->address ?? '') }}">
                                    </div>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Status -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="form-line">
                                        <select name="status" id="status" class="form-control">
                                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">New Password (leave empty if not changing)</label>
                                    <div class="form-line">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <!-- Confirm Password -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <div class="form-line">
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 p-t-20 text-start">
                            <button type="submit" class="btn btn-primary waves-effect m-r-15">Update</button>
                            <a href="{{ route('tenant.users.index') }}" class="btn btn-danger waves-effect">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
