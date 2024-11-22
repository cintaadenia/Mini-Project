@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pasien</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Pasien</h1>
        @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Pasien
        </button>
        <div class="row mb-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('pasien.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari pasien..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            @if(request('search'))
                            <a href="{{ route('pasien.index') }}" class="btn btn-outline-danger">Clear</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{ $pasiens->appends(['search' => request('search')])->links() }}
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
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasiens as $pasien)
                <tr>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->tanggal_lahir }}</td>
                    <td>
                        <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $pasien->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $pasien->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pasien->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $pasien->id }}">Edit Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $pasien->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pasien->alamat }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pasien->no_hp }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        {{ $pasiens->links() }}
    </div>

</body>

</html>
@endsection
