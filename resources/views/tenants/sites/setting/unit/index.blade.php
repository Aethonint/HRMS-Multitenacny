 @extends('tenants.sites.app')
 @section('content')
     <div class="container-fluid">
         <div class="block-header">
             <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <ul class="breadcrumb breadcrumb-style ">
                         <li class="breadcrumb-item">
                             <h4 class="page-title">Org units</h4>
                         </li>
                         <li class="breadcrumb-item bcrumb-1">
                             <a href="../../index.html">
                                 <i class="fas fa-home"></i> Home</a>
                         </li>
                         <li class="breadcrumb-item bcrumb-2">
                             <a href="#" onClick="return false;">Setting</a>
                         </li>

                         <li class="breadcrumb-item bcrumb-2">
                             <a href="#" onClick="return false;">Company</a>
                         </li>


                         <li class="breadcrumb-item active">Org units</li>
                     </ul>
                 </div>
             </div>
         </div>
         <!-- Your content goes here  -->
         <div class="row clearfix">

             <div class="col-lg-12 col-md-12">
                 <div class="">
                     <div class="profile-tab-box">
                         <div class="p-l-20">
                             <ul class="nav ">
                                 <li class="nav-item ">
                                     <a class="nav-link active show" href="#project" data-bs-toggle="tab">Departments
                                     </a>
                                 </li>
                                 <li class="nav-item  p-l-20">
                                     <a class="nav-link" href="#division" data-bs-toggle="tab">Divisions</a>
                                 </li>
                                 <li class="nav-item  p-l-20">
                                     <a class="nav-link" href="#location" data-bs-toggle="tab">Locations</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="tab-content">
                     <div role="tabpanel" class="tab-pane active" id="project" aria-expanded="true">
                         <div class="row clearfix">
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                 <div class=" project_widget">
                                     <div class="header mb-3">
                                         <!-- Add Department Button -->
                                         <a href="#" class="btn btn-lg btn-half-white" data-bs-toggle="modal"
                                             data-bs-target="#addDepartmentModal">
                                             <i class="fas fa-plus fa-lg"></i> Add Department
                                         </a>


                                         <!-- Bootstrap Modal -->
                                         <div class="modal fade" id="addDepartmentModal" tabindex="-1"
                                             aria-labelledby="addDepartmentLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered"> <!-- Centered Modal -->
                                                 <div class="modal-content rounded-5 shadow-lg">
                                                     <!-- Rounded corners here -->

                                                     <!-- Header -->
                                                     <div class="modal-header border-0">
                                                         <h5 class="modal-title fw-bold" id="addDepartmentLabel">Add
                                                             Department</h5>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                             aria-label="Close"></button>
                                                     </div>

                                                     <!-- Body -->
                                                     <div class="modal-body">
                                                         <form id="addDepartmentForm" method="POST"
                                                             action="{{ route('departments.store') }}">
                                                             @csrf
                                                             <div class="mb-3">
                                                                 <label for="departmentName" class="form-label">
                                                                     Name <span class="text-danger">*</span>
                                                                 </label>
                                                                 <input type="text" class="form-control rounded-3"
                                                                     id="departmentName" name="name" required>
                                                             </div>
                                                         </form>
                                                     </div>

                                                     <!-- Footer -->
                                                     <div class="modal-footer justify-content-between border-0">
                                                         <button type="button" class="btn btn-secondary rounded-3 px-4"
                                                             data-bs-dismiss="modal">Cancel</button>
                                                         <button type="submit" form="addDepartmentForm"
                                                             class="btn btn-primary rounded-3 px-4">Submit</button>
                                                     </div>

                                                 </div>
                                             </div>
                                         </div>

                                     </div>
                                     <div class="body">
                                         <!-- Example row -->
                                         <!-- Department Row -->
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Accounting & Finance</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>

                                         <!-- Another Row -->
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Administration & Operations</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Accounting & Finance</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>







                                     </div>
                                 </div>
                             </div>


                         </div>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="timeline" aria-expanded="false">
                     </div>
                     <div role="tabpanel" class="tab-pane" id="division" aria-expanded="false">
                         <div class="row clearfix">
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                 <div class=" project_widget">
                                     <div class="header mb-3">
                                         <!-- Add Department Button -->
                                         <a href="#" class="btn btn-lg btn-half-white" data-bs-toggle="modal"
                                             data-bs-target="#addDivisionModal">
                                             <i class="fas fa-plus fa-lg"></i> Add Divisions
                                         </a>


                                         <!-- Bootstrap Modal -->
                                         <div class="modal fade" id="addDivisionModal" tabindex="-1"
                                             aria-labelledby="addDivisionLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered"> <!-- Centered Modal -->
                                                 <div class="modal-content rounded-5 shadow-lg">
                                                     <!-- Rounded corners here -->

                                                     <!-- Header -->
                                                     <div class="modal-header border-0">
                                                         <h5 class="modal-title fw-bold" id="addDepartmentLabel">Add
                                                             Division</h5>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                             aria-label="Close"></button>
                                                     </div>

                                                     <!-- Body -->
                                                     <div class="modal-body">
                                                         <form id="addDepartmentForm" method="POST"
                                                             action="{{ route('departments.store') }}">
                                                             @csrf
                                                             <div class="mb-3">
                                                                 <label for="departmentName" class="form-label">
                                                                     Name <span class="text-danger">*</span>
                                                                 </label>
                                                                 <input type="text" class="form-control rounded-3"
                                                                     id="departmentName" name="name" required>
                                                             </div>
                                                         </form>
                                                     </div>

                                                     <!-- Footer -->
                                                     <div class="modal-footer justify-content-between border-0">
                                                         <button type="button" class="btn btn-secondary rounded-3 px-4"
                                                             data-bs-dismiss="modal">Cancel</button>
                                                         <button type="submit" form="addDepartmentForm"
                                                             class="btn btn-primary rounded-3 px-4">Submit</button>
                                                     </div>

                                                 </div>
                                             </div>
                                         </div>

                                     </div>
                                     <div class="body">
                                         <!-- Example row -->
                                         <!-- Department Row -->
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Africa</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>

                                         <!-- Another Row -->
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Asia</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Europe</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>







                                     </div>
                                 </div>
                             </div>

                                </div>
                     </div>

                                   <div role="tabpanel" class="tab-pane" id="timeline" aria-expanded="false">
                     </div>
                     <div role="tabpanel" class="tab-pane" id="location" aria-expanded="false">
                         <div class="row clearfix">
                             <div class="col-lg-12 col-md-12 col-sm-12">
                                 <div class=" project_widget">
                                     <div class="header mb-3">
                                         <!-- Add Department Button -->
                                         <a href="#" class="btn btn-lg btn-half-white" data-bs-toggle="modal"
                                             data-bs-target="#addLocationModal">
                                             <i class="fas fa-plus fa-lg"></i> Add Locations
                                         </a>


                                         <!-- Bootstrap Modal -->
                                         <div class="modal fade" id="addLocationModal" tabindex="-1"
                                             aria-labelledby="addLocationLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered"> <!-- Centered Modal -->
                                                 <div class="modal-content rounded-5 shadow-lg">
                                                     <!-- Rounded corners here -->

                                                     <!-- Header -->
                                                     <div class="modal-header border-0">
                                                         <h5 class="modal-title fw-bold" id="addDepartmentLabel">Add
                                                             Location</h5>
                                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                             aria-label="Close"></button>
                                                     </div>

                                                     <!-- Body -->
                                                     <div class="modal-body">
                                                         <form id="addDepartmentForm" method="POST"
                                                             action="{{ route('departments.store') }}">
                                                             @csrf
                                                             <div class="mb-3">
                                                                 <label for="departmentName" class="form-label">
                                                                     Name <span class="text-danger">*</span>
                                                                 </label>
                                                                 <input type="text" class="form-control rounded-3"
                                                                     id="departmentName" name="name" required>
                                                             </div>
                                                         </form>
                                                     </div>

                                                     <!-- Footer -->
                                                     <div class="modal-footer justify-content-between border-0">
                                                         <button type="button" class="btn btn-secondary rounded-3 px-4"
                                                             data-bs-dismiss="modal">Cancel</button>
                                                         <button type="submit" form="addDepartmentForm"
                                                             class="btn btn-primary rounded-3 px-4">Submit</button>
                                                     </div>

                                                 </div>
                                             </div>
                                         </div>

                                     </div>
                                     <div class="body">
                                         <!-- Example row -->
                                         <!-- Department Row -->
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Africa</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>

                                         <!-- Another Row -->
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Asia</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>
                                         <div
                                             class="dept-row d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white">
                                             <span class="fw-bold">Europe</span>
                                             <div class="d-flex gap-3">
                                                 <a href="#" class="text-dark"><i
                                                         class="fas fa-pencil-alt"></i></a>
                                                 <a href="#" class="text-dark"><i class="fas fa-trash"></i></a>
                                             </div>
                                         </div>







                                     </div>
                                 </div>
                             </div>





                         </div>
                     </div>

                 </div>
             </div>
         </div>
         
     </div>
     </div>
     </div>
     </div>
     </div>





     <style>
         /* Style for nav tabs */
         .profile-tab-box .nav .nav-link {
             color: #333;
             font-weight: 500;
             border: none;
             border-bottom: 2px solid transparent;
             padding: 10px 15px;
             transition: all 0.3s ease;
         }

         /* Hover effect */
         .profile-tab-box .nav .nav-link:hover {
             color: grey !important;

         }

         /* Active tab */
         .profile-tab-box .nav .nav-link.active {
             color: rgb(0, 0, 0) !important;
             /* text red */
             border-bottom: 4px solid #226FBA;
             /* blue bottom line */
             background: transparent !important;
             /* no background */
         }

         .fw-bold {
             color: black;
             font-size: 16px;

         }

         /* Make row feel interactive */
         .dept-row {
             cursor: pointer;
             transition: all 0.2s ease-in-out;
             border: 1px solid #ddd;
         }

         /* Darker border + slight shadow on hover */
         .dept-row:hover {
             border-color: #333;
             /* Dark border */
             box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
         }

         .btn-half-white {
             background-color: rgb(255, 255, 255) !important;
             color: black;

         }

         .text-dark {
             font-size: 18px;
         }
     </style>
 @endsection
