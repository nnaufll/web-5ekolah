<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-3">
        <label class="form-label text-light">Password Saat Ini</label>
        <input type="password"
               name="current_password"
               class="form-control bg-dark text-light border-secondary"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label text-light">Password Baru</label>
        <input type="password"
               name="password"
               class="form-control bg-dark text-light border-secondary"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label text-light">Konfirmasi Password</label>
        <input type="password"
               name="password_confirmation"
               class="form-control bg-dark text-light border-secondary"
               required>
    </div>

    <button class="btn btn-warning px-4">
        <i class="bi bi-shield-lock me-1"></i> Update Password
    </button>
</form>
