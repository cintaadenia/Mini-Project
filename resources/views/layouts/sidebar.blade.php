<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="sidebar/assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

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

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="sidebar/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="sidebar/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="/css/home_admin.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="sidebar/assets/css/demo.css" />
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar sidebar-style-2" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{url('/admin')}}" class="logo">
              <h1>admin</h1>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a href="{{ route('dokter.index') }}">
                    <i class="fas fa-user-md"></i>
                    <p>Dokter</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('obat.index') }}">
                    <i class="fas fa-pills"></i>
                    <p>Obat</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.index') }}">
                <i class="fas fa-procedures"></i>
                    <p>Pasien</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('resep.index') }}">
                    <i class="fas fa-prescription"></i>
                    <p>Resep</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kunjungan.index') }}">
                    <i class="fas fa-clipboard-list"></i>
                    <p>Kunjungan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jadwal_praktek.index') }}">
                    <i class="fas fa-calendar-plus"></i>
                    <p>Jadwal Praktek</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('rekam_medis.index') }}">
                    <i class="fas fa-file-medical-alt"></i>
                    <p>Rekam Medis</p>
                </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i>
                  <p>Logout</p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </li>

                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <main class="py-4">
            @yield('side')
        </main>
      </div>
      <!-- End Sidebar -->

      <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="sidebar/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="sidebar/assets/js/core/popper.min.js"></script>
    <script src="sidebar/assets/js/core/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jQuery Scrollbar -->
    <script src="sidebar/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="sidebar/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="sidebar/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="sidebar/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="sidebar/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="sidebar/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="sidebar/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="sidebar/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="sidebar/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="sidebar/assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="sidebar/assets/js/setting-demo.js"></script>
    <script src="sidebar/assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
