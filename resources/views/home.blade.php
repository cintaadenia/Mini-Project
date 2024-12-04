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
    <style>
        :root {
            --main-color: #2697b1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            border-bottom: 1px solid #000000;
            position: fixed;
            width: 100%;
            padding: 1.5rem 2rem;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .navbar h1 {
            color: var(--main-color);
            font-size: 3rem;
            font-weight: 900;
            margin: 0;
        }

        .navbar ul {
            display: flex;
            text-decoration: none;
        }

        .navbar ul li {
            display: inline-block;
        }

        .navbar ul li a {
            margin: 0 2rem;
            text-decoration: none;
            color: #333;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .hero {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            padding: 120px 40px 0 40px;
            background-color: #f5f5f5;
            overflow: hidden;
            position: relative;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
        }

        .hero h2 {
            font-size: 6rem;
            font-weight: 900;
            margin: 0;
        }

        .hero h2 span {
            color: var(--main-color);
        }

        .hero p {
            font-size: 2rem;
            font-weight: 600;
            margin: 10px 0 20px;
        }

        .button {
            margin: 4rem 0;
        }

        .hero a {
            background-color: var(--main-color);
            color: white;
            border: none;
            padding: 1rem 4rem;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border-radius: 12px;
            margin-top: 5rem;
        }

        .hero img {
            height: 900px;
            width: auto;
            object-fit: cover;
            margin-left: 0;
        }

        .page-doctor {
            padding: 148px 0 2rem;
        }

        .section-title {
            text-align: center;
        }

        .section-title h3 {
            font-size: 4rem;
            margin: 1rem;
        }

        .section-title p {
            font-size: 2rem;
        }

        .doctors {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 2rem 2rem 4rem 2rem;
        }

        .doctor-group {
            display: flex;
            padding: 0 12rem;
        }

        .doctor-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 20px;
            margin: 10px;
            width: 300px;
        }

        .doctor-card img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .doctor-card h4 {
            font-size: 1.5rem;
            margin: 10px 0 5px;
        }

        .doctor-card p {
            font-size: 1.2rem;
            color: #666;
            margin: 5px 0;
        }

        .form-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10rem 168px 0;
            text-align: center;
        }

        .form-left {
            text-align: left;
            align-items: left;
        }

        .form-left {
            padding: 6rem 4rem;
        }

        .form-right {
            display: flex;
            flex-direction: column;
            padding: 3rem 3.5rem;
            margin: 4rem 2rem;
            background: #87c5d4;
            border-radius: 64px;
            justify-content: center;
            align-items: center
        }

        .form-section h3 {
            font-size: 4rem;
            margin: 0 0 20px;
        }

        .form-section p {
            font-size: 1.5rem;
            color: #666;
            margin: 0 0 20px;
        }

        .form-section form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: left;
        }

        .form-section input {
            width: 750px;
            padding: 1.5rem 2rem;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1rem 0;
            border: 2px solid #8d8d8d;
            border-radius: 10px;
        }

        .form-section form button {
            background-color: #0f8ca9;
            color: white;
            border: none;
            width: 40%;
            padding: 1.5rem 1.5rem;
            font-size: 2rem;
            font-weight: 600;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .patient-info {
            padding: 6rem 12rem;
            text-align: center;
        }

        .patient-info h3 {
            font-size: 4rem;
            margin: 0 0 2rem;
        }

        .patient-info p {
            font-size: 2rem;
            color: #000000;
            margin: 0 0 6rem;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .patient-card {
            border: 1px solid #000000;
            border-radius: 16px;
            padding: 20px;
            width: 700px;
            text-align: left;
        }

        .patient-card p {
            margin: 5px 0;
            font-size: 2rem;
        }

        .patient-card i {
            margin-right: 10px;
        }

        .patient-card .label {
            width: 100px;
            /* Lebar tetap untuk label */
            font-weight: bold;
        }

        .patient-card .value {
            flex: 1;
            /* Membuat teks dinamis */
            color: #555;
        }

        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 1366px) {
            .navbar h1 {
                font-size: 2rem;
                /* Mengurangi ukuran font h1 */
            }

            .navbar ul li a {
                font-size: 1.2rem;
                /* Mengurangi ukuran font pada link navigasi */
                margin: 0 1rem;
                /* Mengurangi margin antar link */
            }

            .navbar {
                padding: 1rem 1.5rem;
                /* Mengurangi padding pada header */
            }

            .hero {
                padding: 96px 30px 0 30px;
                /* Mengurangi padding untuk ruang lebih efisien */
            }

            .hero-content {
                padding: 60px 0;
                /* Mengurangi padding vertikal */
            }

            .hero h2 {
                font-size: 4.5rem;
                /* Mengurangi ukuran font h2 */
            }

            .hero p {
                font-size: 1.6rem;
                /* Mengurangi ukuran font paragraf */
            }

            .hero a {
                padding: 0.8rem 3rem;
                /* Mengurangi padding pada tombol */
                font-size: 0.9rem;
                /* Mengurangi ukuran font pada tombol */
            }

            .hero img {
                height: 600px;
                width: auto;
                object-fit: cover;
                margin-left: 0;
            }

            .page-doctor {
                padding: 96px 0 0;
            }

            /* Section Title */
            .section-title h3 {
                font-size: 2.5rem;
                /* Mengurangi ukuran font judul */
            }

            .section-title p {
                font-size: 1.3rem;
                /* Mengurangi ukuran font paragraf */
            }

            /* Doctors Section */
            .doctor-group {
                padding: 0 6rem;
                /* Mengurangi padding pada grup dokter */
            }

            .doctor-card {
                width: 200;
                /* Mengurangi lebar kartu dokter */
                margin: 0.5rem 1rem;
                /* Mengurangi margin antar kartu dokter */
                padding: 15px;
                /* Mengurangi padding dalam kartu dokter */
            }

            .doctor-card h4 {
                font-size: 1.3rem;
                /* Mengurangi ukuran font nama dokter */
            }

            .doctor-card p {
                font-size: 1rem;
                /* Mengurangi ukuran font deskripsi dokter */
            }

            /* Form Section */
            .form-section {
                padding: 5rem 4rem 0;
                justify-content: space-evenly;
            }

            .form-left {
                padding: 4rem 2rem;
                /* Mengurangi padding pada form-left */
            }

            .form-right {
                display: flex;
                flex-direction: column;
                padding: 1rem 2rem;
                margin: 4rem 2rem;
                background: #87c5d4;
                border-radius: 32px;
                justify-content: center;
                align-items: center;
                width: 500px;
            }

            .form-section h3 {
                font-size: 2.5rem;
                /* Mengurangi ukuran font judul form */
            }

            .form-section p {
                font-size: 1.3rem;
            }

            .form-section input {
                width: 450px;
                /* Membuat input mengisi lebar 100% */
                padding: 0.8rem 1.8rem;
                /* Mengurangi padding dalam input */
                font-size: 1rem;
                /* Mengurangi ukuran font dalam input */
            }

            .form-section form button {
                width: 150px;
                /* Tombol mengisi 60% lebar */
                padding: 0.8rem 0.8rem;
                /* Mengurangi padding tombol */
                font-size: 1rem;
                /* Mengurangi ukuran font tombol */
            }

            /* Patient Info Section */
            .patient-info {
                padding: 4rem 6rem;
                /* Mengurangi padding pada patient-info */
            }

            .patient-info h3 {
                font-size: 3rem;
                /* Mengurangi ukuran font judul patient-info */
            }

            .patient-info p {
                font-size: 1.6rem;
                /* Mengurangi ukuran font deskripsi patient-info */
            }

            .patient-card {
                width: 500px;
                /* Membuat kartu pasien mengisi lebar penuh */
                padding: 15px;
                /* Mengurangi padding pada kartu pasien */
                font-size: 1.6rem;
                /* Mengurangi ukuran font dalam kartu pasien */
            }

            /* Icon dalam patient-card */
            .patient-card i {
                font-size: 1.6rem;
                /* Mengurangi ukuran icon */
            }

        }
    </style>
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
        <div class="gap"></div>
    </header> --}}
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
            <li><a href="#patien-info">
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
