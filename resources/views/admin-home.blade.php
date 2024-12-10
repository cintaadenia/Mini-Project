@extends('layouts.sidebar')
@section('side')

<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" style="background-color: rgb(132, 132, 248)">
          <div class="card-body">
            {{-- @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif --}}
            {{-- @if (auth()->user()->hasRole('admin')) --}}
            <div class="header-admin">
              <div class="text-section">
                <h1>Selamat datang,Admin!</h1>
            <h3>Kelola data klinik anda dengan mudah.</h3>
              </div>
            <img src="/asset/img/dokter.png" alt="">
            </div>


            {{-- <div class="mt-4">
              <h5>Statistik</h5>
              <!-- Tabel Data -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Jumlah Pasien</td>
                    <td>{{ DB::table('pasiens')->count() }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Dokter</td>
                    <td>{{ DB::table('dokters')->count() }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Obat</td>
                    <td>{{ DB::table('obats')->count() }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Kunjungan</td>
                    <td>{{ DB::table('kunjungans')->count() }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Resep</td>
                    <td>{{ DB::table('reseps')->count() }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Rekam Medis</td>
                    <td>{{ DB::table('rekam_medis')->count() }}</td>
                  </tr>
                </tbody>
              </table>

              <!-- Chart -->
              <div class="mt-4">
                <canvas id="statisticsChart" width="400" height="200"></canvas>
              </div>
            </div> --}}
            {{-- @endif --}}
            {{-- @if (auth()->user()->hasRole('dokter'))
            <h1>Anda adalah Dokter</h1>
            @endif --}}
          </div>
        </div>
        <div class="container-square">
          <div class="square">
            <div class="title">Total pasien</div>
            <div class="subtitle-container">
                <div class="subtitle" style="font-size: 50px"><i class="bi bi-person-plus"></i></div>
                <div class="item">
                  <h5>2008</h5>
                  <h5>jumlah seluruh pasien yang terdaftar dari klinik</h5>
                </div>
            </div>
        </div>
        <div class="square2">
          <div class="title2">Total pasien</div>
          <div class="subtitle-container2">
              <div class="subtitle2" style="font-size: 50px"><i class="fas fa-user-md"></i></i></div>
              <div class="item">
                <h5>15</h5>
                <h5>jumlah seluruh dokter yang sedang aktif dan tersedia dari klinik</h5>
              </div>
          </div>
      </div>
      <div class="square3">
        <div class="title3">presentasi dokter menangani pasien</div>
        <div class="subtitle-container3">
            <div>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
        </div>
        <div class="square4">
          <div class="title4">data kunjungan per bulan</div>
          <div class="subtitle-container4">
            <div style="width: 70%; margin: auto; padding-top: 10px;">
                <canvas id="barChart"></canvas>
            </div>
          </div>
      </div>
      </div>
    </div>
  </div>
</div>

<script>
    // Diagram Batang
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: [120, 150, 180, 130, 170, 200],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Diagram Lingkaran
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['dr.asep', 'dr.raza', 'dr.kika', 'dr.mike', 'dr.putra', 'dr.fany'],
            datasets: [{
                label: 'Jumlah pasien',
                data: [120, 150, 180, 130, 170, 200],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
</script>

<!-- Tambahkan Script untuk Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script>
  // Data untuk Chart
  const data = {
      labels: [
          'Pasien',
          'Dokter',
          'Obat',
          'Kunjungan',
          'Resep',
          'Rekam Medis'
      ],
      datasets: [{
          label: 'Statistik Data',
          data: [
              {{ DB::table('pasiens')->count() }},
              {{ DB::table('dokters')->count() }},
              {{ DB::table('obats')->count() }},
              {{ DB::table('kunjungans')->count() }},
              {{ DB::table('reseps')->count() }},
              {{ DB::table('rekam_medis')->count() }}
          ], // Data dari backend
          backgroundColor: [
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
      }]
  };

  // Konfigurasi Chart
  const config = {
      type: 'bar', // Tipe chart (bar chart)
      data: data,
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
              y: {
                  beginAtZero: true // Mulai dari 0
              }
          }
      }
  };

  // Render Chart
  const ctx = document.getElementById('statisticsChart').getContext('2d');
  const statisticsChart = new Chart(ctx, config);
</script> --}}

@endsection
