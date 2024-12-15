@extends($layout)
@section($content)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Rekam Medis</title>
        <style>
            /* Style for images in the table */
            table img {
                border: 2px solid #ddd;
                /* Adding border */
                border-radius: 8px;
                /* Optional: rounded corners */
                box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
                /* Adding shadow */
                margin: 5px;
                /* Adding space between images */
            }

            /* Style for images in the modal */
            .modal-body img {
                border: 2px solid #ddd;
                /* Adding border */
                border-radius: 8px;
                /* Optional: rounded corners */
                box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
                /* Adding shadow */
                margin: 5px;
                /* Adding space between images */
            }
        </style>
    </head>


    <body>
        <div class="container mt-5">
            <h1>Daftar Rekam Medis</h1>
            @if (session('success'))
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
                            <input type="text" name="search" class="form-control" placeholder="Cari Rekam Medis..."
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            @if (request('search'))
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('rekam_medis.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <!-- Patient Selection -->
                                <div class="mb-3 row">
                                    <label for="kunjungan" class="col-sm-2 col-form-label">Pasien</label>
                                    <div class="col-sm-10">
                                        <select name="kunjungan_id" id="kunjungan_id" class="form-control select2">
                                            <option value="">--- Pilih Pasien ---</option>
                                            @foreach ($kunjungans as $kn)
                                                <option value="{{ $kn->id }}">{{ $kn->pasien->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('kunjungan_id')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Diagnosa, Tindakan, and Resep inputs -->
                                <div class="mb-3 row">
                                    <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="diagnosa" name="diagnosa"
                                            value="{{ old('diagnosa') }}">
                                    </div>
                                    @error('diagnosa')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tindakan" name="tindakan"
                                            value="{{ old('tindakan') }}">
                                    </div>
                                    @error('tindakan')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <label for="deskripsi" class="col-sm-2 col-form-label">Resep</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                                    </div>
                                    @error('deskripsi')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Medication Input Section -->
                                <div class="mb-3 row">
                                    <label for="obat_id" class="col-sm-2 col-form-label">Obat</label>
                                    <div class="col-sm-10">
                                        <select name="obat_id[]" id="obat_id" class="form-control" multiple>
                                            <option value="">--- Pilih Obat ---</option>
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}" data-stok="{{ $obat->jumlah }}">
                                                    {{ $obat->obat }} (Stok: {{ $obat->jumlah }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('obat_id')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div id="medication-quantity-section"></div>

                                <!-- Image Input for Create Modal -->
                                <div id="image-container">
                                    <div class="mb-3 row">
                                        <label for="image" class="col-sm-2 col-form-label">Tambah Gambar</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="image" name="images[]">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" id="add-image-button-create">Tambah
                                    Gambar</button>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('obat_id').addEventListener('change', function() {
                    var selectedObats = Array.from(this.selectedOptions);
                    var quantitySection = document.getElementById('medication-quantity-section');
                    quantitySection.innerHTML = ''; // Clear previous inputs

                    selectedObats.forEach(function(obat) {
                        var stok = obat.getAttribute('data-stok');
                        var obatId = obat.value;

                        // Create input fields for each selected medication
                        var inputGroup = document.createElement('div');
                        inputGroup.classList.add('mb-3', 'row');

                        var label = document.createElement('label');
                        label.classList.add('col-sm-2', 'col-form-label');
                        label.textContent = 'Jumlah (' + obat.textContent + ')';
                        inputGroup.appendChild(label);

                        var inputContainer = document.createElement('div');
                        inputContainer.classList.add('col-sm-10');

                        var input = document.createElement('input');
                        input.type = 'number';
                        input.name = 'jumlah_obat[]';
                        input.classList.add('form-control');
                        input.placeholder = 'Jumlah';
                        input.min = 1;
                        input.max = stok;
                        input.required = true;

                        inputContainer.appendChild(input);
                        inputGroup.appendChild(inputContainer);
                        quantitySection.appendChild(inputGroup);
                    });
                });
            </script>

            <!-- Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>pasien</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Resep</th>
                        <th>Obat</th>
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
                            <td>
                                @foreach ($rm->resep as $resep)
                                    <!-- Loop through each resep -->
                                    <p>{{ $resep->deskripsi }}</p> <!-- Display the deskripsi -->
                                @endforeach
                            </td>
                            <td>
                                @if ($rm->obats && $rm->obats->count() > 0)
                                    @foreach ($rm->obats as $obat)
                                        <p>{{ $obat->obat }} - Jumlah: {{ $obat->pivot->jumlah }}</p>
                                    @endforeach
                                @else
                                    <p>Tidak ada obat yang terkait</p>
                                @endif
                            </td>

                            <td>
                                @foreach ($rm->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" height="100"
                                        width="80" alt="Gambar">
                                @endforeach
                            </td>
                            @if (auth()->user()->hasRole('admin'))
                                <td>
                                    <form id="delete-form-{{ $rm->id }}"
                                        action="{{ route('rekam_medis.destroy', $rm->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm"
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
                                                    document.getElementById('delete-form-' + id).submit();
                                                }
                                            });
                                        }
                                    </script>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $rm->id }}">
                                        Edit
                                    </button>

                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $rm->id }}">
                                        Detail
                                    </button>
                                </td>
                                <!-- Detail Modal -->
                                <div class="modal fade" id="detailModal{{ $rm->id }}" tabindex="-1"
                                    aria-labelledby="detailModalLabel{{ $rm->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $rm->id }}">Detail
                                                    Rekam Medis</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Pasien:</strong> {{ $rm->kunjungan->pasien->nama }}</p>
                                                <p><strong>Diagnosa:</strong> {{ $rm->diagnosa }}</p>
                                                <p><strong>Tindakan:</strong> {{ $rm->tindakan }}</p>
                                                <p><strong>Obat:</strong> {{ $obat->obat }} - Jumlah:
                                                    {{-- {{ $obat->pivot->jumlah }}</p> --}}
                                                <p><strong>Resep</strong> {{ $resep->deskripsi }}</p>
                                                <p><strong>Gambar:</strong></p>
                                                @foreach ($rm->images as $image)
                                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                                        height="150" width="120" class="mb-2" alt="Gambar">
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $rm->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $rm->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $rm->id }}">Edit Rekam Medis
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('rekam_medis.update', $rm->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Pasien Selection -->
                                            <div class="mb-3 row">
                                                <label for="kunjungan" class="col-sm-2 col-form-label">Pasien</label>
                                                <div class="col-sm-10">
                                                    <select name="kunjungan_id" id="kunjungan_id" class="form-control">
                                                        <option value="{{ $rm->kunjungan_id }}" selected>
                                                            {{ $rm->kunjungan->pasien->nama }}</option>
                                                        @foreach ($kunjungans as $kn)
                                                            @if ($kn->id !== $rm->kunjungan_id)
                                                                <option value="{{ $kn->id }}">
                                                                    {{ $kn->pasien->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @error('kunjungan_id')
                                                <p style="color: red">{{ $message }}</p>
                                            @enderror

                                            <!-- Diagnosa -->
                                            <div class="mb-3 row">
                                                <label for="diagnosa" class="col-sm-2 col-form-label">Diagnosa</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="diagnosa"
                                                        name="diagnosa" value="{{ $rm->diagnosa }}">
                                                </div>
                                                @error('diagnosa')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Tindakan -->
                                            <div class="mb-3 row">
                                                <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="tindakan"
                                                        name="tindakan" value="{{ $rm->tindakan }}">
                                                </div>
                                                @error('tindakan')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Resep -->
                                            <div class="mb-3 row">
                                                <label for="deskripsi" class="col-sm-2 col-form-label">Resep</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $rm->resep->first()->deskripsi ?? '' }}</textarea>
                                                </div>
                                                @error('deskripsi')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Medication Input Section -->
                                            <div class="mb-3 row">
                                                <label for="obat_id" class="col-sm-2 col-form-label">Obat</label>
                                                <div class="col-sm-10">
                                                    <select name="obat_id[]" class="form-control" id="obat_id"
                                                        multiple>
                                                        @foreach ($obats as $obat)
                                                            <option value="{{ $obat->id }}"
                                                                {{ in_array($obat->id, $rm->obats->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                                {{ $obat->obat }} (Stok: {{ $obat->jumlah }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('obat_id')
                                                    <p style="color: red">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Quantity Section (Dynamic) -->
                                            <div id="obat-quantity-container">
                                                @foreach ($rm->obats as $obat)
                                                    <div class="mb-3 row" id="obat-quantity-{{ $obat->id }}">
                                                        <label for="jumlah_obat"
                                                            class="col-sm-2 col-form-label">{{ $obat->obat }} -
                                                            Jumlah</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" name="jumlah_obat[{{ $obat->id }}]"
                                                                class="form-control" value="{{ $obat->pivot->jumlah }}"
                                                                min="1">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Images Section with Checkboxes -->
                                            <div class="mb-3">
                                                <label class="form-label">Gambar</label>
                                                <div>
                                                    @foreach ($rm->images as $image)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="delete_images[]" value="{{ $image->id }}"
                                                                id="deleteImage{{ $image->id }}">
                                                            <label class=" form-check-label"
                                                                for="deleteImage{{ $image->id }}">
                                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                                    height="100" width="80" alt="Gambar">
                                                                Hapus gambar ini
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Option to Add New Images -->
                                            <div id="edit-image-container">
                                                <div class="mb-3 row">
                                                    <label for="image" class="col-sm-2 col-form-label">Tambah Gambar
                                                        Baru</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" class="form-control" name="new_images[]">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary"
                                                id="add-image-button-edit">Tambah Gambar</button>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize Select2 for the patient dropdown in the modal
                $('#kunjungan_id').select2({
                    placeholder: "--- Pilih Pasien ---",
                    allowClear: true, // Optional: Add an option to clear the selection
                });

                // Initialize Select2 for any other select fields that might require search functionality
                $('#search').select2({
                    placeholder: "Cari Rekam Medis..."
                });
            });
            $(document).ready(function() {
                // Initialize Select2 for the patient dropdown in the modal with search enabled
                $('#kunjungan_id').select2({
                    placeholder: "--- Pilih Pasien ---",
                    allowClear: true
                });
            });
        </script>



        <script>
            // Script untuk menghapus gambar dari modal edit
            document.querySelectorAll('.remove-image').forEach(button => {
                button.addEventListener('click', function() {
                    const imageId = this.dataset.imageId;
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'delete_images[]';
                    hiddenInput.value = imageId;
                    this.closest('form').appendChild(hiddenInput);
                    this.parentElement.remove(); // Hapus gambar dari tampilan
                });
            });

            // Tambah gambar di modal create
            document.getElementById('add-image-button-create').addEventListener('click', function() {
                const container = document.getElementById('image-container');
                const newImageRow = document.createElement('div');
                newImageRow.className = 'mb-3 row';

                newImageRow.innerHTML = `
        <label for="image" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="images[]">
        </div>
    `;

                container.appendChild(newImageRow);
            });

            // Tambah gambar baru di modal edit
            document.getElementById('add-image-button-edit').addEventListener('click', function() {
                const container = document.getElementById('edit-image-container');
                const newInput = document.createElement('div');
                newInput.className = 'mb-3';
                newInput.innerHTML = `
        <input type="file" class="form-control" name="new_images[]">
    `;
                container.appendChild(newInput);
            });
            document.querySelectorAll('.modal-footer button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });
        </script>





    </body>

    </html>
@endsection
