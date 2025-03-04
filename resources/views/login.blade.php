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

  <title>Login</title>
</head>

<body>


<!--section login start-->

  <section id="login" class="">

  <div class="container-fluid space ">
    <div class="container mx-auto mt-5 pt-5">
      <h3 class="text-center mt-5 fst-italic text-white">Login</h3>
      <div class="row mx-auto border box">
        <div class="col w-50 mx-auto">
        
         <!--form start-->
          <form action="{{route('login-user')}}" method="post" class="">
            @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @csrf
            <div class="form-group mt-3">
              <i class="fa-solid fa-envelope"></i> <!-- Icon for email -->
              <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                  value="{{ old('email') }}">
          </div>
          <span class="text-danger">@error('email') {{ $message }} @enderror</span>

          <!-- Password Input with Icon -->
          <div class="form-group mt-3">
              <img src="assets\img\hidden.png" class="hidden" id="eyeicon" alt="">
              <input type="password" class="form-control" id="password" placeholder="Password" name="password">
          </div>
          <span class="text-danger">@error('password') {{ $message }} @enderror</span>
            <div class="form-group">
              <button class="btn btn-block btn-primary mt-3 ms-2" type="submit">Login</button>
            </div>
            <br>
            <a href="registration">New user !! register here</a>
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
<!--section login end-->

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>