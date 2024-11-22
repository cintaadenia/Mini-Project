<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Fonts and icons -->
  <script src="sidebar/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["sidebar/assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="sidebar/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="sidebar/assets/css/plugins.min.css" />
  <link rel="stylesheet" href="sidebar/assets/css/kaiadmin.min.css" />

  <!-- Demo CSS (optional, don't include in production) -->
  <link rel="stylesheet" href="sidebar/assets/css/demo.css" />
</head>
<body>
  <div class="wrapper">
    <!-- Main Content -->
    <div class="main-content">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">{{ __('Dashboard') }}</div>
              <div class="card-body">
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                {{ __('You are logged in!') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Main Content -->
  </div>

  <!-- JS Files -->
  <script src="sidebar/assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="sidebar/assets/js/core/popper.min.js"></script>
  <script src="sidebar/assets/js/core/bootstrap.min.js"></script>
</body>
</html>
