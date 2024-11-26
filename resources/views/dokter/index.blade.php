@extends($layout)

@section($content)
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Dokter</title>
    </head>
    <body>
    <div class="container mt-5">
            <h1>Dokter</h1>
            @if(session('success'))
            <script>
                Swal.fire('Success', '{{ session('success') }}', 'success');
            </script>
            @endif
        

            @if (auth()->user()->hasRole('admin'))
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="addModal">
                + Tambah Dokter
            </button>
                    @endif
        <!-- Button trigger modal -->


        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('dokter.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari kunjungan..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        @if(request('search'))
                        <a href="{{ route('dokter.index') }}" class="btn btn-outline-danger">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>



        <!-- Modal for Add Dokter -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Dokter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dokter.store') }}" method="POST">
                            @csrf
                            <div class="mb-3 row">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                                </div>
                                @error('nama')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="inputSpesialis" class="col-sm-2 col-form-label">Spesialis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="spesialis" name="spesialis" value="{{ old('spesialis') }}">
                                </div>
                                @error('spesialis')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="inputNo_hp" class="col-sm-2 col-form-label">No_hp</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                </div>
                                @error('no_hp')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
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

        <!-- Dokter Table -->
        <div class="container">
            <table class="table table-stripped">
                <thead>
                    <th>Nama</th>
                    <th>Spesialis</th>
                    <th>Phone</th>
                    @if (auth()->user()->hasRole('admin'))
                    <th>Aksi</th>
                    @endif

                </thead>
                <tbody>
                    @foreach ($dokters as $dokter)
                    <tr>
                        <td>{{ $dokter->nama }}</td>
                        <td>{{ $dokter->spesialis }}</td>
                        <td>{{ $dokter->no_hp }}</td>
                        @if (auth()->user()->hasRole('admin'))
                        <td>
                            <form id="delete-form-{{$dokter->id}}" action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete({{ $dokter->id }})">Hapus</button>
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
                            <button type="button" class="btn btn-outline-warning btn-sm editDokterBtn" data-id="{{ $dokter->id }}"
                                data-bs-toggle="modal" data-bs-target="#editDokterModal">
                                Edit
                            </button>
                        </td>
                    @endif

                    </tr>
                    <div class="modal fade" id="editDokterModal" tabindex="-1" aria-labelledby="editDokterModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editDokterModalLabel">Edit Dokter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('dokter.update',$dokter->id)}}" id="editDokterForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="editNama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="editNama" name="nama" value="{{$dokter->nama}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editSpesialis" class="form-label">Spesialis</label>
                                            <input type="text" class="form-control" id="editSpesialis" name="spesialis" value="{{$dokter->spesialis}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editNo_hp" class="form-label">No HP</label>
                                            <input type="number" class="form-control" id="editNo_hp" name="no_hp" value="{{$dokter->no_hp}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        <!-- Edit Dokter Modal -->


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script>
            // Event listener for edit button
            document.querySelectorAll('.editDokterBtn').forEach(button => {
                button.addEventListener('click', function() {
                    var dokterId = this.getAttribute('data-id');
                    fetch(/dokter/${dokterId}/edit)
                        .then(response => response.json())
                        .then(data => {
                            // Fill the modal form with the dokter data
                            document.getElementById('editNama').value = data.nama;
                            document.getElementById('editSpesialis').value = data.spesialis;
                            document.getElementById('editNo_hp').value = data.no_hp;
                            document.getElementById('editDokterForm').action = /dokter/${dokterId};
                        })
                        .catch(error => console.error('Error fetching dokter data:', error));
                });
            });
        </script>
    </body>
    </html>
@endsection
