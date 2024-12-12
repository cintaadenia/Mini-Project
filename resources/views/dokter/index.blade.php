@extends($layout)

@section($content)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Dokter</title>
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
        @if (session('success'))
            <script>
                Swal.fire('Success', '{{ session('success') }}', 'success');
            </script>
        @endif

        <div class="container">
            <form method="GET" action="{{ route('dokter.index') }}">
                <div class="header">
                    <!-- Search input with magnifying glass icon inside the button -->
                    <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" class="form-control">
                    <button type="submit" class="btn btn-link">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        
            <!-- Keluar button -->
            <button class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        
        
            <div class="title">Data Dokter</div>
            @if (auth()->user()->hasRole('admin'))
                <button type="button" class="add-button" data-bs-toggle="modal" data-bs-target="#addModal">
                    + Tambah Dokter
                </button>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>No HP</th>
                        <th>Image</th>
                        @if (auth()->user()->hasRole('admin'))
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokters as $dokter)
                    <tr>
                        <td>{{ $dokter->nama }}</td>
                        <td>{{ $dokter->spesialis }}</td>
                        <td>{{ $dokter->no_hp }}</td>
                        <td>
                            @if ($dokter->image)
                                <img src="{{ asset('storage/dokters/' . $dokter->image) }}" height="100px" width="80px" alt="gambar">
                            @else
                                <p>Kosong</p>
                            @endif
                        </td>
                        
                        @if (auth()->user()->hasRole('admin'))
                            <td class="action-icons">
                                <button type="button" style="border: none; outline: none; background: transparent;" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $dokter->id }}">
                                <i class="fas fa-edit edit"></i>
                                </button>
                                <form id="delete-form-{{ $dokter->id }}" action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="submit" style="background: transparent; outline: none; border: none" onclick="confirmDelete({{ $dokter->id }})">
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
                        @endif
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $dokter->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $dokter->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Edit Dokter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $dokter->nama }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="spesialis" class="col-sm-2 col-form-label">Spesialis</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="spesialis" name="spesialis" value="{{ $dokter->spesialis }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $dokter->no_hp }}">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" id="image" name="image">
                                                @if ($dokter->image)
                                                    <img src="{{ asset('storage/dokters/' . $dokter->image) }}" class="mt-2" width="100">
                                                @endif
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
            <!-- Modal for Add Dokter -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Dokter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ old('nama') }}">
                                    </div>
                                    @error('nama')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputSpesialis" class="col-sm-2 col-form-label">Spesialis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="spesialis" name="spesialis"
                                            value="{{ old('spesialis') }}">
                                    </div>
                                    @error('spesialis')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputNo_hp" class="col-sm-2 col-form-label">No_hp</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="no_hp" name="no_hp"
                                            value="{{ old('no_hp') }}">
                                    </div>
                                    @error('no_hp')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Add this inside the form for creating a doctor -->
                                <div class="mb-3 row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    @error('password')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>



                                <div class="mb-3 row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>
@endsection