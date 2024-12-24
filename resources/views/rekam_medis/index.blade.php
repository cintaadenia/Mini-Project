@extends('layouts.sidebar')
<style></style>
@section('side')
    <div class="container mt-5">
        @if (session('success'))
            <script>
                Swal.fire('Success', '{{ session('success') }}', 'success');
            </script>
        @endif

        <div class="d-flex j-between m-2 a-center">
            <div class="d-flex a-center">
                <h2 class="h2 f-bolder mr-4">Data Rekam Medis</h2>
                <div class="btn"></div>
                @if (auth()->user()->hasRole('admin'))
                    <button type="button" class="btn-add main-color-hover py-1 px-2" id="btnOpenAddModal">
                        Tambah Rekam Medis
                    </button>
                @endif
            </div>
        </div>

        {{-- <div class="row mb-3">
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
            </div> --}}

        <!-- Add Modal -->
        <div class="modal animate__animated" id="myModalAdd">
            <div class="modal-content animate__animated animate__zoomIn">
                @if (auth()->user()->hasRole('admin'))
                    <div class="modal-header">
                        <h5 class="h2 f-bolder">Tambah Rekam Medis</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                @endif
                <form action="{{ route('rekam_medis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2">
                        <label for="kunjungan" class="h4 f-bolder">Pasien</label>
                        <div class="my-1">
                            <select name="kunjungan_id" id="kunjungan_id"
                                class="form h4 f-normal px-2 w-100 h-3 border-radius-1 select2">
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
                    <div class="my-2">
                        <label for="diagnosa" class="h4 f-bolder">Diagnosa</label>
                        <div class="my-1">
                            <input type="text" class="form h4 f-normal px-2 w-100 h-3 border-radius-1" id="diagnosa"
                                name="diagnosa" value="{{ old('diagnosa') }}">
                        </div>
                        @error('diagnosa')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="tindakan" class="h4 f-bolder">Tindakan</label>
                        <div class="my-1">
                            <input type="text" class="form h4 f-normal px-2 w-100 h-3 border-radius-1" id="tindakan"
                                name="tindakan" value="{{ old('tindakan') }}">
                        </div>
                        @error('tindakan')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="deskripsi" class="h4 f-bolder">Resep</label>
                        <div class="my-1">
                            <textarea class="form h4 f-normal px-2 w-100 h-3 border-radius-1" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        </div>
                        @error('deskripsi')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-2">
                        <label for="obat_id" class="h4 f-bolder">Obat</label>
                        <div class="my-1">
                            <select name="obat_id[]" id="obat_id" class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                multiple>
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

                    <div id="image-container">
                        <div class="my-2">
                            <label for="image" class="h4 f-bolder">Tambah Gambar</label>
                            <div class="my-1">
                                <input type="file" class="h4 f-bolder px-2 w-100 h-3" id="image" name="images[]"
                                    multiple>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="px-2 py-1 btn-close red-hover" id="btnCloseAddModal">Close</button>
                    <button type="submit" class="px-2 py-1 btn-add main-color-hover">Simpan</button>
                </form>
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
        <div class="content-table m-2 d-flex col">
            <form method="GET" action="{{ route('rekam_medis.index') }}">
                <input type="text" class="search-container w-100 h4" name="search" placeholder="Search"
                    value="{{ request('search') }}" class="form-control">
            </form>
            <div class="outer-table">
                <div class="content-table-table">
                    <table>
                        <thead class="h4 f-bolder">
                            <tr>
                                <th>Pasien</th>
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
                                            <p>{{ $resep->deskripsi }}</p>
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
                                        <td class="action-icons">
                                            <!-- View Details Modal -->
                                            <a data-bs-toggle="modal" data-bs-target="#detailModal{{ $rm->id }}">
                                                <i class="fas fa-info-circle detail h3 mr-1 pointer"></i>
                                            </a>
                                            <!-- Edit Modal -->
                                            <button type="button"
                                                style="border: none; outline: none; background: transparent;"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $rm->id }}">
                                                <i class="fas fa-edit edit h3 mr-1 main-color pointer"></i>
                                            </button>
                                            <!-- Delete Form -->
                                            <form id="delete-form-{{ $rm->id }}"
                                                action="{{ route('rekam_medis.destroy', $rm->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="submit"
                                                style="background: transparent; outline: none; border: none"
                                                onclick="confirmDelete({{ $rm->id }})">
                                                <i class="fas fa-trash delete h3 mr-1 red pointer"></i>
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
                                                            document.getElementById('delete-form-' + id).submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Modal for Rekam Medis -->
        @foreach ($rekamMedis as $rm)
            <div class="modal fade" id="editModal{{ $rm->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $rm->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="h2 f-bolder" id="editModalLabel{{ $rm->id }}">Edit Rekam Medis</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('rekam_medis.update', $rm->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <!-- Diagnosa -->
                                <div class="my-2">
                                    <label for="diagnosa" class="h4 f-bolder">Diagnosa</label>
                                    <div class="my-1">
                                        <input type="text" class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                            id="diagnosa" name="diagnosa" value="{{ $rm->diagnosa }}">
                                    </div>
                                </div>
                                <!-- Tindakan -->
                                <div class="my-2">
                                    <label for="tindakan" class="h4 f-bolder">Tindakan</label>
                                    <div class="my-1">
                                        <input type="text" class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                            id="tindakan" name="tindakan" value="{{ $rm->tindakan }}">
                                    </div>
                                </div>
                                <!-- Resep -->
                                <div class="my-2">
                                    <label for="deskripsi" class="h4 f-bolder">Resep</label>
                                    <div class="my-1">
                                        <textarea class="form h4 f-normal px-2 w-100 h-3 border-radius-1" id="deskripsi" name="deskripsi">{{ $rm->resep->first()->deskripsi ?? '' }}</textarea>
                                    </div>
                                </div>
                                <!-- Obat -->
                                <div class="my-2">
                                    <label for="obat_id" class="h4 f-bolder">Obat</label>
                                    <div class="my-1">
                                        <select name="obat_id[]" class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                            id="obat_id" multiple>
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}"
                                                    {{ in_array($obat->id, $rm->obats->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $obat->obat }} (Stok: {{ $obat->jumlah }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Images -->
                                <div class="my-2">
                                    <label class="h4 f-bolder">Gambar</label>
                                    <div>
                                        @foreach ($rm->images as $image)
                                            <div class="my-1">
                                                <input class="form-check-input" type="checkbox" name="delete_images[]"
                                                    value="{{ $image->id }}" id="deleteImage{{ $image->id }}">
                                                <label class="form-check-label" for="deleteImage{{ $image->id }}">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                                        height="100" width="80" alt="Gambar">
                                                    Hapus gambar ini
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <label class="h4 f-bolder">Tambah Gambar Baru</label>
                                    <div class="my-1">
                                        <input type="file" name="new_images[]" multiple
                                            class="h4 f-normal px-2 w-100 h-3 border-radius-1">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="px-2 py-1 btn-add main-color-hover"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="px-2 py-1 btn-close red-hover">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Detail Modal for Rekam Medis -->
        @foreach ($rekamMedis as $rm)
            <div class="modal" id="detailModal{{ $rm->id }}" tabindex="-1"
                aria-labelledby="detailModalLabel{{ $rm->id }}" aria-hidden="true">
                <div class="animate__animated animate__zoomIn">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="h2 f-bolder" id="detailModalLabel{{ $rm->id }}">Detail Rekam Medis</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="h4 f-bolder my-2"><strong>Pasien:</strong> {{ $rm->kunjungan->pasien->nama }}</p>
                                <p class="h4 f-bolder my-2"><strong>Diagnosa:</strong> {{ $rm->diagnosa }}</p>
                                <p class="h4 f-bolder my-2"><strong>Tindakan:</strong> {{ $rm->tindakan }}</p>
                                <p class="h4 f-bolder my-2"><strong>Obat:</strong>
                                    @foreach ($rm->obats as $obat)
                                        <p>{{ $obat->obat }} - Jumlah: {{ $obat->pivot->jumlah }}</p>
                                    @endforeach
                                </p>
                                <p class="h4 f-bolder my-2"><strong>Resep:</strong> {{ $rm->resep->first()->deskripsi ?? '' }}</p>
                                <p class="h4 f-bolder my-2"><strong>Gambar:</strong></p>
                                @foreach ($rm->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" height="150" width="120"
                                        alt="Gambar" class="mb-2">
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="px-2 py-1 btn-close red-hover" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $rekamMedis->links() }}

        @foreach ($rekamMedis as $rm)
            <!-- Edit Rekam Medis Modal -->
            <div class="modal animate__animated" id="editModal{{ $rm->id }}">
                <div class="modal-content animate__animated animate__zoomIn">
                    <h2 class="h2 f-bolder">Edit Rekam Medis</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="{{ route('rekam_medis.update', $rm->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Pasien Selection -->
                        <div class="my-2">
                            <label for="kunjungan_id" class="h4 f-bolder">Pasien</label>
                            <div class="my-1">
                                <select name="kunjungan_id" id="kunjungan_id"
                                    class="form h4 f-normal px-2 w-100 h-3 border-radius-1">
                                    <option value="{{ $rm->kunjungan_id }}" selected>
                                        {{ $rm->kunjungan->pasien->nama }}</option>
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

                        <!-- Diagnosa -->
                        <div class="my-2">
                            <label for="diagnosa" class="h4 f-bolder">Diagnosa</label>
                            <div class="my-1">
                                <input type="text" class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                    id="diagnosa" name="diagnosa" value="{{ $rm->diagnosa }}">
                            </div>
                            @error('diagnosa')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tindakan -->
                        <div class="my-2">
                            <label for="tindakan" class="h4 f-bolder">Tindakan</label>
                            <div class="my-1">
                                <input type="text" class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                    id="tindakan" name="tindakan" value="{{ $rm->tindakan }}">
                            </div>
                            @error('tindakan')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resep -->
                        <div class="my-2">
                            <label for="deskripsi" class="h4 f-bolder">Resep</label>
                            <div class="my-1">
                                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $rm->resep->first()->deskripsi ?? '' }}</textarea>
                            </div>
                            @error('deskripsi')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Medication Selection -->
                        <div class="my-2">
                            <label for="obat_id" class="h4 f-bolder">Obat</label>
                            <div class="my-1">
                                <select name="obat_id[]" class="form-control" id="obat_id" multiple>
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

                        <!-- Quantity Section -->
                        <div id="obat-quantity-container">
                            @foreach ($rm->obats as $obat)
                                <div class="my-2" id="obat-quantity-{{ $obat->id }}">
                                    <label for="jumlah_obat" class="h4 f-bolder">{{ $obat->obat }} -
                                        Jumlah</label>
                                    <div class="my-1">
                                        <input type="number" name="jumlah_obat[{{ $obat->id }}]"
                                            class="form h4 f-normal px-2 w-100 h-3 border-radius-1"
                                            value="{{ $obat->pivot->jumlah }}" min="1">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Images Section with Checkboxes -->
                        <div class="my-2">
                            <label class="form-label h4 f-bolder">Gambar</label>
                            <div>
                                @foreach ($rm->images as $image)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="delete_images[]"
                                            value="{{ $image->id }}" id="deleteImage{{ $image->id }}">
                                        <label class="form-check-label" for="deleteImage{{ $image->id }}">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" height="100"
                                                width="80" alt="Gambar">
                                            Hapus gambar ini
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- New Image Upload Section -->
                        <div class="my-2">
                            <label for="new_images" class="h4 f-bolder">Tambah Gambar Baru</label>
                            <div class="my-1">
                                <input type="file" class="form-control" name="new_images[]" multiple>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Detail Rekam Medis Modal -->
            <div class="modal animate__animated" id="detailModal{{ $rm->id }}">
                <div class="modal-content animate__animated animate__zoomIn">
                    <h2 class="h2 f-bolder">Detail Rekam Medis</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <p class="h4 f-bolder my-2"><strong>Pasien:</strong> {{ $rm->kunjungan->pasien->nama }}</p>
                        <p class="h4 f-bolder my-2"><strong>Diagnosa:</strong> {{ $rm->diagnosa }}</p>
                        <p class="h4 f-bolder my-2"><strong>Tindakan:</strong> {{ $rm->tindakan }}</p>
                        <p class="h4 f-bolder my-2"><strong>Obat:</strong>
                            @foreach ($rm->obats as $obat)
                                {{ $obat->obat }} - Jumlah: {{ $obat->pivot->jumlah }}<br>
                            @endforeach
                        </p>
                        <p class="h4 f-bolder my-2"><strong>Resep:</strong> {{ $rm->resep->first()->deskripsi ?? 'No Recipe' }}</p>
                        <p class="h4 f-bolder my-2"><strong>Gambar:</strong></p>
                        @foreach ($rm->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" height="150" width="120"
                                class="mb-2" alt="Gambar">
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

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
        var addModal = document.getElementById("myModalAdd");
        var btnOpenAddModal = document.getElementById("btnOpenAddModal");
        var btnCloseAddModal = document.getElementById("btnCloseAddModal");

        var editModal = document.getElementById("myModalEdit");

        btnOpenAddModal.onclick = function() {
            addModal.style.display = "block";
        }

        btnCloseAddModal.onclick = function() {
            addModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                addModal.style.display = "none";
            }
        }

        function btnOpenEditModal(id) {
            var modal = document.getElementById("myModalEdit" + id);
            modal.style.display = "block";
        }

        function closeEditModal() {
            var modal = document.getElementById("myModalEdit");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
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



        document.querySelectorAll('.modal-footer button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
@endsection
