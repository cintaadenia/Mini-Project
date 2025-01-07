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

            table,
            th,
            td {
                border: 1px solid #ccc;
            }

            th,
            td {
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
            <h1>Peralatan Medis</h1>
            @if (session('success'))
                <script>
                    Swal.fire('Success', '{{ session('success') }}', 'success');
                </script>
            @endif

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                + Tambah peralatan
            </button>

            <!-- Search Form -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{ route('peralatan.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari peralatan..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            @if (request('search'))
                                <a href="{{ route('peralatan.index') }}" class="btn btn-outline-danger">Clear</a>
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
                            <h5 class="modal-title" id="addModalLabel">Tambah peralatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('peralatan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama peralatan</label>
                                    <input type="text" class="form-control" id="nama_peralatan" name="nama_peralatan" required>
                                    @error('nama_peralatan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <label for="gambar" class="h4 f-bolder">Image</label>
                                    <div class="my-1">
                                        <input type="file" class="h4 f-bolder px-2 w-100 h-3" id="gambar" name="gambar">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" required>
                                    @error('harga')
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
                        <th>Nama peralatan</th>
                        <th>gambar</th>
                        <th>harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peralatan as $per)
                        <tr>
                            <td>{{ $per->nama_peralatan }}</td>
                            <td>
                                @if ($per->gambar)
                                    <img class="table-img" src="{{ asset('storage/peralatan/' . $per->gambar) }}" height="100px" width="80px" alt="gambar">
                                @else
                                    <img class="table-img" src="{{ asset('asset/img/peralatan.png') }}" alt="gambar default">
                                @endif
                            </td>
                            
                            <td>{{ $per->harga }}</td>
                            <td class="action-icons">
                                
                                <button type="button" style="border: none; outline: none; background: transparent;"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $per->id }}">
                                    <i class="fas fa-edit edit"></i>
                                </button>
                                <form id="delete-form-{{ $per->id }}"
                                    action="{{ route('peralatan.destroy', $per->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="submit" style="background: transparent; outline: none; border: none"
                                    onclick="confirmDelete({{ $per->id }})">
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
<div class="modal fade" id="editModal{{ $per->id }}" tabindex="-1"
    aria-labelledby="editModalLabel{{ $per->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $per->id }}">Perbarui peralatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('peralatan.update', $per->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_peralatan" class="form-label">Nama Peralatan</label>
                        <input type="text" class="form-control" id="nama_peralatan" name="nama_peralatan"
                            value="{{ $per->nama_peralatan }}" required>
                    </div>
                    <div class="my-2">
                        <label for="gambar" class="h4 f-bolder">Gambar</label>
                        <div class="my-1">
                            <input type="file" class="h4 f-bolder px-2 w-100 h-3" id="gambar" name="gambar">
                        </div>
                        @if ($per->gambar)
                            <div class="mt-2">
                                <p>Gambar Lama:</p>
                                <img src="{{ asset('storage/peralatan/' . $per->gambar) }}" class="mt-2" width="100">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="{{ $per->harga }}" required>
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



                        <!-- Detail Modal for Visit and Medical Record Input -->
                    @endforeach
                </tbody>
            </table>
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
