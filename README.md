# Portal PKL - Monitoring Penugasan Laboratorium Komputer

Aplikasi berbasis web untuk mengelola penugasan siswa PKL dari berbagai sekolah SMK. Dibangun menggunakan **Laravel 12** dan **Bootstrap 5**, serta dioptimalkan agar enteng saat di-deploy.

---

## Fitur Aplikasi

### 👨‍💼 Fitur Admin (Supervisor)
- **CRUD Sekolah & Lab:** Tambah dan kelola data sekolah mitra serta penempatan divisi lab. Sudah mendukung *cascade delete* (hapus sekolah otomatis membersihkan data siswa di dalamnya).
- **Cek Nilai & Progres:** Indikator persentase otomatis untuk melihat berapa banyak tugas siswa yang sudah di-acc secara *real-time*.
- **Bulk Action Tugas:** Fitur terima (*Accept*) atau tolak (*Reject*) puluhan tugas siswa sekaligus dalam satu klik.
- **Fitur Kosongkan Storage:** Tombol khusus untuk menghapus semua file gambar bukti tugas di server sekaligus untuk menghemat kuota hosting.
- **Cetak PDF:** Export rekapitulasi nilai kumulatif seluruh siswa ke file PDF via DOMPDF.
- **UI Modern:** Semua konfirmasi hapus data menggunakan pop-up animasi dari **SweetAlert2** (tidak memakai `confirm()` bawaan browser yang jadul).

### 🎓 Fitur Siswa (PKL)
- **Upload Bukti Tugas:** Halaman dashboard untuk mengirimkan file gambar bukti pengerjaan tugas.
- **Auto-Lock Sistem:** Tombol upload otomatis terkunci dari sisi backend jika waktu pengumpulan sudah melewati *tenggat* yang ditentukan admin.

---

## Struktur Folder Hosting (Split-Folder Setup)

Proyek ini menggunakan struktur pemisahan folder di shared hosting demi keamanan, agar file core Laravel tidak bisa diakses langsung dari URL publik:

```text
└── laravel/                # Core System Laravel 
    ├── app/                # Controller, Model, & Middleware
    ├── bootstrap/          # Init system & cache
    ├── config/             # Semua konfigurasi framework
    ├── resources/          # File view Blade & text mentah
    └── storage/            # Tempat upload bukti tugas & session login
```

---

## 🚀 Tech Stack

- **Framework:** Laravel 12.x
- **Runtime:** PHP 8.3.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5.3 & SweetAlert2 *(via CDN produksi untuk menghemat bandwidth hosting)*
- **Library:** Barryvdh DomPDF & FontAwesome 6.5

---

## 💻 Cara Install di Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

1. **Clone Repositori:**
```bash
git clone https://github.com/FredySaputra/InternshipTaskMonitoringSystem.git
cd InternshipTaskMonitoringSystem
```

2. **Install Dependensi Composer:**
```bash
composer install
```

3. **Konfigurasi Environment:**
Salin file `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database Anda di dalamnya.
```bash
cp .env.example .env
php artisan key:generate
```

4. **Jalankan Migrasi & Seeder:**
```bash
php artisan migrate --seed
```

5. **Optimasi Cache & Jalankan Server:**
```bash
php artisan route:clear
php artisan serve
```

Setelah server berjalan, buka `http://127.0.0.1:8000` pada browser Anda.

---
<p align="center">
  <b>Fredy Dwi Saputra @ 2026</b>
</p>
