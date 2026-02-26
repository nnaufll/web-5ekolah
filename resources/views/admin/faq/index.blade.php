@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-semibold mb-0 text-light">
        <i class="bi bi-question-circle me-2"></i> Kelola FAQ
    </h4>
</div>

{{-- FORM TAMBAH FAQ --}}
<div class="card mb-4">
    <div class="card-body">

        <h6 class="text-light mb-3">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pertanyaan Baru
        </h6>

        <form action="{{ route('faq.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                {{-- PERTANYAAN --}}
                <div class="col-md-6">
                    <label class="form-label text-light">Pertanyaan</label>
                    <input type="text"
                           name="question"
                           class="form-control bg-dark text-light border-secondary"
                           required>
                </div>

                {{-- URUTAN --}}
                <div class="col-md-3">
                    <label class="form-label text-light">Urutan</label>
                    <input type="number"
                           name="order"
                           value="0"
                           class="form-control bg-dark text-light border-secondary">
                </div>

                {{-- BUTTON --}}
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-1"></i> Simpan FAQ
                    </button>
                </div>

                {{-- JAWABAN --}}
                <div class="col-12">
                    <label class="form-label text-light">Jawaban</label>
                    <textarea name="answer"
                              rows="3"
                              class="form-control bg-dark text-light border-secondary"
                              required></textarea>
                </div>
            </div>
        </form>

    </div>
</div>

{{-- TABLE FAQ --}}
<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead>
                    <tr class="text-uppercase small opacity-75">
                        <th width="80">Urutan</th>
                        <th>Pertanyaan & Jawaban</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td class="text-light">{{ $faq->order }}</td>

                            <td>
                                <div class="fw-semibold text-light">
                                    {{ $faq->question }}
                                </div>
                                <div class="small text-light opacity-75">
                                    {{ Str::limit($faq->answer, 120) }}
                                </div>
                            </td>

                            <td class="text-center">
                                <form action="{{ route('faq.destroy', $faq->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus FAQ ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-light opacity-50 py-4">
                                Belum ada data FAQ
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
