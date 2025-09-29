@extends('Admin.app')
@section('content')
@php
    use App\UserStatus;
@endphp
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb breadcrumb-style ">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">All Sites</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item bcrumb-2">
                        <a href="#" onClick="return false;">Sites</a>
                    </li>
                    <li class="breadcrumb-item active">All Sites</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>All</strong> Sites</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="basicTable" class="table table-hover table-checkable order-column">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">Site Name</th>
                                    <th class="center">First Name</th>
                                    <th class="center">Last Name</th>
                                    <th class="center">Email</th>
                                    <th class="center">Domain</th>
                                    <th class="center">Status</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tenants as $tenant)
                                    <tr>
                                        <td class="center">{{ $loop->iteration }}</td>
                                        <td class="center">{{ $tenant->name }}</td>
                                        <td class="center">{{ $tenant->user->first_name ?? '-'  }}</td>
                                        <td class="center">{{ $tenant->user->last_name ?? '-' }}</td>
                                        <td class="center">{{ $tenant->user->email ?? '-' }}</td>
                                       <td class="center">
    {{ $tenant->domains->pluck('domain')->implode(', ') ?: '-' }}
</td>

<td class="center">
    <label class="switch">
        <input type="checkbox"
               class="toggle-status"
               data-user-id="{{ $tenant->user->id }}"
               data-tenant-id="{{ $tenant->id }}"
               {{ $tenant->user->status === \App\UserStatus::ACTIVE->value ? 'checked' : '' }}>
        <span class="slider round"></span>
    </label>
</td>



                                        <td class="center">
                                            
                                           <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" class="delete-form" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-tbl-delete delete-btn" data-name="{{ $tenant->name }}">
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
