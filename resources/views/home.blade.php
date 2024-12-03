@extends('layouts.index')
@section('index')
    <div class="container-fluid">

        <div class="page-header min-height-300 border-radius-xl mt-4" style=""><span
                class="mask bg-gradient-success opacity-6"></span></div>

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
                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Eveniet vero ducimus totam dicta cum consectetur reiciendis possimus libero
                                                dolor corporis repudiandae similique ipsam debitis voluptate enim iure
                                                quisquam, iusto voluptatibus.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <dotlottie-player
                                            src="https://lottie.host/10944744-7d58-486a-bb9f-ba57e1717d71/h8h6VNOo6G.lottie"
                                            background="transparent" speed="1" style="width: 300px; height: 300px" loop
                                            autoplay></dotlottie-player>
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
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    @endsection
