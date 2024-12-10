<!-- profile.blade.php -->

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
    </div>

    <div class="mb-3">
        <label for="spesialisasi" class="form-label">Spesialisasi</label>
        <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="{{ Auth::user()->spesialisasi }}" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Foto Profil</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
