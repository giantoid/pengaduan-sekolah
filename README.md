# E-Aspirasi: Aplikasi Pengaduan Sarana Sekolah

**E-Aspirasi** adalah platform digital yang dirancang untuk memfasilitasi siswa dalam melaporkan kerusakan sarana dan prasarana sekolah. Proyek ini dibangun menggunakan [Framework Laravel](https://laravel.com) sebagai solusi pemenuhan tugas UKK Paket 3 Rekayasa Perangkat Lunak.

---

## 🛠️ Persyaratan Sistem

Sebelum memulai, pastikan perangkat Anda telah terpasang:

- **PHP** (Versi 8.2 atau lebih baru)
- **Composer** (Dependency Manager untuk PHP)
- **Node.js & NPM** (Untuk kompilasi asset CSS/JS)
- **MySQL** (Melalui XAMPP/Laragon/Native)

---

## ⚙️ Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di perangkat lokal:

1.  **Clone Repositori**

    ```bash
    git clone https://github.com
    cd nama-repo
    ```

2.  **Instal Dependensi PHP**

    ```bash
    composer install
    ```

3.  **Instal Dependensi Frontend**

    ```bash
    npm install && npm run build
    ```

4.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`, lalu sesuaikan `DB_DATABASE=db_e_aspirasi`.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Migrasi & Seed Database**
    Jalankan perintah ini untuk membuat tabel dan mengisi akun admin default:

    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

---

## 🚀 Alur Pengembangan Proyek

### Fase 1: Inisialisasi & Autentikasi

- **Laravel Breeze**: Menggunakan starter kit untuk fitur Login dan Register.
- **Modifikasi Tabel User**: Menambahkan kolom `role` (admin/student), `username`, dan `class`.
- **Middleware Role**: Membuat pengamanan akses halaman menggunakan `CheckRole`.

### Fase 2: Struktur Data & Relasi

- **Tabel Master**: `categories` untuk pengelompokan sarana (Elektronik, Bangunan, dll).
- **Tabel Transaksi**: `complaints` (aspirasi) dan `feedbacks` (tanggapan admin).
- **Eloquent Relationship**: Mengatur relasi _One-to-Many_ antar Model.

### Fase 3: Fitur Siswa (Student)

- **Input Aspirasi**: Formulir pelaporan kerusakan berdasarkan kategori dan lokasi.
- **Histori Laporan**: Tracking status laporan secara _real-time_.

### Fase 4: Fitur Admin

- **Dashboard Monitoring**: Panel untuk mengelola seluruh aspirasi siswa.
- **Tanggapan & Status**: Fitur untuk mengubah status (Pending, Processing, Done) dan memberi feedback.

### Fase 5: Penyempurnaan (Finishing)

- **Filter & Search**: Memudahkan pencarian data aspirasi.
- **UI Polishing**: Menggunakan [Tailwind CSS](https://tailwindcss.com) agar tampilan responsif.

---

## 🔑 Informasi Akun Default (Seeder)

Gunakan akun berikut untuk login pertama kali:

| User Role         | Username | Password   |
| :---------------- | :------- | :--------- |
| **Administrator** | `admin`  | `password` |

---

## 📂 Hasil Produksi

- **Source Code**: Full project Laravel.
- **Database**: Schema `.sql` (tersedia di folder database/migrations).
- **Dokumentasi**: File README ini dan diagram ERD.

> **"Membangun Transparansi, Memperbaiki Fasilitas Sekolah"**
