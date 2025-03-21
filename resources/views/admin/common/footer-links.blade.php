</div>
<script src="{{asset('dashboard/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/assets/js/sidebarmenu.js')}}"></script>
<script src="{{asset('dashboard/assets/js/app.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/simplebar/dist/simplebar.js')}}"></script>
<script src="{{asset('dashboard/assets/js/dashboard.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>



<script>
    function confirmDelete(aboutId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Want to Delete it !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085D6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirms
                document.getElementById('delete-form-' + aboutId).submit();
            }
        });
    }
</script>