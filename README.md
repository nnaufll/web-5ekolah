🏫 Sistem Informasi Manajemen Sekolah

Project Magang Semester 6
Dikembangkan dengan dedikasi oleh Naufal Nadina Putra & Roihan Naufal








📖 Tentang Project

Sistem Informasi Manajemen Sekolah adalah platform berbasis web yang dibangun menggunakan Laravel untuk membantu sekolah dalam mengelola data akademik sekaligus menyajikan informasi publik secara modern dan interaktif.

Project ini dikembangkan sebagai bagian dari program magang Semester 6 dengan fokus pada:

Efisiensi pengelolaan data sekolah

Tampilan modern dan user-friendly

Struktur sistem yang scalable dan maintainable

🛠️ Tech Stack
Kategori	Teknologi	Versi
Framework	Laravel	12.47.0
Backend	PHP	8.2.12
Frontend Tools	Node.js	v22.15.0
Package Manager	NPM	10.9.2
Database	MySQL	Latest
🚀 Fitur Unggulan
📊 Dashboard Modern

Menampilkan visualisasi statistik data sekolah secara ringkas dan informatif.

📰 CMS Sekolah

Kelola berita, agenda, dan ekstrakurikuler dengan sistem manajemen konten yang mudah digunakan.

📂 Data Master Management

Manajemen data Guru, Siswa, dan Tenaga Kependidikan secara terpusat.

🌙 Dark Mode Support

Memberikan kenyamanan visual bagi admin saat bekerja dalam waktu lama.

🔐 Authentication System

Sistem login terproteksi dengan role-based access.

📦 Panduan Instalasi
1️⃣ Clone Repository
git clone https://github.com/nnaufll/web-5ekolah.git
cd web-5ekolah
2️⃣ Install Dependencies
composer install
npm install
npm run dev
3️⃣ Konfigurasi Environment
cp .env.example .env
php artisan key:generate

Atur konfigurasi database di file .env:

DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

Kemudian jalankan migrasi:

php artisan migrate
4️⃣ Jalankan Aplikasi
php artisan serve

Akses melalui:

http://127.0.0.1:8000
🔑 Akses Default
Role	Email	Password
Admin	admin@sekolah.com
	password

Login dapat diakses melalui:

http://127.0.0.1:8000/login
👥 Kontributor

Naufal Nadina Putra

Roihan Naufal

🎯 Tujuan Pengembangan

Project ini dikembangkan untuk tujuan edukasi dan implementasi nyata sistem informasi pendidikan berbasis web menggunakan Laravel.

<p align="center"> <i>Built with dedication for education and system development 🚀</i> </p>

Sekarang dijamin: