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
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item">Bus</li>
                    <li class="breadcrumb-item active">Add Page</li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body pt-3">
                    <form action="{{ route('hotel-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="source" class="form-label">source </label>
                                    <input type="text" class="form-control" name="source" id="source"
                                        placeholder="source">
                                    @error('source')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="destination" class="form-label">destination </label>
                                    <input type="text" class="form-control" name="destination" id="destination"
                                        placeholder="destination">
                                    @error('destination')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">date </label>
                                    <input type="date" class="form-control" name="date" id="date"
                                        placeholder="date">
                                    @error('date')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="bus_name" class="form-label">bus_name </label>
                                    <input type="text" class="form-control" name="bus_name" id="bus_name"
                                        placeholder="bus_name">
                                    @error('bus_name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="bus_num" class="form-label">bus_num </label>
                                    <input type="number" class="form-control" name="bus_num" id="bus_num"
                                        placeholder="bus_num">
                                    @error('bus_num')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="available_seats" class="form-label">available_seats </label>
                                    <input type="number" class="form-control" name="available_seats" id="available_seats"
                                        placeholder="available_seats">
                                    @error('available_seats')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="departure" class="form-label">departure </label>
                                    <input type="number" class="form-control" name="departure" id="departure"
                                        placeholder="departure">
                                    @error('departure')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="arrival" class="form-label">arrival </label>
                                    <input type="number" class="form-control" name="arrival" id="arrival"
                                        placeholder="arrival">
                                    @error('arrival')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="bus_nameone" class="form-label">Bus_name_one </label>
                                    <input type="text" class="form-control" name="bus_nameone" id="bus_nameone"
                                        placeholder="bus_nameone">
                                    @error('bus_nameone')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div>
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" placeholder="Img">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                placeholder="Description"></textarea>
                        </div> --}}
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