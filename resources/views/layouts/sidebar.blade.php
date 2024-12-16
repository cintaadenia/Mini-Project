<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    {{-- <!-- Fonts and icons -->
    <script src="sidebar/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["sidebar/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    {{--
    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="sidebar/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/css/home_admin.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="sidebar/assets/css/demo.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/globaladmin.css') }}">
</head>

<body>
    <!-- Sidebar -->
    <div class="app-container">
        <div class="sidebar" id="sidebar">
            <div onclick="toggleSidebar()" class="btn-toggle-sidebar">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul>
                <li>
                    <a href="#">
                        {{-- <i class="fas fa-home"></i> --}}
                        <img src="{{ asset('icons/logos.svg') }}" alt="">
                        <Span>Klinik</Span>
                    </a>
                </li>
                <li>
                    <div class="gap-li"></div>
                </li>
                <li>
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin-home') }}"
                            class="{{ request()->routeIs('admin-home') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <span>Dashboard Admin</span>
                        </a>
                    @else
                        <a href="{{ route('home-dokter') }}"
                            class="{{ request()->routeIs('home-dokter') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    @endif
                </li>
                <li>
                    <a href="{{ route('dokter.index') }}"
                        class="{{ request()->routeIs('dokter.index') ? 'active' : '' }}">
                        <i class="fa fa-user-md"></i>
                        <span>Dokter</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('obat.index') }}" class="{{ request()->routeIs('obat.index') ? 'active' : '' }}">
                        <i class="fa fa-pills"></i>
                        <span>Obat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pasien.index') }}"
                        class="{{ request()->routeIs('pasien.index') ? 'active' : '' }}">
                        <i class="fa fa-users"></i>
                        <span>Pasien</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('resep.index') }}"
                        class="{{ request()->routeIs('resep.index') ? 'active' : '' }}">
                        <i class="fa fa-notes-medical"></i>
                        <span>Diagnosis</span>
                    </a>
                </li>
                <li>
                    <div class="gap-li"></div>
                </li>
                <li>
                    <a href="{{ route('kunjungan.index') }}"
                        class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
                        <i class="fa fa-calendar-check"></i>
                        <span>Kunjungan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwal_praktek.index') }}"
                        class="{{ request()->routeIs('jadwal_praktek.index') ? 'active' : '' }}">
                        <i class="fa fa-calendar-day"></i>
                        <span>Jadwal Praktek</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('rekam_medis.index') }}"
                        class="{{ request()->routeIs('rekam_medis.index') ? 'active' : '' }}">
                        <i class="fa fa-file-medical-alt"></i>
                        <span>Rekam Medis</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="q-btn" style="color: inherit; cursor: pointer;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <ul class="profile-sidebar">
                <li>
                    <a href="#">
                        {{-- <i class="fas fa-home"></i> --}}
                        <img class="photo-profile-sidebar" src="{{ asset('asset/img/dokter.png') }}" alt="">
                        <span>
                            <h6>Welcome Bek</h2>
                                <p>Admin/Dokter</p>
                        </span>
                    </a>
                </li>
            </ul>
        </div>


        <div class="wrapper-container" id="wrapper-container">
            @yield('side')
        </div>
    </div>

    <!-- End Sidebar -->

    <!-- End Custom template -->

    <!--   Core JS Files   -->
    <script src="sidebar/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="sidebar/assets/js/core/popper.min.js"></script>
    <script src="sidebar/assets/js/core/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

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

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    {{-- <script src="sidebar/assets/js/setting-demo.js"></script> --}}
    {{-- <script src="sidebar/assets/js/demo.js"></script> --}}
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
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('expanded');
        }
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('wrapper-container');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }
    </script>
</body>

</html>
