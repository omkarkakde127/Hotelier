<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--cdn link added-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css link added-->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Registration</title>
</head>

<body>

    <!--section registration starts-->
    <section id="registration">
        <div class="container-fluid space_one">
            <div class="container">
                <h4 class="mt-4 mb-3 text-center text-white fst-italic">Registration</h4>
                <div class="row border mx-auto box_one ">
                    <div class="col">

                        <!--form start-->
                        <form action="{{ route('register-user') }}" method="POST">
                            @if(Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif

                            @csrf


                            <div class="form-group mt-3">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="form-control bg-transparent" id="name"
                                    placeholder="Enter name" name="name" value="{{ old('name') }}">
                            </div>
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>

                            <!-- Email Input with Icon -->
                            <div class="form-group mt-3">
                                <i class="fa-solid fa-envelope"></i> <!-- Icon for email -->
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                    value="{{ old('email') }}">
                            </div>
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>

                            <div class="form-group mt-3">
                                <i class="fa-solid fa-envelope"></i> <!-- Icon for email -->
                                <input type="text" class="form-control" id="course" placeholder="Course" name="course"
                                    value="{{ old('course') }}">
                            </div>
                            <span class="text-danger">@error('course') {{ $message }} @enderror</span>
                            <!-- Password Input with Icon -->
                            <div class="form-group mt-3">
                                <img src="assets\img\hidden.png" class="hidden" id="eyeicon" alt="">
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    name="password">
                            </div>
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>

                            <div class="form-group mt-3">
                                <button class="btn btn-block btn-primary" type="submit">Register</button>
                            </div>
                            <br>
                            <a href="{{ route('login') }}">Already registered? Login here.</a>

                        </form>
                        <!--form end-->

                    </div>
                </div>
            </div>

        </div>

        <script>
            let eyeIcon = document.getElementById("eyeicon");
        let password = document.getElementById("password");
      
        eyeIcon.onclick = function () {
          if (password.type === "password") {
            password.type = "text";
            eyeIcon.src = "assets/img/eye.png"; // Update the path to your 'eye.png' icon
          } else {
            password.type = "password";
            eyeIcon.src = "assets/img/hidden.png"; // Update the path to your 'hidden.png' icon
          }
        };
        </script>

    </section>

    <!--section registration ends-->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>