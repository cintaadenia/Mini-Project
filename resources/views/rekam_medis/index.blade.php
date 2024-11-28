@extends($layout)

@section($content)
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Rekam Medis</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Rekam Medis</h1>
        @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif

        <!-- Button trigger modal -->
        @if (auth()->user()->hasRole('admin'))
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Rekam Medis
        </button>
        @endif

        <!-- Search Form -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('rekam_medis.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Rekam Medis..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        @if(request('search'))
                        <a href="{{ route('rekam_medis.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>


        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    @if (auth()->user()->hasRole('admin'))
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Rekam Medis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('rekam_medis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="kunjungan" class="col-sm-2 col-form-label">pasien</label>
                                <div class="col-sm-10">
                                    <select name="kunjungan_id" id="kunjungan_id" class="form-control">
                                        <option>--- Pilih Pasien ---</option>
                                        @foreach ($kunjungans as $kn)
                                        <option value="{{$kn->id}}">{{$kn->pasien->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kunjungan_id')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ old('diagnosa') }}">
                                </div>
                                @error('diagnosa')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tindakan" name="tindakan" value="{{ old('tindakan') }}">
                                </div>
                                @error('tindakan')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image Input for Create Modal -->
                            <div class="mb-3 row">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                @error('image')
                                    <p style="color: red">{{ $message }}</p>
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
                    <th>pasien</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Gambar</th>
                    @if (auth()->user()->hasRole('admin'))
                    <th>Aksi</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($rekamMedis as $rm)
                <tr>
                    <td>{{ $rm->kunjungan->pasien->nama }}</td>
                    <td>{{ $rm->diagnosa }}</td>
                    <td>{{ $rm->tindakan }}</td>
                    <td><img src="{{ asset('/storage/rekam_medis/'.$rm->image) }}" height="100px" width="80px" alt="gambar"></td>
                    @if (auth()->user()->hasRole('admin'))
                    <td>
                        <form id="delete-form-{{ $rm->id }}" action="{{ route('rekam_medis.destroy', $rm->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $rm->id }})">Hapus</button>

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
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $rm->id }}">
                            Edit
                        </button>
                    </td>    
                    @endif             
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $rm->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $rm->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $rm->id }}">Edit Rekam Medis</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('rekam_medis.update', $rm->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label for="kunjungan" class="col-sm-2 col-form-label">pasien</label>
                                        <div class="col-sm-10">
                                            <select name="kunjungan_id" id="kunjungan_id" class="form-control">
                                                <option value="{{ $rm->kunjungan_id }}" selected>{{ $rm->kunjungan->pasien->nama }}</option>
                                                @foreach ($kunjungans as $kn)
                                                @if ($kn->id !== $rm->kunjungan_id)
                                                <option value="{{ $kn->id }}">{{ $kn->pasien->nama }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('kunjungan_id')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="{{ $rm->diagnosa }}">
                                        </div>
                                        @error('diagnosa')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="tindakan" name="tindakan" value="{{ $rm->tindakan }}">
                                        </div>
                                        @error('tindakan')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Image Input for Edit Modal -->
                                    <div class="mb-3 row">
                                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                        @error('image')
                                            <p style="color: red">{{ $message }}</p>
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

        <!-- Pagination -->
        {{ $rekamMedis->links() }}
    </div>

    <!-- Bootstrap JS -->
</body>

</html>
@endsection
