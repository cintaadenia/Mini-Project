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

    <style>
        :root {
            --main-color: #0F8CA9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .h2-title-bold {
            font-size: 2rem;
            font-weight: 900;
        }

        .h2-left {
            text-align: left;
        }

        .sidebar {
            text-align: center;
            width: 150px;
            height: 100vh;
            background-color: #0F8CA9;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            border-radius: 0 15px 15px 0;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 20px;
            font-size: 16px;
        }

        .sidebar ul li a i {
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }

        .sidebar ul li a:hover {
            background-color: #0C6F82;
            border-radius: 5px;
        }

        .sidebar ul li a span {
            font-size: 1rem;
            font-weight: 800;
        }

        .quit-btn {
            outline: none;
            border: none;
            background: var(--main-color);
        }

        .wrapper-container {
            margin-left: 10rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding: 2rem 2rem 0 2rem;
        }

        .content-header {
            display: inline;
            justify-content: center;
            align-items: center;
            width: 1700px;
        }

        .search input {
            width: 100%;
            height: 60px;
            margin: 1.5rem 0;
            border-radius: 1.2rem;
        }

        .search-container {
            display: flex;
            align-items: center;
            width: auto;
            height: 70px;
            border: 2px solid #ccc;
            border-radius: 1.5rem;
            padding: 5px 10px;
            background-color: #fff;
            margin-top: 1rem;
        }

        .search-container .fa-magnifying-glass {
            color: #888;
            margin-right: 10px;
        }

        .search-container input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 1.5rem;
        }

        .search-container input::placeholder {
            color: #aaa;
        }

        .search-container .fa-magnifying-glass {
            color: #888;
            margin-left: 10px;
        }

        @media screen and (max-width: 1366px) {
            .sidebar {
                width: 90px;
            }

            .sidebar ul li {
                margin: 0.1rem 0;
            }

            .sidebar ul li a i {
                margin-bottom: 0.5rem;
                font-size: 1.2rem;
            }

            .sidebar ul li a:hover {
                background-color: #0C6F82;
                border-radius: 5px;
            }

            .sidebar ul li a span {
                font-size: 0.9rem;
                font-weight: 800;
            }

            .wrapper-container {
                margin-left: 6rem;
            }

            .content-bottom {
                padding: 0 2rem 1rem 2rem;
                margin-top: 1rem;
            }

            .search input {
                height: 40px;
                margin: 1rem 0;
                border-radius: 0.8rem;
            }

            .search-container {
                height: 50px;
                border-radius: 1rem;
                padding: 3px 8px;
            }

            .search-container input {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="app-container">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dokter.index')}}">
                        <i class="fa fa-user-md"></i>
                        <span>Dokter</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('obat.index')}}">
                        <i class="fa fa-pills"></i>
                        <span>Obat</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('pasien.index')}}">
                        <i class="fa fa-users"></i>
                        <span>Pasien</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-notes-medical"></i>
                        <span>Diagnosis</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('kunjungan.index')}}">
                        <i class="fa fa-calendar-check"></i>
                        <span>Kunjungan</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar-day"></i>
                        <span>Jadwal Praktek</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-medical-alt"></i>
                        <span>Rekam Medis</span>
                    </a>
                </li>
                <li>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="quit-btn">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="content">
            @yield('side')
        </div>
        <!-- End Sidebar -->

        <!-- End Custom template -->
    </div>

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
</body>

</html>
