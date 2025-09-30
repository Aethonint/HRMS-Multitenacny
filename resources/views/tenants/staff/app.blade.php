<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>AtrioHR - HR and Company Management Admin Template</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Favicon-->
  @include('Admin.css')
</head>

<body>


    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30">
                <img class="loading-img-spin" src="{{asset('admin/assets/images/loading.png')}}" alt="admin">
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
   @include('tenants.staff.top_header')
    <!-- #Top Bar -->
    <div>
        <!-- Left Sidebar -->
       @include('tenants.staff.sidebar')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
     @include('tenants.staff.rightbar')
        <!-- #END# Right Sidebar -->
    </div>
    <section class="content">
        <div class="container-fluid">
         @yield('content')
        </div>
    </section>
  @include('Admin.js')
</body>

</html>