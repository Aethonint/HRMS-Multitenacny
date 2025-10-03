@extends('tenants.sites.app')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">All Users</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item bcrumb-2">
                        <a href="#" onClick="return false;">Users</a>
                    </li>
                    <li class="breadcrumb-item active">All Users</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2><strong>All</strong> Users</h2>
                    <a href="{{ route('tenant.users.create') }}" class="btn btn-info btn-lg">
                        <i class="fas fa-plus fa-lg"></i>  Admin
                    </a>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table id="basicTable" class="table table-hover table-checkable order-column">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">First Name</th>
                                    <th class="center">Last Name</th>
                                    <th class="center">Email</th>
                                    <th class="center">Phone</th>
                                    <th class="center">Address</th>
                                     <th class="center">Role</th>
                                    <th class="center">Status</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                          <tbody>
    @foreach($users as $key => $user)
        <tr class="odd gradeX">
            <td class="center">{{ $key + 1 }}</td>
            <td class="center">{{ $user->first_name }}</td>
            <td class="center">{{ $user->last_name }}</td>
            <td class="center">{{ $user->email }}</td>
            <td class="center">{{ $user->profile->phone ?? '-' }}</td>
            <td class="center">{{ $user->profile->address ?? '-' }}</td>
            <!-- Role Column -->
            <td class="center">
                {{ $user->roles->pluck('name')->implode(', ') ?: '-' }}
            </td>
            <td class="center">
                <label class="switch">
                    <input type="checkbox" class="status-toggle" data-id="{{ $user->id }}" {{ $user->status == 'active' ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </td>
            <td class="center">
                <a href="{{ route('tenant.users.show', $user->id) }}" class="btn btn-tbl-edit">
                    <i class="material-icons">visibility</i>
                </a>
                <a href="{{ route('tenant.users.edit', $user->id) }}" class="btn btn-tbl-edit">
                    <i class="material-icons">create</i>
                </a>
                <form action="{{ route('tenant.users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-tbl-delete">
                        <i class="material-icons">delete_forever</i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
