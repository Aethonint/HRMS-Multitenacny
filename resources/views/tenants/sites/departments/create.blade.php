@extends('tenants.sites.app')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Departments</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Department</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Add</strong> Department</h2>
                </div>

                <div class="body">
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="row clearfix">
                            <!-- Department Name -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Department Name</label>
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" placeholder="Enter Department Name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Head of Department -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="head_id">Head of Department</label>
                                    <div class="form-line">
                                        <select name="head_id" id="head_id" class="form-control">
                                            <option value="">-- Select Head --</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('head_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('head_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                          <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Description </label>
                                    <div class="form-line">
                                        <textarea type="text" name="description" class="form-control" placeholder="Enter Description " value="{{ old('description') }}"> </textarea>
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
