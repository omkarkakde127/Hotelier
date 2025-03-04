<!DOCTYPE html>
<html>

@include('common/header_link')

<body>

    @include('common/navbar')

<section id="about">

    <form action="" class="border text-dark data p-4 mx-auto shadow">
        <div class="row">
            <div class="col">
                <div class="form-group">

                    <input type="text" class="form-control" id="name" name="name" placeholder="Check in" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                    <input type="email" class="form-control" id="email" name="email" placeholder="Check out"
                        required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">

                    <select id="adult" class="form-select text-secondary">
                        <option value="1"> Adult</option>
                        <option value="2">2 Adults</option>
                        <option value="3">3 Adults</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <select id="adult" class="form-select  text-secondary">
                        <option value="1">Child</option>
                        <option value="2">2 Adults</option>
                        <option value="3">3 Adults</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-five text-white w-100">SUBMIT</button>
            </div>
        </div>
    </form>

    <div class="container mt-4 p-5">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <div class="d-flex">
                    <p class="us p-0 mt-1">ABOUT US</p>
                    <hr class="line ms-3 ">
                </div>
                <h1 class="text-dark ">Welcome to <span class="us">HOTELIER</span></h1>
                <p class="text-dark mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. At, aliquid.
                    Exercitationem cumque esse eius debitis omnis vero temporibus velit beatae. Amet quia quae quo
                    praesentium ab eius est delectus aliquam!</p>

                {{-- <div class="row">
                    <div class="col text-center p-2 room ">
                        <div class="border p-2">
                            <div class="border ">
                                <h1 class="fw-bold">93</h1>
                                <p>Rooms</p>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center p-2">
                        <div class="border p-2">
                            <div class="border ">
                                <h1 class="fw-bold">93</h1>
                                <p>Rooms</p>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center p-2">
                        <div class="border p-2">
                            <div class="border ">
                                <h1 class="fw-bold">93</h1>
                                <p>Rooms</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col text-center p-2 room">
                        <div class="border p-2">
                            <div class="border">
                                <h1 class="fw-bold" data-target="93" id="room-counter-1">0</h1>
                                <p>Rooms</p>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center p-2">
                        <div class="border p-2">
                            <div class="border">
                                <h1 class="fw-bold" data-target="93" id="room-counter-2">0</h1>
                                <p>Rooms</p>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center p-2">
                        <div class="border p-2">
                            <div class="border">
                                <h1 class="fw-bold" data-target="93" id="room-counter-3">0</h1>
                                <p>Rooms</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="btn-one btn-warning text-white mt-3 p-2 ps-4 pe-4">EXPLORE MORE</button>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 pe-2">
                        <div class="h-25"></div>
                        <img src="assets\img\about-1.jpg" class="h-75 w-75 float-end" alt="">
                    </div>
                    <div class="col-lg-6">
                        <img src="assets\img\about-2.jpg" class="h-100 w-100" alt="">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-6 pe-2">
                        <img src="assets\img\about-3.jpg" class="h-75 w-50 float-end" alt="">
                    </div>
                    <div class="col-lg-6">
                        <img src="assets\img\about-4.jpg" class="h-100 w-75" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

@include('common/footer')

@include('common/footer_link')

</body>

</html>