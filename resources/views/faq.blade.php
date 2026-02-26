@extends('layouts.main') 

@section('title', 'FAQ - Tanya Jawab')

@section('container')
<div class="container py-4">
    
    {{-- Judul Halaman --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase" style="color: #0d47a1; letter-spacing: 1px;">
            Pertanyaan Sering Diajukan
        </h2>
        <div class="d-inline-block bg-warning mt-2" style="height: 4px; width: 80px; border-radius: 2px;"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            {{-- Accordion --}}
            <div class="accordion shadow-sm" id="accordionFAQ">
                @forelse($faqs as $index => $faq)
                    <div class="accordion-item mb-3 border-0 rounded overflow-hidden" style="box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-semibold" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $faq->id }}" 
                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $faq->id }}"
                                    style="background-color: #fff; color: #0d47a1;">
                                <i class="bi bi-patch-question-fill text-warning me-2 fs-5"></i>
                                {{ $faq->pertanyaan ?? $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $faq->id }}" 
                             class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                             aria-labelledby="heading{{ $faq->id }}" 
                             data-bs-parent="#accordionFAQ">
                            <div class="accordion-body bg-light text-secondary lh-lg">
                                {!! $faq->jawaban ?? $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center border-0 shadow-sm">
                        <i class="bi bi-info-circle me-2"></i> Belum ada data FAQ.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Style Tambahan Khusus FAQ (Opsional) --}}
<style>
    .accordion-button:not(.collapsed) {
        background-color: #e8f0fe !important; /* Warna biru sangat muda saat aktif */
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    .accordion-button:focus {
        box-shadow: none; /* Hilangkan glow biru default bootstrap */
        border-left: 4px solid #ffc107; /* Garis kuning di kiri saat aktif */
    }
</style>
@endsection