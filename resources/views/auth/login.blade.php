<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In & Sign Up</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #2A3E5C; /* Dark blue background for body */
    }

    .outer-container {
      background-color: #2A3E5C; /* Dark blue */
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column; /* Allow space for animation above */
    }

    .container {
      background-color: #4A6D8C; /* Medium blue */
      width: 600px;
      height: 380px;
      display: flex;
      border-radius: 10px;
      position: relative;
    }

    .form-container.active {
      margin-left: 275px;
    }

    .form-container {
      margin-left: 25px;
      background-color: white;
      height: 380px;
      width: 305px;
      align-self: center;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      position: absolute;
      transition: margin-left 1.5s ease-in-out; /* Smooth animation */
    }

    .form-item form {
      z-index: 2;
      position: relative;
      animation: fadeIn 1s ease-out;
    }

    /* Fade-in animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    .form-item form input {
      display: block;
      padding: 12px;
      width: 250px;
      margin: 12px auto;
      border: 1px solid #4A6D8C;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-item form .btn {
      cursor: pointer;
      display: block;
      padding: 12px;
      width: 250px;
      margin: 10px auto;
      text-align: center;
      border: 2px solid #4A6D8C;
      background-color: #4A6D8C;
      color: white;
      border-radius: 5px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .form-item form .btn:hover {
      background-color: #3A5D75; /* Darker blue on hover */
      transform: scale(1.05); /* Slight scaling effect */
    }

    .info-container {
      width: 100%;
      display: flex;
      justify-content: space-around;
      position: relative;
    }

    .info-item {
      color: white;
      display: flex;
      align-content: center;
      align-items: center;
      flex-direction: column;
      font-weight: 500;
      font-size: 20px;
      z-index: 1;
    }

    .info-item .btn {
      cursor: pointer;
      background-color: transparent;
      width: 90px;
      padding: 12px;
      border: 1px solid white;
      font-size: 16px;
      border-radius: 5px;
      transition: opacity 0.3s, transform 0.3s ease;
    }

    .info-item .btn:hover {
      opacity: 0.7;
      transform: scale(1.05); /* Slight scaling effect */
    }

    /* Lottie animation at the top */
    dotlottie-player {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 200px;
      height: 200px;
    }
  </style>
  <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body>
  <!-- Lottie animation placed at the top of the screen -->
  <dotlottie-player src="https://lottie.host/680d9a21-2dd6-436f-a589-dd46a94152f2/vPQkqPk12r.json" background="transparent" speed="1" loop autoplay></dotlottie-player>

  <div class="outer-container">
    <div class="container">
      <div class="info-container">
        <div class="info-item log-in">
          <p>Have an account?</p>
          <div class="btn">Log In</div>
        </div>
        <div class="tree"></div>
        <div class="info-item sign-up">
          <p>Don't have an account?</p>
          <div class="btn">Sign Up</div>
        </div>
      </div>
      <div class="form-container">
        <div class="form-item">
          <form class="form-log-in" method="POST" action="{{ route('login') }}">
            @csrf
            <input name="email" placeholder="Email Address" type="email" required />
            <input name="password" placeholder="Password" type="password" required />
            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>
          </form>

          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script>
              @if(session('error'))
              Swal.fire({
                  icon: 'error',
                  title: 'Login Gagal',
                  text: "{{ session('error') }}",
                  confirmButtonText: 'OK'
              });
              @endif
          </script>

          <form class="form-sign-up" style="display: none;" method="POST" action="{{ route('register') }}">
            @csrf
            <input name="name" placeholder="Name" type="text"/>
            @if($errors->has('name'))
    <small style="color: red;">{{ $errors->first('name') }}</small>
@endif
            <input name="email" placeholder="Email Address" type="email"/>
            @if($errors->has('email'))
    <small style="color: red;">{{ $errors->first('email') }}</small>
@endif
            <input name="password" placeholder="Password" type="password"/>
            @if($errors->has('password'))
    <small style="color: red;">{{ $errors->first('password') }}</small>
@endif
            <input name="password_confirmation" placeholder="Confirm Password" type="password"/>
            @if($errors->has('password_confirmation'))
    <small style="color: red;">{{ $errors->first('password_confirmation') }}</small>
@endif
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    let currentlyVisible = ".form-log-in";
    let currentlyHidden = ".form-sign-up";

    $(".info-item .btn").click(function() {
      $(".form-container").toggleClass("active");
      $(currentlyVisible).fadeToggle(750, function() {
        $(currentlyHidden).fadeToggle();
        let temp = currentlyVisible;
        currentlyVisible = currentlyHidden;
        currentlyHidden = temp;
      });
    });
  </script>
  <script>
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Registration Failed',
        text: "{{ session('error') }}",
        confirmButtonText: 'OK'
    });
    @endif

    @if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Validation Errors',
        html: "<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>",
        confirmButtonText: 'OK'
    });
    @endif

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
    @endif
</script>


</body>
</html>
