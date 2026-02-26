<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- LOGO --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                {{-- MENU DESKTOP --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- DROPDOWN: PROFIL SEKOLAH --}}
                    <div class="hidden sm:flex sm:items-center sm:ms-4">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>Identitas & Staff</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20 text-gray-400"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('admin.profil.index')">Profil Sekolah</x-dropdown-link>
                                <x-dropdown-link :href="route('guru.index')">Guru & Staff</x-dropdown-link>
                                <x-dropdown-link :href="route('fasilitas.index')">Fasilitas</x-dropdown-link>
                                <x-dropdown-link :href="route('eskul.index')">Ekstrakurikuler</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    {{-- DROPDOWN: KONTEN & INFORMASI --}}
                    <div class="hidden sm:flex sm:items-center sm:ms-4">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>Informasi</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20 text-gray-400"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                {{-- MENU SLIDER BARU --}}
                                <x-dropdown-link :href="route('admin.slider.index')"><b>Slider Banner</b></x-dropdown-link>
                                <hr class="my-1 border-gray-100">
                                <x-dropdown-link :href="route('admin.berita.index')">Berita</x-dropdown-link>
                                <x-dropdown-link :href="route('admin.galeri.index')">Galeri Foto</x-dropdown-link>
                                <x-dropdown-link :href="route('agenda.index')">Agenda Kegiatan</x-dropdown-link>
                                <x-dropdown-link :href="route('jadwal.index')">Jadwal Pelajaran</x-dropdown-link>
                                <x-dropdown-link :href="route('faq.index')">FAQ</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>

            {{-- USER DROPDOWN (KANAN) --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- Tombol Lihat Website (Frontend) --}}
                <a href="/" target="_blank" class="me-4 text-sm text-blue-600 hover:text-blue-800 underline">Lihat Web</a>
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            
            {{-- HAMBURGER (MOBILE) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden shadow-inner bg-gray-50">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <hr>
            <x-responsive-nav-link :href="route('admin.profil.index')">Profil Sekolah</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.slider.index')" :active="request()->routeIs('admin.slider.*')">Slider Banner</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.berita.index')">Berita</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('eskul.index')">Eskul</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('fasilitas.index')">Fasilitas</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.galeri.index')">Galeri</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('guru.index')">Guru & Staff</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('agenda.index')">Agenda</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('jadwal.index')">Jadwal</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faq.index')">FAQ</x-responsive-nav-link>
        </div>

        {{-- USER SETTINGS MOBILE --}}
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>