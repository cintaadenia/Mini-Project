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
            @if (session('success'))
                <script>
                    Swal.fire('Success', '{{ session('success') }}', 'success');
                </script>
            @endif

        <div class="container">
            <div class="header" style="margin-left: 20px">
                <input type="text" placeholder="Search"><i class="fa-solid fa-magnifying-glass" style="margin-left: -100px"></i>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button><i class="fas fa-sign-out-alt"></i> Keluar</button>
                </form>
            </div>
            <div class="judul">
                <div class="title">Data Obat</div>
                <button type="button" class="add-button" data-bs-toggle="modal" data-bs-target="#addModal">
                + Tambah Obat
                </button>
            </div>
            {{-- <button class="add-button">Tambah Obat</button> --}}
            <table>
                <thead>
                    <tr>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obt)
                    <tr>
                        <td>{{ $obt->obat }}</td>
                        <td>{{ $obt->jumlah }}</td>
                        <td>Rp.{{ $obt->harga }}</td>
                        <td class="action-icons">
                            <button type="button" style="border: none; outline: none; background: transparent;" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $obt->id }}">
                            <i class="fas fa-edit edit"></i>
                            </button>
                            <form id="delete-form-{{ $obt->id }}" action="{{ route('obat.destroy', $obt->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" style="background: transparent; outline: none; border: none" onclick="confirmDelete({{ $obt->id }})">
                                    <i class="fas fa-trash delete"></i>
                                </button>
                            </form>
                            
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
                    <div class="modal fade" id="editModal{{ $obt->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $obt->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Edit Resep</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('obat.update', $obt->id) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label for="obat" class="col-sm-2 col-form-label">Obat</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="obat"
                                                    name="obat" value="{{ $obt->obat }}">
                                            </div>
                                            @error('obat')
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
                                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="harga"
                                                    name="harga" value="{{ $obt->harga }}">
                                            </div>
                                            @error('harga')
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
                                    <label for="obat" class="col-sm-2 col-form-label">Obat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="obat" name="obat"
                                            value="{{ old('obat') }}">
                                    </div>
                                    @error('obat')
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
                                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="harga" name="harga"
                                            value="{{ old('harga') }}">
                                    </div>
                                    @error('harga')
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
        </div>

    </body>

    </html>
@endsection
