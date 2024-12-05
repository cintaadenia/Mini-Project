@extends($layout)

@section($content)
<!DOCTYPE html>
<html lang="en">

<head>
    <meta c
    set="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Kunjungan Pasien</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Kunjungan Pasien</h1>
        @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
            + Tambah Kunjungan
        </button>

        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('kunjungan.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari kunjungan..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        @if(request('search'))
                        <a href="{{ route('kunjungan.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal for Add Kunjungan -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Kunjungan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('kunjungan.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="pasien" class="col-sm-2 col-form-label">Pasien</label>
                                <div class="col-sm-10">
                                    <select name="pasien_id" id="pasien_id" class="form-control">
                                        <option>--- Pasien ---</option>
                                        @foreach ($pasiens as $pas)
                                        <option value="{{$pas->id}}">{{$pas->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('pasien_id')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="dokter" class="col-sm-2 col-form-label">Dokter</label>
                                <div class="col-sm-10">
                                    <select name="dokter_id" id="dokter_id" class="form-control">
                                        <option>--- Dokter ---</option>
                                        @foreach ($dokters as $dok)
                                        <option value="{{$dok->id}}">{{$dok->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('dokter_id')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keluhan" name="keluhan" value="{{ old('keluhan') }}">
                                </div>
                                @error('tanggal_kunjungan')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="tanggal_kunjungan" class="col-sm-2 col-form-label">Tanggal Kunjungan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}">
                                </div>
                                @error('tanggal_kunjungan')
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

        <!-- Kunjungan Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $kunjungan->pasien->nama }}</td>
                    <td>{{ $kunjungan->dokter->nama }}</td>
                    <td>{{ $kunjungan->tanggal_kunjungan }}</td>
                    <td>
                        <form id="delete-form-{{ $kunjungan->id }}" action="{{ route('kunjungan.destroy', $kunjungan->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $kunjungan->id }})">Hapus</button>
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
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $kunjungan->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $kunjungan->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $kunjungan->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $kunjungan->id }}">Edit Kunjungan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('kunjungan.update', $kunjungan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label for="pasien" class="col-sm-2 col-form-label">Pasien</label>
                                        <div class="col-sm-10">
                                            <select name="pasien_id" id="pasien_id" class="form-control">
                                                <option value="{{$kunjungan->pasien_id}}" selected>{{$kunjungan->pasien->nama}}</option>
                                                @foreach ($pasiens as $pas)
                                                    @if ($pas->id !== $kunjungan->pasien_id)
                                                    <option value="{{$pas->id}}" {{ $kunjungan->pasien_id == $pas->id ? 'selected' : '' }}>{{$pas->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="dokter" class="col-sm-2 col-form-label">Dokter</label>
                                        <div class="col-sm-10">
                                            <select name="dokter_id" id="dokter_id" class="form-control">
                                                <option value="{{$kunjungan->dokter_id}}" selected>{{$kunjungan->dokter->nama}}</option>
                                                @foreach ($dokters as $dok)
                                                    @if ($dok->id !== $kunjungan->dokter_id)
                                                    <option value="{{$dok->id}}" {{ $kunjungan->dokter_id == $dok->id ? 'selected' : '' }}>{{$dok->nama}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="tanggal_kunjungan" class="col-sm-2 col-form-label">Tanggal Kunjungan</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" value="{{ $kunjungan->tanggal_kunjungan }}" required>
                                        </div>
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
        {{ $kunjungans->links() }}
    </div>


</body>

</html>
@endsection
