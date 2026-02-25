E-Aspirasi: Aplikasi Pengaduan Sarana Sekolah

E-Aspirasi adalah platform digital yang dirancang untuk memfasilitasi siswa dalam melaporkan kerusakan sarana dan prasarana sekolah. Proyek ini dibangun menggunakan Framework Laravel sebagai solusi pemenuhan tugas UKK Paket 3 Rekayasa Perangkat Lunak.

🛠️ Persyaratan Sistem

Sebelum memulai, pastikan perangkat Anda telah terpasang:

PHP (Versi 8.2 atau lebih baru)

Composer (Dependency Manager untuk PHP)

Node.js & NPM (Untuk kompilasi asset CSS/JS)

MySQL (Melalui XAMPP/Laragon)

🚀 Langkah Pengembangan

Fase 1: Inisialisasi & Autentikasi

Instalasi Laravel: Membuat project baru.

Laravel Breeze: Menginstal starter kit untuk fitur Login dan Register menggunakan stack Blade.

Konfigurasi Database: Menghubungkan project ke database db_e_aspirasi melalui file .env.

Modifikasi Tabel User: Menyesuaikan tabel bawaan Laravel agar mendukung login menggunakan username dan penambahan kolom role (admin/student) serta class.

Middleware Role: Membuat sistem pengaman (CheckRole) untuk membatasi akses halaman berdasarkan hak akses pengguna.

Fase 2: Struktur Data & Relasi

Migrasi Tabel Master: Pembuatan tabel categories untuk mengelompokkan sarana (misal: Elektronik, Bangunan).

Migrasi Tabel Transaksi: Pembuatan tabel complaints untuk data pengaduan dan feedbacks untuk tanggapan dari pihak admin.

Relasi Eloquent: Menghubungkan Model User, Complaint, Category, dan Feedback agar pengambilan data menjadi efisien menggunakan relasi One-to-Many dan One-to-One.

Data Seeding: Mengisi database awal dengan akun admin default dan beberapa kategori sarana dasar.

Fase 3: Pengembangan Fitur Siswa (Student)

AspirasiController: Membuat logika untuk menampilkan data pribadi siswa dan menyimpan laporan baru ke database.

Form Input: Membuat antarmuka formulir yang menyertakan pilihan kategori, lokasi, dan deskripsi masalah.

Histori Laporan: Membuat tabel riwayat agar siswa dapat memantau status laporan mereka secara real-time.

Fase 4: Pengembangan Fitur Admin

Dashboard Khusus Admin: Membuat antarmuka yang menampilkan seluruh aspirasi dari semua siswa.

Update Status & Tanggapan: Implementasi fitur bagi admin untuk mengubah status laporan (Pending, Processing, Done) sekaligus memberikan pesan umpan balik (feedback) tertulis.

Logic UpdateOrCreate: Menggunakan metode cerdas untuk menyimpan tanggapan admin agar tidak terjadi duplikasi data.

Fase 5: Penyempurnaan (Finishing)

Fitur Filter: Menambahkan kemampuan bagi admin untuk menyaring data berdasarkan nama pelapor, kategori tertentu, atau status laporan.

Pencarian Global: Implementasi kolom pencarian untuk mempercepat penemuan data aspirasi.

UI Polishing: Merapikan tampilan menggunakan Tailwind CSS agar aplikasi terlihat profesional dan responsif di berbagai perangkat.

🔑 Informasi Akun Default (Seeder)

Untuk masuk ke sistem admin tanpa registrasi manual:

Username: admin

Password: password

Role: Admin

📂 Hasil Produksi

Dokumen yang dihasilkan dari project ini meliputi:

Source Code: Kode program lengkap berbasis Laravel.

Database Schema: File .sql yang berisi struktur tabel dan data awal.

Dokumentasi Teknis: Berupa file README dan diagram ERD.

"Membangun Transparansi, Memperbaiki Fasilitas Sekolah"
