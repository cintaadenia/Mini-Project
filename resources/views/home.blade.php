<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Klinik
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/home_dashboard.css">
</head>

<body>
    @if (session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
    @endif
    <header>
    {{-- <header>
        <h1>
            KLINIK
        </h1>
        <nav>
            <a href="#page-2">
                Dokter
            </a>
            <a href="#patien-info">
                Pasien
            </a>
            <a href="#form-section">
                Kunjungan
            </a>
            <a href="#">
                Diagnosa
            </a>
        </nav>
        <div class="gap"></div> --}}
    </header>
    <nav class="navbar">
        <h1>
            KLINIK
        </h1>
        <ul>
            <li><a href="#page-doctor">
                    Dokter
                </a></li>
            <li><a href="#form-section">
                    Pasien
                </a></li>
            <li><a href="#hero">
                    Kunjungan
                </a></li>
            <li><a href="#">
                    Diagnosa
                </a></li>
        </ul>
        <div class="gap"></div>
    </nav>
    <section id="hero" class="hero">
        <div class="hero-content">
            <div>
                <h2>
                    Selamat Datang di <br>
                    <span>
                        KLINIK
                    </span>
                </h2>
                <p>
                    Jangan ragu untuk membuat janji temu dengan dokter <br> melalui website ini.
                </p>
            </div>
            <div class="button">
                <a href="{{route('kunjungan.index')}}">Janji Temu</a>
            </div>
        </div>
        <div class="img">
            <img alt="Dokter memegang clipboard" src="{{ asset('Medicio/assets/img/doctorphoto.png') }}" />
        </div>
    </section>
    <section id="page-doctor" class="page-doctor">
        <div id="section-title" class="section-title">
            <h3>
                Tim Dokter Spesialis Kami
            </h3>
            <p>
                Kami menghadirkan layanan kesehatan terbaik dengan <br> dukungan dokter berpengalaman di bidangnya.
            </p>
        </div>
        <div id="doctors" class="doctors">
            <div class="doctor-group">
                <div class="doctor-card">
                    <img alt="Dr. Andi Wijaya, Sp.PD" height="200"
                        src="https://storage.googleapis.com/a1aa/image/k7Q1hnfWuKVtIi5aWNptzoqk3CHxmZU28e1NbYwdqDkCwD3TA.jpg"
                        width="200" />
                    <h4>
                        Dr. Andi Wijaya, Sp.PD
                    </h4>
                    <p>
                        Dokter Spesialis Penyakit Dalam
                    </p>
                    <p>
                        Senin - Jumat, 08:00 - 16:00
                    </p>
                </div>
                <div class="doctor-card">
                    <img alt="Dr. Siti Nurhaliza, Sp.A" height="200"
                        src="https://storage.googleapis.com/a1aa/image/M52TCe3fgnltnk06sAx7t5HXQAKScCmf7o0lBNdBt7UIgHunA.jpg"
                        width="200" />
                    <h4>
                        Dr. Siti Nurhaliza, Sp.A
                    </h4>
                    <p>
                        Dokter Spesialis Anak
                    </p>
                    <p>
                        Senin - Sabtu, 09:00 - 17:00
                    </p>
                </div>
                <div class="doctor-card">
                    <img alt="Dr. Bagus Pratama, Sp.OG" height="200"
                        src="https://storage.googleapis.com/a1aa/image/J2ieJP8BF9U9OidzseW75RhTS3qjCsdYSvkxlSjKNsVGwD3TA.jpg"
                        width="200" />
                    <h4>
                        Dr. Bagus Pratama, Sp.OG
                    </h4>
                    <p>
                        Dokter Spesialis Kandungan
                    </p>
                    <p>
                        Senin - Jumat, 10:00 - 14:00
                    </p>
                </div>
                <div class="doctor-card">
                    <img alt="Dr. Rina Suhartini, Sp.KK" height="200"
                        src="https://storage.googleapis.com/a1aa/image/CQRA6lv8TC7AOx37XgsYcuF0oDdz486bRjCpYfgl8DRE4h7JA.jpg"
                        width="200" />
                    <h4>
                        Dr. Rina Suhartini, Sp.KK
                    </h4>
                    <p>
                        Dokter Spesialis Kulit dan Kelamin
                    </p>
                    <p>
                        Selasa, Kamis, Sabtu, 13:00 - 19:00
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="form-section" class="form-section">
        <div class="form-left">
            <h3>
                Lengkapi Data <br> Diri Anda
            </h3>
            <p>
                Masukkan informasi Anda untuk <br> membuat janji atau mengakses layanan <br> kami.
            </p>
        </div>
        <div class="form-right" id="form-pasien">
            <form action="{{ route('pasien.store') }}" method="POST">
                @csrf
                <input placeholder="Nama Lengkap" type="text" name="nama" value="{{ old('nama') }}" />
                @error('nama')
                    <p style="color: red">{{ $message }}</p>
                @enderror
                <input placeholder="Alamat" type="text" name="alamat" value="{{ old('alamat') }}" />
                @error('alamat')
                    <p style="color: red">{{ $message }}</p>
                @enderror
                <input placeholder="Nomor Handphone" type="text" name="no_hp" value="{{ old('no_hp') }}" />
                @error('no_hp')
                    <p style="color: red">{{ $message }}</p>
                @enderror
                <input placeholder="Tanggal Lahir" type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}" />
                @error('tanggal_lahir')
                    <p style="color: red">{{ $message }}</p>
                @enderror
                <button type="submit">
                    Kirim
                </button>
            </form>
        </div>
    </section>
    <section id="patien-info" class="patient-info">
        <h3>
            Informasi Pasien
        </h3>
        <p>
            Data yang Anda isi akan digunakan untuk <br> kebutuhan pelayanan kesehatan.
        </p>
        <div class="container">
            @foreach ($pasien as $pas)
                <div class="patient-card">
                    <p>
                        <i class="fas fa-user"></i>
                        <span class="label">Nama        :</span>
                        <span class="value">{{ $pas->nama }}</span>
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="label">Alamat      :</span>
                        <span class="value">{{ $pas->alamat }}</span>
                    </p>
                    <p>
                        <i class="fas fa-phone"></i>
                        <span class="label">No. HP      :</span>
                        <span class="value">{{ $pas->no_hp }}</span>
                    </p>
                    <p>
                        <i class="fas fa-calendar-alt"></i>
                        <span class="label">Tgl Lahir   :</span>
                        <span class="value">{{ $pas->tanggal_lahir }}</span>
                    </p>
                </div>
            @endforeach
        </div>
    </section>
</body>
<script>
    document.querySelectorAll('nav a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>


</html>
