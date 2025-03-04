<!DOCTYPE html>
<html lang="en">

@include('admin/common/header-links')

<body>

    
@include('admin/common/header')
@include('admin/common/sidebaar')

<!--  Main wrapper -->
<div class="body-wrapper">

  @include('admin/common/header')

  <div class="container-fluid">
    <main id="main" class="main">

        <div class="pagetitle">

            <h1>Add Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">About</a></li>
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item">About</li>
                    <li class="breadcrumb-item active">Add Page</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body pt-3">
                    <form action="{{ route('about-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group mt-2">
                                    <label for="Rooms">Rooms</label>
                                    <input type="text" name="Rooms" id="Rooms" class="form-control" placeholder="Rooms"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="form-group mt-2">
                                    <label for="Staffs">Staffs</label>
                                    <input type="text" name="Staffs" id="Staffs" class="form-control"
                                        placeholder="Staffs" required>
                                </div>
                            </div>
                            <div class="col-lg-4">

                                <div class="form-group mt-2">
                                    <label for="Clients">Clients</label>
                                    <input type="text" name="Clients" id="Clients" class="form-control"
                                        placeholder="Clients" required>
                                </div>
                            </div>


                            {{-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Img"
                                        required>
                                </div>
                            </div> --}}
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description"
                                required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </form>

                </div>

            </div>

            </div>
        </section>

    </main><!-- End #main -->

  </div>
</div>


@include('admin/common/footer-links')

</body>

</html>