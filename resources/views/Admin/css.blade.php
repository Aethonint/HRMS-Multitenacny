  <link rel="icon" href="{{asset('admin/assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="{{asset('admin/assets/css/common.min.css')}}" rel="stylesheet">
    <!-- Custom Css -->
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" />
    <!-- You can choose a theme from css/styles instead of get all themes -->
    <link href="{{asset('admin/assets/css/styles/all-themes.css')}}" rel="stylesheet" />

<!-- Toastr CSS -->

<style>
  #toast-container.toast-top-right {
    top: 20px !important;
    right: 20px !important;
    z-index: 999999 !important; /* ensure above modals/loader */
}
#toast-container > .toast {
    margin-bottom: 10px;
    border-radius: 6px;
}
</style>