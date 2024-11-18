<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Kunjungan</title>
</head>

<body>
    <div class="container">
        <h1>Kunjungan Pasien</h1>
        @if(session('success'))
        <script>
            Swal.fire('Success', '{{ session('success') }}', 'success');
        </script>
        @endif
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        +Add kunjungan
    </button>

    <!-- Modal for Add Dokter -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="pasien" class="col-sm-2 col-form-label">Pasien</label>
                            <div class="col-sm-10">
                                <select name="pasien_id" id="pasien_id" class="form-control">
                                    <option>--- Pasien ---</option>
                                    @foreach ($pasien as $pas)
                                        <option value="{{$pas->id}}">{{$pas->nama}}</option>
                                    @endforeach
                                </select>
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
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $kunjungan->nama }}</td>
                    <td>{{ $kunjungan->spesialis }}</td>
                    <td>{{ $kunjungan->no_hp }}</td>
                    <td>
                        <form action="{{ route('dokter.destroy', $kunjungan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this doctor?');">
                                Delete
                            </button>
                        </form>
                        <button type="button" class="btn btn-warning btn-sm editDokterBtn" data-id="{{ $kunjungan->id }}"
                            data-bs-toggle="modal" data-bs-target="#editDokterModal">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Edit Dokter Modal -->
    {{-- <div class="modal fade" id="editDokterModal" tabindex="-1" aria-labelledby="editDokterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDokterModalLabel">Edit Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('dokter.update',$kunjungan->id)}}" id="editDokterForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSpesialis" class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="editSpesialis" name="spesialis" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNo_hp" class="form-label">No HP</label>
                            <input type="number" class="form-control" id="editNo_hp" name="no_hp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- <script>
        // Event listener for edit button
        document.querySelectorAll('.editDokterBtn').forEach(button => {
            button.addEventListener('click', function() {
                var dokterId = this.getAttribute('data-id');
                fetch(`/dokter/${dokterId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        // Fill the modal form with the dokter data
                        document.getElementById('editNama').value = data.nama;
                        document.getElementById('editSpesialis').value = data.spesialis;
                        document.getElementById('editNo_hp').value = data.no_hp;
                        document.getElementById('editDokterForm').action = `/dokter/${dokterId}`;
                    })
                    .catch(error => console.error('Error fetching dokter data:', error));
            });
        });
    </script> --}}
</body>

</html>
