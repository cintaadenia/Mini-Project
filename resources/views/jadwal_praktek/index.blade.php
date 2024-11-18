<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Jadwal Praktek</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Jadwal Praktek</h1>
        @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addJadwalModal">
            + Tambah Jadwal
        </button>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwalPrakteks as $jadwal)
                <tr>
                    <td>{{ $jadwal->dokter->nama }}</td>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->jam_mulai }}</td>
                    <td>{{ $jadwal->jam_selesai }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editJadwalBtn" data-id="{{ $jadwal->id }}"
                            data-bs-toggle="modal" data-bs-target="#editJadwalModal">Edit</button>
                        <form action="{{ route('jadwal_praktek.destroy', $jadwal->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $jadwalPrakteks->links() }}
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addJadwalModal" tabindex="-1" aria-labelledby="addJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('jadwal_praktek.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addJadwalModalLabel">Tambah Jadwal Praktek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Dokter</label>
                            <select name="dokter_id" class="form-control">
                                @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Hari</label>
                            <input type="text" name="hari" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editJadwalForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal Praktek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Dokter</label>
                            <select id="editDokterId" name="dokter_id" class="form-control">
                                @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Hari</label>
                            <input type="text" id="editHari" name="hari" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Mulai</label>
                            <input type="time" id="editJamMulai" name="jam_mulai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jam Selesai</label>
                            <input type="time" id="editJamSelesai" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Edit button handler
        document.querySelectorAll('.editJadwalBtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch(`/jadwal_praktek/${id}/edit`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('editDokterId').value = data.dokter_id;
                        document.getElementById('editHari').value = data.hari;
                        document.getElementById('editJamMulai').value = data.jam_mulai;
                        document.getElementById('editJamSelesai').value = data.jam_selesai;
                        document.getElementById('editJadwalForm').action = `/jadwal_praktek/${id}`;
                    });
            });
        });
    </script>
</body>

</html>
