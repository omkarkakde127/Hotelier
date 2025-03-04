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
                    <li class="breadcrumb-item"><a href="index.html">Rooms</a></li>
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item">Rooms</li>
                    <li class="breadcrumb-item active">Add Page</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body pt-3">
                    <form action="{{ route('blog-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mt-3">
                                    <label for="text">Tag</label>
                                    <input type="text" name="tag" id="tag" class="form-control" placeholder="Tag" required>
                                </div>



                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mt-3">
                                    <label for="Admin_name">Admin Name</label>
                                    <input type="text" name="Admin_name" id="Admin_name" class="form-control" placeholder="Admin Name"
                                        required>
                                </div>

                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Add Item</button>
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
