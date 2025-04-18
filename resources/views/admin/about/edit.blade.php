<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin/common/header-links')
</head>

<body>
    



    @include('admin/common/header')
    @include('admin/common/sidebaar')

    <!--  Main wrapper -->
    <div class="body-wrapper">

       

        <div class="container-fluid">
          
            <main id="main" class="main">

                <div class="pagetitle">
        
                    <h1>Edit Page</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">About</a></li>
        
                            <li class="breadcrumb-item">About</li>
                            <li class="breadcrumb-item active">Update</li>
        
                        </ol>
                    </nav>
                </div><!-- End Page Title -->
        
                <section class="section">
                    <div class="card">
                        <div class="card-body pt-3">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
        
                            <form action="{{ route('about-update', $data->about_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <!-- Title input field -->
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="{{ $data->title }}" required>
                                        </div>
                                    </div>
        
                                    <!-- Description input field -->
        
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="num">Rooms</label>
                                            <input type="num" name="Rooms" id="Rooms" class="form-control"
                                                value="{{ $data->Rooms }}" required>
                                        </div>
                                    </div>
        
        
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="num">Staffs</label>
                                            <input type="num" name="Staffs" id="Staffs" class="form-control"
                                                value="{{ $data->Staffs }}" required>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mt-4">
                                    <div class="col-lg-6 mt-2">
                                        <div class="form-group">
                                            <label for="num">Clients</label>
                                            <input type="num" name="Clients" id="Clients" class="form-control"
                                                value="{{ $data->Clients }}" required>
                                        </div>
                                    </div>
        
                                    {{-- <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="image" class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                    @error('image')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
        
                                                <img src="{{ asset($data->image) }}" alt="image"
                                                    class="img-fluid img-thumbnail shadow" style="width: 200px;">
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
        
                                <div class="form-group mt-2">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ $data->description }}</textarea>
                                </div>
        
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary mt-4">Update</button>
                            </form>
                        </div>
                    </div>
                </section>
        
        
        
        
            </main><!-- End #main -->
        </div>
    </div>

    @include('admin/common/footer-links')


</body>

</html>

