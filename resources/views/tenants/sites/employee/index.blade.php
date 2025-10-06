@extends('tenants.sites.app')

@section('content')

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">All Employees</h4>
                    </li>
                    <li class="breadcrumb-item bcrumb-1">
                        <a href=""><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item bcrumb-2">
                        <a href="#" onClick="return false;">Employees</a>
                    </li>
                    <li class="breadcrumb-item active">All Employees</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2><strong>All</strong> Employees</h2>
                    <a href="{{route('employee.create')}}" class="btn btn-info btn-lg">
                        <i class="fas fa-plus fa-lg"></i> Add Employee
                    </a>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover table-checkable order-column contact_list">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">Name</th>
                                    <th class="center">Email</th>
                                    <th class="center">Phone</th>
                                    <th class="center">Department</th>
                                    <th class="center">Designation</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td class="center">1</td>
                                    <td class="center">Ali Khan</td>
                                    <td class="center">ali.khan@example.com</td>
                                    <td class="center">0300-1234567</td>
                                    <td class="center">Human Resources</td>
                                    <td class="center">HR Manager</td>
                                    <td class="center">
                                        <a href="#" class="btn btn-tbl-edit"><i class="material-icons">create</i></a>
                                        <button type="button" class="btn btn-tbl-delete"><i class="material-icons">delete_forever</i></button>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td class="center">2</td>
                                    <td class="center">Sara Malik</td>
                                    <td class="center">sara.malik@example.com</td>
                                    <td class="center">0301-7654321</td>
                                    <td class="center">Finance</td>
                                    <td class="center">Accountant</td>
                                    <td class="center">
                                        <a href="#" class="btn btn-tbl-edit"><i class="material-icons">create</i></a>
                                        <button type="button" class="btn btn-tbl-delete"><i class="material-icons">delete_forever</i></button>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td class="center">3</td>
                                    <td class="center">Usman Raza</td>
                                    <td class="center">usman.raza@example.com</td>
                                    <td class="center">0321-9876543</td>
                                    <td class="center">Marketing</td>
                                    <td class="center">Marketing Lead</td>
                                    <td class="center">
                                        <a href="#" class="btn btn-tbl-edit"><i class="material-icons">create</i></a>
                                        <button type="button" class="btn btn-tbl-delete"><i class="material-icons">delete_forever</i></button>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td class="center">4</td>
                                    <td class="center">Bilal Ahmed</td>
                                    <td class="center">bilal.ahmed@example.com</td>
                                    <td class="center">0333-1122334</td>
                                    <td class="center">IT Support</td>
                                    <td class="center">System Admin</td>
                                    <td class="center">
                                        <a href="#" class="btn btn-tbl-edit"><i class="material-icons">create</i></a>
                                        <button type="button" class="btn btn-tbl-delete"><i class="material-icons">delete_forever</i></button>
                                    </td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td class="center">5</td>
                                    <td class="center">Nida Tariq</td>
                                    <td class="center">nida.tariq@example.com</td>
                                    <td class="center">0345-6677889</td>
                                    <td class="center">Operations</td>
                                    <td class="center">Operations Manager</td>
                                    <td class="center">
                                        <a href="#" class="btn btn-tbl-edit"><i class="material-icons">create</i></a>
                                        <button type="button" class="btn btn-tbl-delete"><i class="material-icons">delete_forever</i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination Placeholder -->
                        <div class="pagination-container">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection