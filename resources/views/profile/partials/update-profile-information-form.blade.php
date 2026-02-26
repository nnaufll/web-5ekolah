<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label class="form-label text-light">Nama</label>
        <input type="text"
               name="name"
               value="{{ old('name', auth()->user()->name) }}"
               class="form-control bg-dark text-light border-secondary"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label text-light">Email</label>
        <input type="email"
               name="email"
               value="{{ old('email', auth()->user()->email) }}"
               class="form-control bg-dark text-light border-secondary"
               required>
    </div>

    <button class="btn btn-primary px-4">
        <i class="bi bi-save me-1"></i> Simpan
    </button>
</form>
