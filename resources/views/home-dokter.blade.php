<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .content-header {
            display: inline;
            justify-content: center;
            align-items: center;
            max-width: 1170px;
            margin-right: 1rem;
        }

        .search-button:hover {
            background-color: #0d6e7a;
            /* Darker shade on hover */
        }


        .search-button {
            background-color: var(--main-color);
            color: white;
            border: none;
            border-radius: 0 1.5rem 1.5rem 0;
            padding: 10px 20px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 1.5rem;
            padding: 10px;
            border-radius: 1.5rem 0 0 1.5rem;
        }

        .search-container {
            display: flex;
            align-items: center;
            width: 100%;
            height: 70px;
            border: 2px solid #ccc;
            border-radius: 1.5rem;
            padding: 5px;
            background-color: #fff;
        }

        .fa-magnifying-glass {
            color: #888;
            margin-left: 10px;
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
            background: url('/asset/img/hero.png') no-repeat left bottom;
            background-size: cover;
            border-radius: 1.2rem;
            color: rgb(255, 255, 255);
            text-align: left;
        }

        .welcome::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 20%;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.576), rgba(255, 255, 255, 0));
            z-index: 1;
        }

        .search-input::placeholder {
            color: #aaa;
        }

        .welcome-text {
            font-weight: 600;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: left;
            padding: 1.5rem;
            z-index: 2;
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
            z-index: 2;
        }

        .profile {
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
            font-weight: 600;
            color: #fff;
            z-index: 2;
        }

        .profile-header h1 {
            align-items: center;
            font-weight: 700;
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
            width: 1170px;
            height: 900px;
            margin-top: 1rem;
        }

        .content-table {
            display: flex;
            flex-direction: column;
            font-weight: 600;
            position: relative;
            top: -60px;
            margin-right: 1rem;
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
            max-height: 750px;
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
            .content-header {
                max-width: 770px;
            }

            .welcome {
                height: 200px;
                border-radius: 0.8rem;
            }

            .welcome h2 {
                font-size: 2rem;
            }

            .welcome p {
                font-size: 1.2rem;
            }

            .welcome img {
                height: 200px;
            }

            .profile {
                width: 400px;
                height: 250px;
            }

            .profile-header {
                padding: 1rem;
                font-size: 0.7rem;
            }

            .profile-header h2 {
                font-size: 1.4rem;
            }

            .profile-header i {
                font-size: 1rem;
                padding: 0.5rem;
            }

            .profile-info {
                height: 1000px;
            }

            .profile-info h2 {
                font-size: 1.5rem;
            }

            .profile-info p {
                font-size: 1rem;
            }

            .profile-info a {
                padding: 2px 8px;
                font-size: 0.9rem;
            }

            .profile-info img {
                width: 100px;
            }

            .content-bottom {
                padding: 0 1rem 1rem 1rem;
                margin-top: 1rem;
            }

            .outer-table {
                width: 770px;
                height: 600px;
            }

            .content-table h2 {
                font-size: 2rem;
            }

            .content-table p {
                font-size: 1rem;
            }

            table th,
            table td {
                padding: 0.8rem 0.5rem;
                font-size: 1rem;
            }

            .content-chart {
                width: 400px;
                height: 500px;
                padding: 15px;
            }

            .chart-container {
                width: 200px;
                height: 200px;
            }

            .legend {
                margin: 1rem 1rem 0 1rem;
            }

            .legend div {
                font-size: 0.8rem;
                margin: 5px 5px;
            }

            .legend div span {
                width: 8px;
                height: 8px;
                /* Tinggi indikator legend lebih kecil */
            }

            #editModal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: none;
                justify-content: center;
                align-items: center;
            }

            #editModal form {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                max-width: 500px;
                width: 100%;
            }

        }

        /* Modal backdrop */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
        }

        /* Modal content box */
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            /* Vertically and horizontally centered */
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            /* Adjust the width as needed */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

