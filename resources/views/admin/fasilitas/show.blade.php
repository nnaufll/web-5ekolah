<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Fasilitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <div class="mb-4">
                <a href="{{ route('fasilitas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Kembali ke Daftar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- KOLOM 1: FOTO & ICON --}}
                        <div class="md:col-span-1">
                            <div class="border rounded-lg p-2 shadow-sm">
                                @if($fasilitas->foto)
                                    <img src="{{ asset('storage/' . $fasilitas->foto) }}" 
                                         class="w-full h-64 object-cover rounded" 
                                         alt="{{ $fasilitas->nama_fasilitas }}">
                                @else
                                    <div class="w-full h-64 bg-gray-100 flex flex-col items-center justify-center rounded">
                                        <span class="text-4xl text-gray-400 mb-2">
                                            {{-- Menampilkan Icon jika ada, jika tidak default icon --}}
                                            <i class="bi {{ $fasilitas->icon ?? 'bi-building' }}"></i>
                                        </span>
                                        <p class="text-gray-500 text-sm">Tidak ada foto</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Tombol Aksi Cepat --}}
                            <div class="mt-4 grid grid-cols-1 gap-2">
                                <a href="{{ route('fasilitas.edit', $fasilitas->id) }}" class="block w-full text-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                                    Edit Fasilitas
                                </a>
                            </div>
                        </div>

                        {{-- KOLOM 2: DATA DETAIL --}}
                        <div class="md:col-span-2">
                            <h2 class="text-2xl font-bold text-blue-600 mb-1">{{ $fasilitas->nama_fasilitas }}</h2>
                            <p class="text-gray-400 text-sm italic mb-6">Slug: {{ $fasilitas->slug }}</p>

                            <div class="mb-6">
                                <h5 class="text-lg font-semibold border-b pb-2 mb-3">Deskripsi</h5>
                                <div class="text-gray-700 leading-relaxed text-justify">
                                    {!! nl2br(e($fasilitas->deskripsi)) !!}
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="p-4 bg-gray-50 rounded border">
                                    <small class="text-gray-500 block">Nama Icon (Bootstrap)</small>
                                    <strong class="text-gray-800">{{ $fasilitas->icon ?? '-' }}</strong>
                                </div>
                                <div class="p-4 bg-gray-50 rounded border">
                                    <small class="text-gray-500 block">Terakhir Diupdate</small>
                                    <strong class="text-gray-800">{{ $fasilitas->updated_at->format('d F Y, H:i') }}</strong>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>