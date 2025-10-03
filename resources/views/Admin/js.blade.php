  <script src="{{asset('admin/assets/js/common.min.js')}}"></script>
    <!-- Custom Js -->
    <script src="{{asset('admin/assets/js/admin.js')}}"></script>
    <script src="{{asset('admin/assets/js/bundles/echarts.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bundles/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/index.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/todo/todo.js')}}"></script>






    <script src="{{asset('admin/assets/js/table.min.js')}}"></script>
    <!-- Custom Js -->
    

    <script src="{{asset('admin/assets/js/pages/tables/jquery-datatable.js')}}"></script>

<script>
document.querySelectorAll('.toggle-status').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const userId = this.dataset.userId;
        const tenantId = this.dataset.tenantId;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/tenants/${tenantId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Status updated:', data.new_status);
            } else {
                alert('Failed to update status.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error updating status.');
        });
    });
});
</script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "timeOut": "3000",
        "positionClass": "toast-top-right"
    };

    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    @if(session('info'))
        toastr.info("{{ session('info') }}");
    @endif
</script>

<!-- jQuery -->



<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        let form = this.closest('form');
        let siteName = this.dataset.name;

        Swal.fire({
            title: 'Are you sure?',
            text: `Do you really want to delete site "${siteName}"? This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>




<script>
$(document).on('change', '.status-toggle', function() {
    let userId = $(this).data('id');
    $.ajax({
        url: '/users/' + userId + '/toggle-status',
        type: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log("Status updated:", response.status);
        },
        
    });
});
</script>




<script>
  if ($.fn.DataTable.isDataTable('#basicTable')) {
    $('#basicTable').DataTable().clear().destroy();
}

$('#basicTable').DataTable({
    paging: false,      // disable DataTables pagination
    info: false,        // remove "Showing X of Y entries"
    searching: false    // disable search if you want
});

});

</script>