<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Resep</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Resep</h1>
        @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Resep
        </button>
        <div class="row mb-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('resep.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Resep..." value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            @if(request('search'))
                            <a href="{{ route('resep.index') }}" class="btn btn-outline-danger">Clear</a>
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
                        <h5 class="modal-title" id="addModalLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('resep.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="kunjungan" class="col-sm-2 col-form-label">Kunjungan</label>
                                <div class="col-sm-10">
                                    <select name="kunjungan_id" id="kunjungan_id" class="form-control">
                                        <option>--- Pasien ---</option>
                                        @foreach ($Rekmed as $rek)
                                        <option value="{{$rek->id}}">{{$rek->pasien->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kunjungan_id')
                                    <p style="color: red">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                                </div>
                                @error('deskripsi')
                                    <p style="color: red">{{$message}}</p>
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
                    <th>Kunjungan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reseps as $resep)
                <tr>
                    <td>{{ $resep->kunjungan->pasien->nama }}</td>
                    <td>{{ $resep->deskripsi }}</td>
                    <td>
                        <form action="{{ route('rekam_medis.destroy', $resep->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $resep->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $resep->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $resep->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('rekam_medis.update',$resep->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label for="kunjungan" class="col-sm-2 col-form-label">Kunjungan</label>
                                        <div class="col-sm-10">
                                            <select name="kunjungan_id" id="kunjungan_id" class="form-control">
                                                <option value="{{$resep->kunjungan_id}}">{{$resep->kunjungan->pasien->nama}}</option>
                                                {{-- @foreach ($knjgn as $kn)
                                                <option value="{{$kn->pasien_id}}">{{$kun->pasien->nama}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                        @error('kunjungan_id')
                                            <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ $resep->diagnosa }}">
                                        </div>
                                        @error('diagnosa')
                                            <p style="color: red">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tindakan" name="tindakan" value="{{ $resep->tindakan }}">
                                        </div>
                                        @error('tindakan')
                                            <p style="color: red">{{$message}}</p>
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
                @endforeach
            </tbody>
        </table>
        {{-- {{ $pasiens->links() }} --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
