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
            <p>{{ __('You are logged in!') }}</p>

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

<!-- Script untuk Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('jumlahPasienChart').getContext('2d');
  const jumlahPasienChart = new Chart(ctx, {
      type: 'bar', // Tipe chart, bisa diganti 'line', 'pie', dll.
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
          scales: {
              y: {
                  beginAtZero: true // Pastikan dimulai dari 0
              }
          },
          responsive: true,
          maintainAspectRatio: false
      }
  });
</script>
@endsection
