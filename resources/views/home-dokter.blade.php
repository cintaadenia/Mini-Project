@extends('layouts.sidebar')

<style>
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
        height: 30%;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0.576), rgba(255, 255, 255, 0));
        z-index: 1;
    }

    .welcome-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: left;
    }

    .welcome img {
        width: auto;
        height: 310px;
        z-index: 5;
    }

    .profile {
        border-radius: 1.5rem;
        min-width: 550px;
        max-width: 550px;
        height: 300px;
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
        border-radius: 1.5rem;
        font-size: 0.9rem;
        font-weight: 600;
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

    .profile-info a {
        border: solid 1px #ccc;
        background: var(--main-color);
        border-radius: 10px;
        text-decoration: none;
        color: #ffffff;
        padding: 5px 16px;
        transition: ease;
    }

    .profile-info a:hover {
        background: #20a0ef;
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

    .content-table {
        /* max-width: 1800px; */
    }

    .outer-table {
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 1rem;
        width: 100%;
        /* max-width: 1200px */
        height: auto;
        margin-top: 1rem;
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
        border-radius: 1rem;
        padding: 20px;
        text-align: center;
        width: 600px;
        height: 600px;
    }

    .chart-container {
        position: relative;
        width: 250px;
        height: 250px;
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

@section('side')
    <div class="d-flex j-between">
        <div class="welcome drop-shadow ml-2 mt-2 mb-2">
            <div class="welcome-text ml-3 col d-flex j-center">
                <h2 class="h1 f-bolder">Selamat Datang, Dr. {{Auth::user()->name}}</h2>
                <p class="p3 f-bolder">Semoga Harimu Menyenangkan</p>
            </div>
            <img src="{{ asset('asset/img/dokter.png') }}" alt="">
        </div>
        <div class="profile m-2">
            <div class="profile-header p-1">
                <h1>Profile Saya</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: transparent; outline: none; border: none;" id="openModal"><i
                        class="fa-solid fa-pen"></i></button>
            </div>
            @if (Auth::check())
                <div class="profile-info drop-shadow">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('asset/img/dokter.png') }}"
                        width="auto" alt="Foto Profil">
                    <div class="profile-info-text">
                        <h2 class="h2">{{ Auth::user()->name }}</h2>
                        <p class="p4 f-bold mb-1">Spesialisasi: {{ Auth::user()->spesialisasi }}</p>
                        <!-- Link untuk mengarahkan ke halaman edit profil -->
                        <a href="{{ route('profile.update') }}" class="f-bold">Ubah Profil</a>
                    </div>
                </div>
            @endif

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

    <div class="content-card">
        <div class="content-bottom-top d-flex row">
            <div class="card-v bg-white col ml-2 mr-2 pl-2 pr-2 j-center d-flex drop-shadow">
                <h2>Total Pasien</h2>
                <div class="card-info d-flex p-1 row">
                    <i class="fa-solid fa-bed-pulse i2 main-color"></i>
                    <div class="card-info ml-2">
                        <h2>208</h2>
                        <p class="f-normal">Jumlah Seluruh Pasien yang terdaftar di klinik</p>
                    </div>
                </div>
            </div>
            <div class="card-v bg-white col ml-2 mr-2 pl-2 pr-2 j-center d-flex drop-shadow">
                <h2>Janji Hari ini</h2>
                <div class="card-info d-flex p-1 row">
                    <i class="fa-solid fa-list-check i2 main-color "></i>
                    <div class="card-info ml-2">
                        <h2>208</h2>
                        <p class="f-normal">Jumlah Seluruh Pasien yang terdaftar di klinik</p>
                    </div>
                </div>
            </div>
            <div class="card-v bg-white col ml-2 mr-2 pl-2 pr-2 j-center d-flex drop-shadow">
                <h2>Menunggu</h2>
                <div class="card-info d-flex p-1 row">
                    <i class="fa-solid fa-user-clock i2 main-color"></i>
                    <div class="card-info ml-2">
                        <h2>208</h2>
                        <p class="f-normal">Janji Hari Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-table m-2 d-flex j-between">
        <div class="outer-table drop-shadow mr-1">
            <div class="d-flex j-between">
                <div class="content-table-text m-1 a-center">
                    <h2 class="h2">Data Terbaru Kunjungan Pasien</h2>
                </div>
                <div class="search-container m-1">
                    <input type="text" placeholder="Search here...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="content-table-table">
                <table>
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                    </tr>
                    @foreach ($kunjungans as $kun)
                    <tr>
                        <td>{{$kun->pasien->nama}}</td>
                        <td>{{$kun->keluhan}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="content-chart m-1 drop-shadow">
            <h2 class="h2 f-bolder">Data Kunjungan Perbulan</h2 class="h2 f-bolder">
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
            <div class="legend">
                <div class="legend-left">
                    <div class="selesai"><span></span>Selesai: 20 (9.62%)</div>
                    <div class="menunggu"><span></span>Menunggu: 25 (12.02%)</div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-table m-2">
        <div class="outer-table drop-shadow mr-1">
            <div class="d-flex j-between">
                <div class="content-table-text m-1">
                    <h2 class="h2">Data Kunjungan Pasien</h2>
                </div>
                <div class="search-container m-1">
                    <input type="text" placeholder="Search here...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="content-table-table">
                <table>
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                    </tr>
                    @foreach ($kunjungan as $k)
                    <tr>
                        <td>{{$k->pasien->nama}}</td>
                        <td>{{$k->keluhan}}</td>
                        <td>{{$k->}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Menunggu'],
            datasets: [{
                data: [20, 25],
                backgroundColor: [
                    '#ff6384',
                    '#36a2eb',
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection