@extends('tenants.sites.app')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">All Departments</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item bcrumb-2">
                        <a href="#" onClick="return false;">Departments</a>
                    </li>
                    <li class="breadcrumb-item active">All Departments</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2><strong>All</strong> Departments</h2>
                    <a href="{{ route('departments.create') }}" class="btn btn-info btn-lg">
                        <i class="fas fa-plus fa-lg"></i> Add Department
                    </a>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table id="basicTable" class="table table-hover table-checkable order-column">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">Department Name</th>
                                    <th class="center">Head</th>
                                    <th class="center">Description</th>
                                    <th class="center">Added By</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($departments as $key => $dept)
                                    <tr class="odd gradeX">
                                        <td class="center">{{ $key + 1 }}</td>
                                        <td class="center">{{ $dept->name }}</td>
                                        <td class="center">{{ $dept->head->first_name ?? '-' }} {{ $dept->head->last_name ?? '' }}</td>
                                          <td class="center">{{ $dept->description ?? '-' }}</td>
                                         <td class="center">{{ $dept->added_by ?? '-' }}</td>
                                        <td class="center">
                                            <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-tbl-edit">
                                                <i class="material-icons">create</i>
                                            </a>
                                            <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-tbl-delete">
                                                    <i class="material-icons">delete_forever</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No departments found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $departments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
