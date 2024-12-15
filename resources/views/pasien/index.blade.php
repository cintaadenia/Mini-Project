@extends($layout)

@section($content)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Pasien</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }
            .container {
                width: 90%;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .header input[type="text"] {
                width: 90%;
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 15px;
                margin-left: -30px;
            }
            .header button {
                background-color: #d9534f;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 3px;
                cursor: pointer;
            }
            .header button i {
                margin-right: 5px;
            }
            .title {
                font-size: 24px;
                margin-bottom: 20px;
            }
            .add-button {
                background-color: #5bc0de;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 3px;
                cursor: pointer;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid #ccc;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #0275d8;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .action-icons i {
                margin: 0 5px;
                cursor: pointer;
            }
            .action-icons .edit {
                color: #0275d8;
            }
            .action-icons .delete {
                color: #d9534f;
            }
        </style>
    </head>

    <body>
        
        <div class="container mt-5">
            <h1>Daftar Pasien</h1>
            @if (session('success'))
                <script>
                    Swal.fire('Success', '{{ session('success') }}', 'success');
                </script>
            @endif

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                + Tambah Pasien
            </button>

            <!-- Search Form -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('pasien.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari pasien..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            @if (request('search'))
                                <a href="{{ route('pasien.index') }}" class="btn btn-outline-danger">Clear</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('pasien.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                    @error('no_hp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        required>
                                    @error('tanggal_lahir')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss ="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $pasien)
                    <tr>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->tanggal_lahir }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td class="action-icons">
                            <a data-bs-toggle="modal" data-bs-target="#detailModal{{ $pasien->id }}">
                                <i class="fas fa-info-circle detail"></i>
                            </a>
                            <button type="button" style="border: none; outline: none; background: transparent;" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $pasien->id }}">
                                <i class="fas fa-edit edit"></i>
                            </button>
                            <form id="delete-form-{{ $pasien->id }}" action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="submit" style="background: transparent; outline: none; border: none" onclick="confirmDelete({{ $pasien->id }})">
                                <i class="fas fa-trash delete"></i>
                            </button>
                            <script>
                                function confirmDelete(id) {
                                    Swal.fire({
                                        title: 'Apakah Anda yakin?',
                                        text: "Data ini akan dihapus secara permanen!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, hapus!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Submit form hapus
                                            document.getElementById('delete-form-' + id).submit();
                                        }
                                    });
                                }
                            </script>
                        </td>
                    </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $pasien->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $pasien->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $pasien->id }}">Perbarui Pasien
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ $pasien->nama }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat"
                                                    value="{{ $pasien->alamat }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label">No HP</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                    value="{{ $pasien->no_hp }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggal_lahir"
                                                    name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" required>
                                            </div>
                                            <hr>
                                            <h5>Input Kunjungan</h5>
                                            <div class="mb-3">
                                                <label for="dokter_id" class="form-label">Dokter</label>
                                                <select class="form-select" id="dokter_id" name="dokter_id" required>
                                                    <option value="">Pilih Dokter</option>
                                                    @foreach ($dokters as $dokter)
                                                        <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="keluhan" class="form-label">Keluhan</label>
                                                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_kunjungan" class="form-label">Tanggal
                                                    Kunjungan</label>
                                                <input type="date" class="form-control" id="tanggal_kunjungan"
                                                    name="tanggal_kunjungan" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- Detail Modal for Visit and Medical Record Input -->
                        <div class="modal fade" id="detailModal{{ $pasien->id }}" tabindex="-1"
                            aria-labelledby="detailModalLabel{{ $pasien->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $pasien->id }}">Detail Pasien:
                                            {{ $pasien->nama }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama:</strong> {{ $pasien->nama }}</p>
                                        <p><strong>Alamat:</strong> {{ $pasien->alamat ?: 'kosong' }}</p>
                                        <p><strong>No HP:</strong> {{ $pasien->no_hp ?: 'kosong' }}</p>
                                        <p><strong>Tanggal Lahir:</strong> {{ $pasien->tanggal_lahir ?: 'kosong' }}</p>
                                        <hr>
                                        <h5>Rekam Medis & Kunjungan</h5>
                                        @foreach ($pasien->kunjungan as $kunjungan)
                                            <p><strong>Tanggal Kunjungan:</strong>
                                                {{ $kunjungan->tanggal_kunjungan ?? 'kosong' }}</p>
                                            <p><strong>Diagnosa:</strong> {{ $kunjungan->diagnosa ?? 'kosong' }}</p>
                                            <p><strong>Tindakan:</strong> {{ $kunjungan->tindakan ?? 'kosong' }}</p>
                                        @endforeach

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </tbody>
            </table>
            {{ $pasiens->links() }}
        </div>

        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
        @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $errors->first() }}',
                confirmButtonText: 'Tutup'
            });
        </script>
    @endif
    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection