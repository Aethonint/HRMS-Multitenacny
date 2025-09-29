@extends('Admin.app')
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Sites</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="">
                                <i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">Sites</a>
                        </li>
                        <li class="breadcrumb-item active">Add Site</li>
                    </ul>
                </div>
            </div>
        </div>

        @php
            $appUrl = parse_url(config('app.url'), PHP_URL_HOST);
        @endphp

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Add</strong> Site</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu float-end">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('tenants.store') }}" method="POST">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        <div class="form-line">
                                            <input type="text" id="site_name" name="site_name" class="form-control"
                                                placeholder="Enter Site Name" value="{{ old('site_name') }}">
                                        </div>
                                        @error('site_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="domain">Domain</label>
                                        <div class="form-line d-flex align-items-center">
                                            <input type="text" id="domain" name="domain" class="form-control"
                                                placeholder="example" value="{{ old('domain') }}">
                                            <span class="ml-2">.{{ $appUrl }}</span>
                                        </div>
                                        @error('domain')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="first_name">Admin First Name</label>
                                        <div class="form-line">
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                placeholder="Enter Admin First Name" value="{{ old('first_name') }}">
                                        </div>
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="last_name">Admin Last Name</label>
                                        <div class="form-line">
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                placeholder="Enter Admin Last Name" value="{{ old('last_name') }}">
                                        </div>
                                        @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Admin Email</label>
                                        <div class="form-line">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter Admin Email" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter Password">
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <div class="form-line">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                                placeholder="Confirm Password">
                                        </div>
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
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

@endsection
