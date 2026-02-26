<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Sistem Sekolah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #020617;
            --glass-border: rgba(255, 255, 255, 0.1);
            --primary: #3b82f6;
            --text-main: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow: hidden;
            height: 100vh;
            margin: 0;
        }

        /* --- BACKGROUND --- */
        .ambient-light {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .light-blob {
            position: absolute;
            filter: blur(80px);
            opacity: 0.5;
            animation: moveBlob 20s infinite alternate;
        }
        .blob-1 { top: -10%; left: -10%; width: 50vw; height: 50vw; background: radial-gradient(circle, var(--primary), transparent 70%); }
        .blob-2 { bottom: -10%; right: -10%; width: 60vw; height: 60vw; background: radial-gradient(circle, #6366f1, transparent 70%); animation-delay: -5s; }
        @keyframes moveBlob { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(50px, -50px) scale(1.1); } }
        
        .grid-overlay {
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px; mask-image: linear-gradient(to bottom, black 40%, transparent 100%);
        }

        .main-container {
            position: relative; z-index: 10; display: flex; height: 100vh; width: 100vw;
        }

        /* --- LEFT PANEL --- */
        .left-panel {
            flex: 1.3; padding: 4rem 5rem; display: flex; flex-direction: column; justify-content: center; position: relative;
        }

        /* WRAPPER TEKS (Penting: Pointer Events None) 
           Supaya kalau kartu ada di belakang teks, mousenya tetap bisa nembus kena kartu */
        .text-content-wrapper {
            position: relative;
            z-index: 10; /* Di atas kartu */
            pointer-events: none; /* Mouse tembus ke belakang */
        }
        
        /* Tapi elemen di dalamnya (link/text) harus bisa diselect */
        .text-content-wrapper h1, 
        .text-content-wrapper p, 
        .text-content-wrapper .copyright-text {
            pointer-events: auto;
        }

        .hero-title {
            font-size: 4rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem; color: #ffffff;
            text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
        }

        .typing-cursor::after {
            content: '|'; animation: blink 1s step-start infinite; color: var(--primary); margin-left: 5px;
        }
        @keyframes blink { 50% { opacity: 0; } }

        .hero-desc {
            font-size: 1.15rem; color: rgba(255, 255, 255, 0.9); line-height: 1.6; max-width: 500px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.8);
        }

        .copyright-text { margin-top: 3rem; font-size: 0.85rem; color: rgba(255, 255, 255, 0.7); }

        /* --- FLOATING CARDS --- */
        .floating-card {
            position: absolute;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            padding: 12px 18px;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            display: flex; align-items: center; gap: 12px;
            
            /* Posisi Z-Index lebih rendah dari teks */
            z-index: 5; 
            
            /* Transisi "Membal" */
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            cursor: pointer;
            min-width: 180px;
            
            /* Animasi Default */
            animation: floatCard 6s ease-in-out infinite;
        }

        .card-icon {
            width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: white; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Posisi Awal Kartu */
        .fc-3 { top: 15%; right: 10%; animation-delay: 4s; }
        .fc-1 { top: 45%; right: 5%; animation-delay: 0s; }
        .fc-2 { bottom: 15%; right: 15%; animation-delay: 2s; }

        @keyframes floatCard {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(0, -15px); }
        }

        /* --- RIGHT PANEL --- */
        .right-panel {
            flex: 1; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(30px); border-left: 1px solid var(--glass-border);
            display: flex; align-items: center; justify-content: center; padding: 3rem;
        }
        .login-box { width: 100%; max-width: 380px; }
        .form-control-custom {
            width: 100%; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); border-radius: 12px; padding: 16px 20px; color: white;
        }
        .form-control-custom:focus { outline: none; border-color: var(--primary); background: rgba(59, 130, 246, 0.1); }
        .btn-gradient {
            width: 100%; background: linear-gradient(135deg, var(--primary), #2563eb); border: none; padding: 16px; border-radius: 12px; color: white; font-weight: 700; transition: transform 0.2s;
        }
        .btn-gradient:hover { transform: translateY(-3px); }

        @media (max-width: 991px) {
            .left-panel { display: none; }
            .right-panel { width: 100%; border: none; background: transparent; }
        }
    </style>
</head>
<body>

    <div class="ambient-light">
        <div class="light-blob blob-1"></div>
        <div class="light-blob blob-2"></div>
        <div class="grid-overlay"></div>
    </div>

    <div class="main-container">
        
        {{-- PANEL KIRI --}}
        <div class="left-panel">
            
            {{-- KARTU KABUR (Z-INDEX 5) --}}
            <div class="floating-card fc-3">
                <div class="card-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <div>
                    <div class="small text-white-50" style="font-size: 0.75rem;">KEAMANAN</div>
                    <div class="fw-bold text-warning">Terproteksi</div>
                </div>
            </div>

            <div class="floating-card fc-1">
                <div class="card-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                    <i class="bi bi-database-fill-check"></i>
                </div>
                <div>
                    <div class="small text-white-50" style="font-size: 0.75rem;">PENYIMPANAN</div>
                    <div class="fw-bold text-white">Terpusat</div>
                </div>
            </div>

            <div class="floating-card fc-2">
                <div class="card-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="bi bi-hdd-network-fill"></i>
                </div>
                <div>
                    <div class="small text-white-50" style="font-size: 0.75rem;">STATUS SERVER</div>
                    <div class="fw-bold text-success">Online</div>
                </div>
            </div>

            {{-- TEXT WRAPPER (Z-INDEX 10 & POINTER EVENTS TRICK) --}}
            <div class="text-content-wrapper">
                <h1 class="hero-title">
                    Manajemen Sekolah<br>
                    <span style="color: var(--primary);" id="dynamic-text"></span><span class="typing-cursor"></span>
                </h1>
                
                <p class="hero-desc">
                    Sistem administrasi pendidikan terpadu. Pantau akademik, kesiswaan, dan inventaris sekolah dalam satu dashboard yang efisien.
                </p>

                <div class="copyright-text">
                    &copy; {{ date('Y') }} Sistem Informasi Sekolah v3.0. Hak Cipta Dilindungi.
                </div>
            </div>

        </div>

        {{-- PANEL KANAN --}}
        <div class="right-panel">
            <div class="login-box">
                <div class="d-lg-none text-center mb-5"><i class="bi bi-mortarboard-fill text-primary display-1"></i></div>
                <div class="mb-5">
                    <h2 class="fw-bold mb-2 text-white">Selamat Datang.</h2>
                    <p class="text-white-50">Silakan login untuk mengakses dashboard.</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger border-0 d-flex align-items-center gap-2 mb-4"><small>{{ $errors->first() }}</small></div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="d-block text-white-50 small fw-bold mb-2">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control-custom" placeholder="admin@sekolah.sch.id" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="text-white-50 small fw-bold">PASSWORD</label>
                            @if (Route::has('password.request')) <a href="{{ route('password.request') }}" class="text-primary text-decoration-none small">Lupa Password?</a> @endif
                        </div>
                        <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" style="background-color: transparent; border-color: rgba(255,255,255,0.5);">
                        <label class="form-check-label text-white-50 small pt-1" for="remember">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn-gradient">Masuk Dashboard</button>
                </form>
                <div class="text-center mt-5">
                    <p class="text-white-50 small">Butuh bantuan? <a href="#" class="text-white text-decoration-none fw-bold">Hubungi IT Support</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // TYPEWRITER
        const words = ["Terintegrasi.", "Berbasis Digital.", "Lebih Efisien.", "Masa Depan.", "Aman & Cepat."];
        let i = 0; let timer;
        function typeWriter() {
            const heading = document.getElementById("dynamic-text");
            const word = words[i];
            const current = heading.textContent;
            if (current.length < word.length) { heading.textContent = word.substring(0, current.length + 1); timer = setTimeout(typeWriter, 100); }
            else { setTimeout(erase, 2000); }
        }
        function erase() {
            const heading = document.getElementById("dynamic-text");
            const current = heading.textContent;
            if (current.length > 0) { heading.textContent = current.substring(0, current.length - 1); timer = setTimeout(erase, 50); }
            else { i = (i + 1) % words.length; setTimeout(typeWriter, 500); }
        }

        // RUNAWAY CARDS (Jinak & Terbatas)
        const cards = document.querySelectorAll('.floating-card');
        
        cards.forEach(card => {
            card.addEventListener('mouseover', function() {
                // Matikan animasi default
                this.style.animation = 'none';
                
                // BATASI PERGERAKAN (MAX 150px dari titik awal)
                // Kita gunakan logika random sederhana tapi dibatasi range-nya
                const limit = 150; 
                
                const moveX = (Math.random() - 0.5) * limit; // Range: -75px sampai +75px
                const moveY = (Math.random() - 0.5) * limit; 

                // Terapkan translasi
                this.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
            
            // Opsional: Kalau mouse pergi, balik lagi pelan-pelan (opsional, biar rapi lagi)
            // card.addEventListener('mouseleave', function() {
            //     setTimeout(() => {
            //         this.style.transform = 'translate(0, 0)';
            //         this.style.animation = 'floatCard 6s ease-in-out infinite';
            //     }, 2000);
            // });
        });

        window.onload = typeWriter;
    </script>

</body>
</html>