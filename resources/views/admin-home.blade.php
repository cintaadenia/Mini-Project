<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="sidebar/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

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

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="sidebar/assets/css/demo.css" />

    <style>
      /* Adding some spacing between the chart and the content */
      .card-body {
        padding-bottom: 50px;
      }

      .mt-4 {
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar sidebar-style-2" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{route('home')}}" class="logo">
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
              <li class="nav-item"><a href="{{ route('dokter.index') }}"><i class="fas fa-user-md"></i><p>Dokter</p></a></li>
              <li class="nav-item"><a href="{{ route('obat.index') }}"><i class="fas fa-pills"></i><p>Obat</p></a></li>
              <li class="nav-item"><a href="{{ route('pasien.index') }}"><i class="fas fa-user-injured"></i><p>Pasien</p></a></li>
              <li class="nav-item"><a href="{{ route('resep.index') }}"><i class="fas fa-prescription"></i><p>Resep</p></a></li>
              <li class="nav-item"><a href="{{ route('kunjungan.index') }}"><i class="fas fa-clipboard-list"></i><p>Kunjungan</p></a></li>
              <li class="nav-item"><a href="{{ route('jadwal_praktek.index') }}"><i class="fas fa-calendar-day"></i><p>Jadwal Praktek</p></a></li>
              <li class="nav-item"><a href="{{ route('rekam_medis.index') }}"><i class="fas fa-file-medical-alt"></i><p>Rekam Medis</p></a></li>
              <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i><p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

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

                  <!-- Chart Section -->
                  <div class="mt-4">
                    <h5>Jumlah Pasien</h5>
                    <canvas id="jumlahPasienChart" width="400" height="200"></canvas>
                  </div>
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
    <script src="sidebar/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- Chart.js CDN -->
    <script>
      const ctx = document.getElementById('jumlahPasienChart').getContext('2d');
      const jumlahPasienChart = new Chart(ctx, {
        type: 'bar', // Can change to 'line', 'pie', etc.
        data: {
          labels: ['Jumlah Pasien'],
          datasets: [{
            label: 'Jumlah Pasien',
            data: [{{ $jumlahPasien }}],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true, // Make the chart responsive
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    </script>
  </body>
</html>
