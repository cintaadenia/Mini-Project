<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Rekam Medis</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Ganti jika menggunakan CSS berbeda -->
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Nota Rekam Medis</h2>
        <hr>
        <p><strong>Pasien:</strong> {{ $rekamMedis->kunjungan->pasien->nama }}</p>
        <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
        <p><strong>Tindakan:</strong> {{ $rekamMedis->tindakan }}</p>
        <hr>
        <h4>Obat</h4>
        <ul>
            @foreach ($rekamMedis->obats as $obat)
                <li>{{ $obat->obat }} - Jumlah: {{ $obat->pivot->jumlah }} - Harga: Rp {{ number_format($obat->harga, 0, ',', '.') }}</li>
            @endforeach
        </ul>
        <h4>Fasilitas</h4>
        <ul>
            @foreach ($rekamMedis->peralatans as $peralatan)
                <li>{{ $peralatan->nama_peralatan }} - Harga: Rp {{ number_format($peralatan->harga, 0, ',', '.') }}</li>
            @endforeach
        </ul>
        <hr>
        <h4>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h4>
        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">Print Nota</button>
        </div>
    </div>
</body>
</html>
