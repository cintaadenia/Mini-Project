@extends('layouts.sidebar')
@section('side')

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
            <h1>Anda adalah ADMIN</h1>

            <div class="mt-4">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tambahkan Script untuk Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
</script>

@endsection
