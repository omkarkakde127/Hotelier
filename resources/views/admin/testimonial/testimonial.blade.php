<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin/common/header-links')
</head>


<body>

    @include('admin/common/header')
    @include('admin/common/sidebaar')
    <!-- End Sidebar-->

     <!--  Main wrapper -->
     <div class="body-wrapper">

        <div class="container-fluid">
            <main id="main" class="main">

                <div class="pagetitle">
        
                    <h1>Testimonial</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Testimonial</a></li>
                            <li class="breadcrumb-item">Components</li>
                            <li class="breadcrumb-item active">Testimonial</li>
                        </ol>
                    </nav>
                </div><!-- End Page Title -->
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card table-responsive">
                                <div class="card-body pt-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2>Testimonial</h2>
                                        </div>
                                        <div class="col-lg-6 text-end">
                                            <a href="{{ route('testimonial-add') }}" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
        
                                    <table id="example" class="yajra-datatables table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th>Name</th>
                                                <th>profession</th>
                                                <th>description</th>
                                                <th>img</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        </script>
                    @endif
        
        
                    <script>
                       function confirmDelete(aboutId) {
                            Swal.fire({
                                title: "Are you sure?",
                                text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
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
        
        
                </section>
        
        
            </main><!-- End #main -->
        </div>

     </div>

     @include('admin/common/footer-links')


     <script>
        document.addEventListener("DOMContentLoaded", function () {
            let table = new DataTable('#example', {
                processing: true,
                serverSide: true,
                ajax: "{{ route('testimonial_script') }}", // Ensure this route returns JSON data
                columns: [
                    { data: 'testimonial_id', name: 'testimonial_id' },
                    {
                        data: 'name', // Action column, populated by controller
                        name: 'name'
                    },
                    {
                        data: 'profession', // Using 'fullName' directly from the controller
                        name: 'profession'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    
                    {
                        data: 'image', // Using 'fullName' directly from the controller
                        name: 'image'
                    },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false 
                    }
                ]
            });
    
            // Delete button event listener
            $(document).on("click", ".delete-button", function () {
                let home_slider_id = $(this).data("id");
    
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('homeslider-delete', ['home_slider_id' => '__ID__']) }}".replace('__ID__', home_slider_id),
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: "Slider has been deleted successfully.",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
    
                                table.ajax.reload(); // Reload DataTable
                            },
                            error: function () {
                                Swal.fire({
                                    icon: "error",
                                    title: "Error!",
                                    text: "Something went wrong, please try again.",
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>


    
    
</body>

</html>