@extends('layouts.sidebar')
@section('side')
    <div class="header">
        <div class="content-header">
            <div class="welcome drop-shadow">
                <div class="welcome-text">
                    @if (Auth::check())
                        <h2>Selamat Datang, Dr. {{ Auth::user()->name }}!</h2>
                    @else
                        <h2>Selamat Datang, Tamu!</h2>
                    @endif

                </div>
                <img src="{{ asset('asset/img/dokter.png') }}" alt="">
            </div>
        </div>
        <div class="profile">
            <div class="profile-header">

                <h1>Profile Saya</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: transparent; outline: none; border: none;" id="openModal"><i
                        class="fa-solid fa-pen"></i></button>
            </div>
            {{-- @if (Auth::check()) --}}
            <div class="profile-info drop-shadow">
                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('asset/img/dokter.png') }}"
                    width="auto" alt="Foto Profil">
                <div class="profile-info-text">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>Spesialisasi: {{ Auth::user()->spesialisasi }}</p>
                    <!-- Link untuk mengarahkan ke halaman edit profil -->
                    <a href="{{ route('profile.update') }}" class="btn btn-primary">Ubah Profil</a>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <h2>Edit Profile</h2>
            <form>
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
                <br><br>
                <label for="image">Foto:</label>
                <input type="file" id="image" name="image" required>
                <br><br>
                <label for="spesialis">Spesialis</label>
                <input type="text" id="spesialis" name="spesialis">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div class="content-bottom">
        <div class="content-table">
            <div class="content-table-text">
                <h2>Data Kunjungan Pasien</h2>
                <p>Berikut adalah daftar pasien beserta keluhan yang terdaftar.</p>
            </div>

            <div class="search-container">
                <form method="GET" action="{{ route('home-dokter') }}"
                    style="display: flex; align-items: center; width: 100%;">
                    <input type="text" name="search" placeholder="Search here..." value="{{ request('search') }}"
                        class="search-input">
                    <button type="submit" class="search-button">Search</button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            <div class="outer-table drop-shadow">
                <div class="content-table-table ">
                    <table>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Keluhan</th>
                        </tr>
                        @foreach ($kunjungans as $kunjunganItem)
                            <tr>
                                <td>{{ $kunjunganItem->pasien ? $kunjunganItem->pasien->nama : 'Pasien tidak ditemukan' }}
                                </td>
                                <td>{{ $kunjunganItem->tanggal_kunjungan }}</td>
                                <td>{{ $kunjunganItem->keluhan }}</td>
                                <td>
                                    @if ($kunjunganItem->resep)
                                        {{ $kunjunganItem->resep->deskripsi }}
                                    @else
                                        Belum ada diagnosa
                                    @endif
                                </td>
                                <td>
                                    <button class="open-modal" data-kunjungan-id="{{ $kunjunganItem->id }}">Tambah
                                        Diagnosa</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <!-- Modal for Adding Diagnosis -->
                    <div id="diagnosisModal" class="modal">
                        <div class="modal-content">
                            <span id="closeDiagnosisModal" class="close">&times;</span>
                            <h2>Tambah Diagnosa</h2>
                            <form id="diagnosisForm" method="POST" action="{{ route('resep.store') }}">
                                @csrf
                                <input type="hidden" name="kunjungan_id" id="kunjungan_id">
                                <label for="deskripsi">Diagnosa:</label>
                                <input type="text" id="deskripsi" name="deskripsi" required>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-chart drop-shadow">
            <h2 class="h2-title-bold h2-left">Data Kunjungan</h2>
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

    <script>
        // Dapatkan elemen
        const modal = document.getElementById('modal');
        const openModalBtn = document.getElementById('openModal');
        const closeModalBtn = document.getElementById('closeModal');

        // Fungsi untuk membuka modal
        openModalBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        // Fungsi untuk menutup modal
        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Tutup modal jika pengguna klik di luar area modal
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
    <script>
        // Get modal elements
        const diagnosisModal = document.getElementById('diagnosisModal');
        const closeDiagnosisModalBtn = document.getElementById('closeDiagnosisModal');

        // Open modal when "Tambah Diagnosa" button is clicked
        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', function() {
                const kunjunganId = this.getAttribute('data-kunjungan-id');
                document.getElementById('kunjungan_id').value =
                    kunjunganId; // Set the kunjungan_id in the form
                diagnosisModal.style.display = 'block'; // Show the modal
            });
        });

        // Close modal when close button is clicked
        closeDiagnosisModalBtn.addEventListener('click', () => {
            diagnosisModal.style.display = 'none';
        });

        // Close modal when clicking outside of the modal
        window.addEventListener('click', (event) => {
            if (event.target === diagnosisModal) {
                diagnosisModal.style.display = 'none';
            }
        });
    </script>
    </body>

    </html>
@endsection
