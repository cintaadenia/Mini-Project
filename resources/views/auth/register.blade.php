<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In & Sign Up</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {

            overflow: hidden;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: white;
            background-image: url('/asset/img/vector_bg.png');
            background-repeat: no-repeat;
            background-position: right top;
            background-size: 500px;

            /* Dark blue background for body */
        }

        .outer-container {
            background-color: #ffffff;
            /* Dark blue */

        }



        /* .form-container.active {
            margin-left: 275px;
        }

        .form-container {
            margin-left: 25px;
            background-color: white;
            /* height: 380px;
            width: 305px; */
            /* align-self: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: absolute;
            transition: margin-left 1.5s ease-in-out; */
            /* Smooth animation */
        /* } */ */

        /* .form-item form {
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
        } */

        /* .form-item form input {
      display: block;
      padding: 12px;
      width: 500px;
      margin: 20px auto;
      border: 1px solid #83a3be;
      border-radius: 20px;
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
        /* transform: scale(1.05); */
        /* Slight scaling effect */
        /* }

    .info-container {
      width: 100%;
      display: flex;
      justify-content: space-around;
      position: relative;

    }
    .login:hover {
      text-decoration: underline;
      text-underline-offset: 10px;
      color: #3A5D75;
    }
    .register:hover {
      text-decoration: underline;
      text-underline-offset: 10px;
      color: #3A5D75;
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

      /* } */



        /* Lottie animation at the top */
        dotlottie-player {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 200px;
        }

        .header-text {
            color: rgb(100, 100, 192);
            position: absolute;
            top: 20px;
            left: 100px;
        }

        .lotie {
            position: absolute;
            top: 25%;
            left: 75%;
            z-index: 4;
        }


        .btn-no-color {
      background-color: transparent !important;
      border-color: transparent !important;
      color: inherit !important;
      transition: background-color 0.5s ease, border-color 0.5s ease, color 0.5s ease;

        }
        #btn1, #btn2 {
    display: none;
}
#specialty-field.hidden {
    height: 0;
    margin: 0;
    overflow: hidden;
    opacity: 0;
}
#nohp-field.hidden {
    height: 0;
    margin: 0;
    overflow: hidden;
    opacity: 0;
}
.field-btn{
    color: blue;
}
.container-img{z
    z-index: 1;
    position: relative;
    top: 230px;
}
    </style>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</head>

<body>
    <div class="container-img">
        <img src="{{ asset('asset/img/titik.png') }}" alt="Gambar 1">
    </div>
    <!-- Lottie animation placed at the top of the screen -->
    {{-- <dotlottie-player src="https://lottie.host/680d9a21-2dd6-436f-a589-dd46a94152f2/vPQkqPk12r.json" background="transparent" speed="1" loop autoplay></dotlottie-player> --}}
    <div class="header-text">
        <h1 style="font-family: open sans; font-weight: bold">KLINIK</h1>
    </div>

    {{-- <div class="outer-container">
        <div class="container">
            <div class="info-container">
        <div class="login">
          <div class="info-item log-in">
            <div class="btn" style="color: black; font-size: 20px; font-weight: bold; font-family: open sans">Login</div>
          </div>
        </div>
        <div class="register">
          <div class="info-item sign-up">
            <div class="btn" style="color: black; font-size: 20px; font-weight: bold; font-family: open sans">Register</div>
          </div>
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
              @if (session('error'))
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
            <i class="bi bi-person-circle"></i>
            <input name="name" placeholder="Name" type="text"/>
            @if ($errors->has('name'))
    <small style="color: red;">{{ $errors->first('name') }}</small>
@endif
            <input name="email" placeholder="Email Address" type="email"/>
            @if ($errors->has('email'))
    <small style="color: red;">{{ $errors->first('email') }}</small>
@endif
            <input name="password" placeholder="Password" type="password"/>
            @if ($errors->has('password'))
    <small style="color: red;">{{ $errors->first('password') }}</small>
@endif
            <input name="password_confirmation" placeholder="Confirm Password" type="password"/>
            @if ($errors->has('password_confirmation'))
    <small style="color: red;">{{ $errors->first('password_confirmation') }}</small>
@endif
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
          </form>
        </div>
      </div>


        </div>
    </div> --}}

    <div class="lotie">
      <dotlottie-player src="https://lottie.host/621f36a4-85ad-48cc-aa5f-acbae0c13265/iO2nGuesOg.lottie"
          background="transparent" speed="1" style="width: 300px; height: 300px" loop
          autoplay></dotlottie-player>
  </div>




    
</body>

</html>
