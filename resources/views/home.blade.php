@extends('layouts.app')
@section('content')
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

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card mb-3" style="width: full height: 200px;">
                        <div class="row no-gutters">
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Selamat Datang {{ Auth::user()->name }}</h5>
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet vero ducimus totam dicta cum consectetur reiciendis possimus libero dolor corporis repudiandae similique ipsam debitis voluptate enim iure quisquam, iusto voluptatibus.</p>
                            </div>
                          </div>
                          <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <img src="{{ asset('Medicio/assets/img/doctors/doctors-1.jpg') }}" class="card-img" alt="Profile Picture">
                          </div>
                        </div>
                      </div>
                    {{-- {{ __('You are logged in!') }} --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
