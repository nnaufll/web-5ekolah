@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-white mb-1">
                <i class="bi bi-person-circle me-2 text-primary"></i>
                Pengaturan Akun
            </h4>
            <p class="text-muted mb-0">
                Kelola informasi akun dan keamanan login Anda
            </p>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="row g-4">

        {{-- PROFIL --}}
        <div class="col-xl-6">
            <div class="card bg-dark border-0 shadow-lg rounded-4 h-100">
                <div class="card-header bg-gradient border-0 rounded-top-4"
                     style="background: linear-gradient(135deg,#0d6efd,#0dcaf0);">
                    <h6 class="fw-semibold text-white mb-0">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Informasi Profil
                    </h6>
                </div>
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="col-xl-6">
            <div class="card bg-dark border-0 shadow-lg rounded-4 h-100">
                <div class="card-header bg-gradient border-0 rounded-top-4"
                     style="background: linear-gradient(135deg,#ffc107,#fd7e14);">
                    <h6 class="fw-semibold text-dark mb-0">
                        <i class="bi bi-shield-lock-fill me-2"></i>
                        Keamanan Akun
                    </h6>
                </div>
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        {{-- DANGER ZONE --}}
        <div class="col-12">
            <div class="card bg-dark border border-danger shadow-lg rounded-4">
                <div class="card-header bg-transparent border-bottom border-danger py-3">
                    <h6 class="fw-semibold text-danger mb-0">
                        <i class="bi bi-exclamation-octagon-fill me-2"></i>
                        Zona Berbahaya
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-7">
                            @include('profile.partials.delete-user-form')
                        </div>
                        <div class="col-lg-5">
                            <div class="alert alert-danger border-danger bg-transparent mb-0">
                                <h6 class="fw-bold">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Peringatan
                                </h6>
                                <p class="mb-0 small">
                                    Menghapus akun akan menghilangkan seluruh data secara
                                    <b>permanen</b> dan tidak dapat dipulihkan kembali.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
