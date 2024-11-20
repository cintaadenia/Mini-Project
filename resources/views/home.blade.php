@extends('layouts.app')

@section('content')
@include('layouts.sidebar')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
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

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('jumlahPasienChart').getContext('2d');
    const jumlahPasienChart = new Chart(ctx, {
        type: 'bar', // Bisa diganti 'line', 'pie', dsb.
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
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
