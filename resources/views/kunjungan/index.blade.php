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
                margin-left: -30px
            }
            .header button {
                background-color: #ff0000;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 20px;
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
                background-color: #0275d8;
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

            .judul {
                display: flex;
            }

            .judul button{
                margin-left: 50px;
            }
    </style>
</head>

<body>
    {{-- @if (auth()->user()->unreadNotifications->count())
    <div class="alert alert-info">
        Anda memiliki {{ auth()->user()->unreadNotifications->count() }} notifikasi baru!
        <a href="{{ route('notifikasi.index') }}">Lihat Notifikasi</a>
    </div>
    @endif --}}

    @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif
    <div class="container">
        <div class="header">
            <input type="text" placeholder="Search"><i class="fa-solid fa-magnifying-glass" style="margin-left: -100px"></i>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <button><i class="fas fa-sign-out-alt"></i> Keluar</button>
            </form>
        </div>
        <div class="judul">
            <div class="title">Data Kunjungan</div>
            <button type="button" class="add-button" data-bs-toggle="modal" data-bs-target="#addModal">
            + Data Kunjungan
            </button>
        </div>
        {{-- <button class="add-button">Tambah Obat</button> --}}
        <table>
            <thead>
                <tr>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>keluhan</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $kunjungan->pasien->nama }}</td>
                    <td>{{ $kunjungan->dokter->nama ?? 'Edit untuk menambahkan dokter' }}</td>
                    <td>{{ $kunjungan->keluhan }}</td>
                    <td>{{ $kunjungan->tanggal_kunjungan }}</td>
                    <td class="action-icons">
                        <button type="button" style="border: none; outline: none; background: transparent;" data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $kunjungan->id }}">
                        <i class="fas fa-edit edit"></i>
                        </button>
                        <form id="delete-form-{{ $kunjungan->id }}" action="{{ route('kunjungan.destroy', $kunjungan->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="submit" style="background: transparent; outline: none; border: none" onclick="confirmDelete({{ $kunjungan->id }})">
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
            @endforeach
            </tbody>
        </table>

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
                            @if (auth()->user()->hasRole('admin'))
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
                            @endif
                            <div class="mb-3 row">
                                <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keluhan" name="keluhan" value="{{ old('keluhan') }}">
                                </div>
                                @error('keluhan')
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

        @foreach ($kunjungans as $kunjungan)
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
                            @if (auth()->user()->hasRole('admin'))
                            <div class="mb-3 row">
                                <label for="dokter" class="col-sm-2 col-form-label">Dokter</label>
                                <div class="col-sm-10">
                                    <select name="dokter_id" id="dokter_id" class="form-control">
                                        <option value="{{$kunjungan->dokter_id ?? ''}}" selected>{{$kunjungan->dokter->nama ?? ''}}</option>
                                        @foreach ($dokters as $dok)
                                            @if ($dok->id !== $kunjungan->dokter_id)
                                            <option value="{{$dok->id}}" {{ $kunjungan->dokter_id == $dok->id ? 'selected' : '' }}>{{$dok->nama}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="mb-3 row">
                                <label for="keluhan" class="col-sm-2 col-form-label">Keluhan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="keluhan" name="keluhan" value="{{ $kunjungan->keluhan }}">
                                </div>
                                @error('keluhan')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
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
</body>

</html>
@endsection
