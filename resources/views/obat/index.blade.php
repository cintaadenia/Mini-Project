@extends($layout)

@section($content)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Obat</title>
    </head>

    <body>
        <div class="container mt-5">
            <h1>Daftar Obat</h1>
            @if (session('success'))
                <script>
                    Swal.fire('Success', '{{ session('success') }}', 'success');
                </script>
            @endif

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                + Tambah Obat
            </button>
            <div class="row mb-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form action="{{ route('obat.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari Obat..."
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                @if (request('search'))
                                    <a href="{{ route('obat.index') }}" class="btn btn-outline-danger">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- {{ $rekam->appends(['search' => request('search')])->links() }}         --}}
            <!-- Add Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Obat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('obat.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 row">
                                    <label for="resep" class="col-sm-2 col-form-label">Resep</label>
                                    <div class="col-sm-10">
                                        <select name="resep_id" id="resep_id" class="form-control">
                                            <option>--- Resep ---</option>
                                            @foreach ($resep as $res)
                                                <option value="{{ $res->id }}">{{ $res->kunjungan->pasien->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('resep_id')
                                        <script>
                                            Swal.fire('Error', '{{ $message }}', 'error');
                                        </script>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_obat" name="nama_obat"
                                            value="{{ old('nama_obat') }}">
                                    </div>
                                    @error('nama_obat')
                                        <script>
                                            Swal.fire('Error', '{{ $message }}', 'error');
                                        </script>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="Jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jumlah" name="jumlah"
                                            value="{{ old('jumlah') }}">
                                    </div>
                                    @error('jumlah')
                                        <script>
                                            Swal.fire('Error', '{{ $message }}', 'error');
                                        </script>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="dosis" class="col-sm-2 col-form-label">Dosis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="dosis" name="dosis"
                                            value="{{ old('dosis') }}">
                                    </div>
                                    @error('dosis')
                                        <script>
                                            Swal.fire('Error', '{{ $message }}', 'error');
                                        </script>
                                    @enderror
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
                        <th>Resep</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Dosis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obt)
                        <tr>
                            <td>{{ $obt->resep_id }}</td>
                            <td>{{ $obt->nama_obat }}</td>
                            <td>{{ $obt->jumlah }}</td>
                            <td>{{ $obt->dosis }}</td>
                            <td>
                                <form id="delete-form-{{ $obt->id }}" action="{{ route('obat.destroy', $obt->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $obt->id }})">Hapus</button>
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
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $obt->id }}">
                                    Edit
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $obt->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $obt->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Tambah Resep</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('obat.update', $obt->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label for="resep" class="col-sm-2 col-form-label">Resep</label>
                                                <div class="col-sm-10">
                                                    <select name="resep_id" id="resep_id" class="form-control">
                                                        <option value="{{ $obt->resep_id }}">
                                                            {{ $obt->resep->kunjungan->pasien->nama }}</option>
                                                        @foreach ($resep as $res)
                                                            @if ($res->id !== $obt->resep_id)
                                                            <option value="{{ $res->id }}">
                                                                {{ $res->kunjungan->pasien->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('resep_id')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="obat" class="col-sm-2 col-form-label">Nama Obat</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nama_obat"
                                                        name="nama_obat" value="{{ $obt->nama_obat }}">
                                                </div>
                                                @error('nama_obat')
                                                    <script>
                                                        Swal.fire('Error', '{{ $message }}', 'error');
                                                    </script>
                                                @enderror
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="Jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="jumlah"
                                                        name="jumlah" value="{{ $obt->jumlah }}">
                                                </div>
                                                @error('jumlah')
                                                    <script>
                                                        Swal.fire('Error', '{{ $message }}', 'error');
                                                    </script>
                                                @enderror
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="dosis" class="col-sm-2 col-form-label">Dosis</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="dosis"
                                                        name="dosis" value="{{ $obt->dosis }}">
                                                </div>
                                                @error('dosis')
                                                    <script>
                                                        Swal.fire('Error', '{{ $message }}', 'error');
                                                    </script>
                                                @enderror
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
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $pasiens->links() }} --}}
        </div>

    </body>

    </html>
@endsection
