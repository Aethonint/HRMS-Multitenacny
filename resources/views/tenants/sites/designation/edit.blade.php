@extends('tenants.sites.app')

@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Designations</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Designation</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Edit</strong> Designation</h2>
                </div>

                <div class="body">
                    <form action="{{ route('designations.update', $designation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <!-- Department -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <div class="form-line">
                                        <select name="department_id" id="department_id" class="form-control">
                                            <option value="">-- Select Department --</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ (old('department_id', $designation->department_id) == $department->id) ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <div class="form-line">
                                        <input type="text" name="title" class="form-control" 
                                               placeholder="Enter Designation Title"
                                               value="{{ old('title', $designation->title) }}">
                                    </div>
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            </div>

                        <div class="row clearfix">
                            <!-- Description -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div class="form-line">
                                        <textarea name="description" class="form-control" placeholder="Enter Description">{{ old('description', $designation->description) }}</textarea>
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 p-t-20 text-start">
                            <button type="submit" class="btn btn-primary waves-effect m-r-15">Update</button>
                            <a href="{{ route('designations.index') }}" class="btn btn-danger waves-effect">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
