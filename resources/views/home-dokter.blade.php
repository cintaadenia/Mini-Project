<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .header {
            display: flex;
            justify-content: space-between;
            padding: 2rem 2rem 0 2rem;
        }

        .content-header {
            display: inline;
            justify-content: center;
            align-items: center;
            width: 1200px;
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

        .welcome {
            display: flex;
            justify-content: space-between;
            overflow: hidden;
            width: 100%;
            height: 300px;
            margin: 1.5rem 0;
            background: url('/asset/img/hero.png') no-repeat left bottom;
            background-size: cover;
            border-radius: 1.2rem;
            color: rgb(255, 255, 255);
            text-align: left;
        }

        .welcome-text {
            font-weight: 600;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;
            padding: 1.5rem;
        }

        .welcome h2 {
            font-size: 2.7rem;
            margin-bottom: 10px;
        }

        .welcome p {
            font-size: 1.7rem;
            margin-top: 0;
        }

        .welcome img {
            width: auto;
            height: 310px;
        }

        .profile {
            /* border: 1px solid #000; */
            border-radius: 1.5rem;
            width: 600px;
            height: 370px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--main-color);
            width: 100%;
            padding: 2rem 1.5rem;
            border-radius: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            z-index: 2;
        }

        .profile-header i {
            font-size: 1.5rem;
            background-color: #D9D9D980;
            border-radius: 1rem;
            padding: 1rem;
            text-align: right;
        }

        .profile-info {
            display: flex;
            border: 1px solid #ccc;
            border-radius: 20px;
            align-items: center;
            width: 100%;
            height: 1500px;
            position: relative;
            top: -20px;
            background-color: white;
        }

        .profile-info h2 {
            font-size: 2rem;
            font-weight: 600;
            margin: 10px 0;
        }

        .profile-info p {
            font-size: 1.3rem;
            font-weight: 500;
            margin: 10px 0 20px 0;
        }

        .profile-info a {
            border: solid 1px #ccc;
            border-radius: 1rem;
            text-decoration: none;
            color: #000;
            padding: 3px 10px;
        }

        .profile-info img {
            width: 150px;
            margin: 1rem 2rem 1rem 3rem;
            height: auto;
            border-radius: 50%;
            border: 1px solid #ccc;
            object-fit: cover;
        }

        .content-bottom {
            display: flex;
            justify-content: space-between;
            padding: 0 2rem 2rem 2rem;
            margin-top: 2rem;
        }

        .outer-table {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 1200px;
            height: 900px;
            margin-top: 2rem;
        }

        .content-table {
            display: flex;
            flex-direction: column;
            font-weight: 600;
        }

        .content-table h2 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .content-table p {
            font-size: 1.3rem;
            font-weight: 550;
        }

        .content-table-table {
            margin: 1rem;
            width: auto;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-weight: 500;
            font-size: 1.2rem;
        }

        table th {
            background-color: var(--main-color);
            color: #fff;
            text-align: left;
            padding: 1.2rem 1rem;
        }

        table td {
            padding: 1.5rem 1rem;
            color: #474747;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:hover td {
            background-color: #f1f1f1;
        }

        .content-chart {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            width: 600px;
            height: 700px;
        }

        .content-chart h1 {
            text-align: left;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .chart-container {
            position: relative;
            width: 400px;
            height: 400px;
            margin: 3rem auto;
        }

        .legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 3rem;
            margin: 2rem 2rem 0 2rem;

        }

        .legend-left,
        .legend-right {
            display: inline;
        }

        .legend-left div {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 10px 10px;
        }

        .legend-right div {
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 10px 10px;
        }

        .legend div span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }

        .legend .mei span {
            background-color: #ff6384;
        }

        .legend .juni span {
            background-color: #36a2eb;
        }

        .legend .juli span {
            background-color: #ffce56;
        }

        .legend .agustus span {
            background-color: #4bc0c0;
        }

        .legend .september span {
            background-color: #9966ff;
        }

        .legend .oktober span {
            background-color: #ff9f40;
        }

        .legend .november span {
            background-color: #c9cbcf;
        }

        .legend .desember span {
            background-color: #7e57c2;
        }

        @media screen and (max-width: 1366px) {
            :root {
                --main-color: #0F8CA9;
            }

            body {
                font-size: 0.8rem;
                /* Font utama dikecilkan */
            }

            .header {
                padding: 1rem 1rem 0 1rem;
            }

            .content-header {
                width: 900px;
                /* Menyesuaikan lebar layar */
            }

            .search input {
                height: 40px;
                /* Ukuran input lebih kecil */
                margin: 1rem 0;
                border-radius: 0.8rem;
            }

            .search-container {
                height: 50px;
                /* Tinggi kontainer pencarian */
                border-radius: 1rem;
                padding: 3px 8px;
            }

            .search-container input {
                font-size: 1rem;
                /* Font input lebih kecil */
            }

            .welcome {
                height: 200px;
                /* Tinggi elemen welcome lebih kecil */
                margin: 1rem 0;
                border-radius: 0.8rem;
            }

            .welcome h2 {
                font-size: 2rem;
                /* Font judul lebih kecil */
            }

            .welcome p {
                font-size: 1.2rem;
                /* Font deskripsi lebih kecil */
            }

            .welcome img {
                height: 200px;
                /* Tinggi gambar lebih kecil */
            }

            .profile {
                width: 400px;
                /* Lebar profil lebih kecil */
                height: 250px;
                /* Tinggi profil lebih kecil */
            }

            .profile-header {
                padding: 1rem;
                /* Padding lebih kecil */
                font-size: 0.7rem;
                /* Font lebih kecil */
            }

            .profile-header i {
                font-size: 1rem;
                padding: 0.5rem;
            }

            .profile-info {
                height: 1000px;
                /* Tinggi profil-info lebih kecil */
            }

            .profile-info h2 {
                font-size: 1.5rem;
                /* Font heading lebih kecil */
            }

            .profile-info p {
                font-size: 1rem;
                /* Font paragraf lebih kecil */
            }

            .profile-info a {
                padding: 2px 8px;
                /* Padding tautan lebih kecil */
                font-size: 0.9rem;
                /* Font tautan lebih kecil */
            }

            .profile-info img {
                width: 100px;
                /* Gambar profil lebih kecil */
            }

            .content-bottom {
                padding: 0 1rem 1rem 1rem;
                /* Padding lebih kecil */
                margin-top: 1rem;
            }

            .outer-table {
                width: 900px;
                /* Lebar tabel lebih kecil */
                height: 600px;
                /* Tinggi tabel lebih kecil */
            }

            .content-table h2 {
                font-size: 2rem;
                /* Font heading tabel lebih kecil */
            }

            .content-table p {
                font-size: 1rem;
                /* Font deskripsi tabel lebih kecil */
            }

            table th,
            table td {
                padding: 0.8rem 0.5rem;
                /* Padding cell lebih kecil */
                font-size: 1rem;
                /* Font cell lebih kecil */
            }

            .content-chart {
                width: 400px;
                /* Lebar chart lebih kecil */
                height: 500px;
                /* Tinggi chart lebih kecil */
                padding: 15px;
            }

            .chart-container {
                width: 200px;
                /* Lebar kontainer chart lebih kecil */
                height: 200px;
                /* Tinggi kontainer chart lebih kecil */
            }

            .legend {
                margin: 1rem 1rem 0 1rem;
                /* Margin legend lebih kecil */
            }

            .legend div {
                font-size: 0.8rem;
                /* Font legend lebih kecil */
                margin: 5px 5px;
                /* Margin antara elemen legend lebih kecil */
            }

            .legend div span {
                width: 8px;
                /* Lebar indikator legend lebih kecil */
                height: 8px;
                /* Tinggi indikator legend lebih kecil */
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="content-header">
                <div class="search-container">
                    <input type="text" placeholder="Search here...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="welcome">
                    <div class="welcome-text">
                        <h2>Selamat Datang, Dr. [Nama Dokter]!</h2>
                        <p>Semoga Harimu Menyenangkan</p>
                    </div>
                    <img src="{{ asset('asset/img/dokter.png') }}" alt="">
                </div>
            </div>
            <div class="profile">
                <div class="profile-header">
                    <h1>Profile Saya</h1>
                    <a href="{{ route('profile')}}">
                        <i class="fa-solid fa-pen"></i>

                    </a>
                </div>
                <div class="profile-info">
                    <img src="{{ asset('asset/img/dokter.png') }}" width="auto" alt="">
                    <div class="profile-info-text">
                        <h2>Dr. Andi Wijaya</h2>
                        <p>Spesialisasi: Dokter Umum</p>
                        <a href="#">Ubah Foto</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-bottom">
            <div class="content-table">
                <div class="content-table-text">
                    <h2>Data Kunjungan Pasien</h2>
                    <p>Berikut adalah daftar pasien beserta keluhan yang terdaftar.</p>
                </div>
                <div class="outer-table">
                    <div class="content-table-table">
                        <table>
                            <tr>
                                <th>Nama Pasien</th>
                                <th>Keluhan</th>
                            </tr>
                            <tr>
                                <td>Ani Rahmawati</td>
                                <td>Demam tinggi dan sakit kepala</td>
                            </tr>
                            <tr>
                                <td>Ani Rahmawati</td>
                                <td>Demam tinggi dan sakit kepala</td>
                            </tr>
                            <tr>
                                <td>Ani Rahmawati</td>
                                <td>Demam tinggi dan sakit kepala</td>
                            </tr>
                            <tr>
                                <td>Ani Rahmawati</td>
                                <td>Demam tinggi dan sakit kepala</td>
                            </tr>
                            <tr>
                                <td>Ani Rahmawati</td>
                                <td>Demam tinggi dan sakit kepala</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="content-chart">
                <h1>Data Kunjungan</h1>
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="legend">
                    <div class="legend-left">
                        <div class="mei"><span></span>Mei: 20 (9.62%)</div>
                        <div class="juni"><span></span>Juni: 25 (12.02%)</div>
                        <div class="juli"><span></span>Juli: 10 (4.81%)</div>
                        <div class="agustus"><span></span>Agustus: 35 (16.83%)</div>
                    </div>
                    <div class="legend-right">
                        <div class="september"><span></span>September: 18 (8.65%)</div>
                        <div class="oktober"><span></span>Oktober: 28 (13.46%)</div>
                        <div class="november"><span></span>November: 32 (15.38%)</div>
                        <div class="desember"><span></span>Desember: 40 (19.23%)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    data: [20, 25, 10, 35, 18, 28, 32, 40],
                    backgroundColor: [
                        '#ff6384',
                        '#36a2eb',
                        '#ffce56',
                        '#4bc0c0',
                        '#9966ff',
                        '#ff9f40',
                        '#c9cbcf',
                        '#7e57c2'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw;
                                label += ' (' + (context.raw / 208 * 100).toFixed(2) + '%)';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
