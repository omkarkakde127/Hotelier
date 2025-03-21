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
        
                    <h1>Rooms</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Rooms</a></li>
                            <li class="breadcrumb-item">Components</li>
                            <li class="breadcrumb-item active">Rooms</li>
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
                                            <h2>Rooms</h2>
                                        </div>
                                        <div class="col-lg-6 text-end">
                                            <a href="{{ route('room-add') }}" class="btn btn-primary">Add</a>
                                        </div>
                                    </div>
                
                                    <table id="table1" class="yajra-datatables table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Tag</th>
                                                <th>Img</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                        @if (session('success'))
                        Swal.fire({
                        title: "Success!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                        });
                         @endif
                         });
                    </script>
        
        
                </section>
                
        
            </main><!-- End #main -->
        </div>

     </div>

     @include('admin/common/footer-links')


    <script>
        $(document).ready(function() {
            var table = $('#table1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('room_script') }}",
                columns: [{
                        data: 'room_id',
                        name: 'room_id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    { 
                    data: 'tag',
                    name: 'tag'
                },
                    {
                        data: 'image',
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
        });


    </script>

    <script>
        function confirmDelete(homeSliderId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("delete-form-" + homeSliderId).submit();
            }
        });
    }
    </script>


    <!-- SweetAlert2 CSS & JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
</body>

</html>
