@extends('tenants.sites.app')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">User Details</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href="{{ route('tenant.users.index') }}"><i class="fas fa-users"></i> Users</a>
                    </li>
                    <li class="breadcrumb-item active">View User</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2><strong>{{ $user->first_name }} {{ $user->last_name }}</strong></h2>
                    <a href="{{ route('tenant.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>First Name:</strong> {{ $user->first_name }}</p>
                            <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Phone:</strong> {{ $user->profile->phone ?? '-' }}</p>
                            <p><strong>Address:</strong> {{ $user->profile->address ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong>
                                <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </p>
                            <p><strong>Role:</strong>
                                {{ $user->roles->pluck('name')->implode(', ') ?: '-' }}
                            </p>
                            <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
                            <p><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
