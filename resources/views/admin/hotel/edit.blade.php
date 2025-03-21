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
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>

                    <li class="breadcrumb-item">Bus</li>
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

                    <form action="{{ route('hotel-update', $data->hotel_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="source">source</label>
                                    <input type="text" name="source" id="source" class="form-control"
                                        value="{{ $data->source }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="destination">destination</label>
                                    <input type="text" name="destination" id="destination" class="form-control"
                                        value="{{ $data->destination }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="date">date</label>
                                    <input type="date" name="date" id="date" class="form-control"
                                        value="{{ $data->date }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="bus_name">bus_name</label>
                                    <input type="text" name="bus_name" id="bus_name" class="form-control"
                                        value="{{ $data->bus_name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="bus_num">bus_num</label>
                                    <input type="num" name="bus_num" id="bus_num" class="form-control"
                                        value="{{ $data->bus_num }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="available_seats">available_seats</label>
                                    <input type="num" name="available_seats" id="available_seats" class="form-control"
                                        value="{{ $data->available_seats }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="departure">departure</label>
                                    <input type="num" name="departure" id="departure" class="form-control"
                                        value="{{ $data->departure }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="arrival">arrival</label>
                                    <input type="num" name="arrival" id="arrival" class="form-control"
                                        value="{{ $data->arrival }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <!-- Title input field -->
                                <div class="form-group">
                                    <label for="bus_nameone">arrival</label>
                                    <input type="text" name="bus_nameone" id="bus_nameone" class="form-control"
                                        value="{{ $data->bus_nameone }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <!-- Description input field -->

                                <div class="row ">
                                    <div class="col-lg-6">
                                        <div class="row ">
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
                                    </div>
                                </div>
                            </div>
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