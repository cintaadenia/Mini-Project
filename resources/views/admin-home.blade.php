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
                    <td>{{ $jumlahPasien }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
