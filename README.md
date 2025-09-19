# 🚀 GOTHRU — Aplikasi Penjualan

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-red?logo=laravel" alt="Laravel" />
  <img src="https://img.shields.io/badge/Database-MySQL-blue?logo=mysql" alt="MySQL" />
  <img src="https://img.shields.io/badge/Frontend-Bootstrap-5-563d7c?logo=bootstrap" alt="Bootstrap" />
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License" />
  <img src="https://img.shields.io/badge/Status-Active-success" alt="Status" />
</p>

---

## 👥 Tim — GOTHRU

Anggota:

1. Eqi Perdana
2. Azhar Aulia
3. Tegar Katresna

---

<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=3B82F6&center=true&vCenter=true&width=600&lines=Selamat+Datang+di+Aplikasi+Penjualan;Kelola+Produk%2C+Pembelian%2C+Penjualan+dengan+Mudah;Role+%3A+Admin+dan+Karyawan" alt="Typing SVG" />
</p>

<p align="center">
  <img src="docs/screenshots/demo.gif" alt="Demo Aplikasi" width="700">
</p>

---


## ✨ Ringkasan

**GOTHRU — Aplikasi Penjualan** adalah sistem manajemen penjualan berbasis *Laravel* yang dibuat untuk memudahkan pengelolaan **produk, kategori, supplier, penjualan, dan pembelian**. Sistem ini menerapkan **role-based access control** (Admin & Karyawan) sehingga hak akses dapat dibedakan.

<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=3B82F6&center=true&vCenter=true&width=700&lines=Selamat+Datang+di+GOTHRU;Kelola+Produk%2C+Penjualan%2C+Pembelian+dengan+Mudah;Role+%3A+Admin+dan+Karyawan" alt="Typing SVG" />
</p>

<p align="center">
  <!-- Ganti demo.gif dengan gif demo aplikasi kamu di folder docs/screenshots/ -->
  <img src="docs/screenshots/demo.gif" alt="Demo Aplikasi" width="780" />
</p>

---

## 🚀 Fitur Utama

* 🔐 Autentikasi & Role (Admin & Karyawan)
* 📦 CRUD Produk, Kategori, Supplier
* 🧾 Transaksi Penjualan & Pembelian
* 📊 Dashboard Statistik (Chart.js)
* 📁 Laporan dan Export data (opsional)
* 🎨 UI responsif dengan Bootstrap 5

---

## 🛠️ Teknologi

| Bagian   | Teknologi                          |
| -------- | ---------------------------------- |
| Backend  | Laravel 10, Eloquent ORM           |
| Frontend | Blade, Bootstrap 5, Chart.js       |
| Database | MySQL / MariaDB                    |
| Tools    | Composer, NPM, Carbon, Breeze Auth |

---

## 🖼️ Foto & GIF (petunjuk)

Untuk menambahkan foto atau GIF ke README:

1. Simpan file gambar/gif di folder repo `docs/screenshots/` atau `docs/images/`.

   * Contoh:

     * `docs/screenshots/demo.gif` (rekaman demo)
     * `docs/screenshots/dashboard.png` (screenshot dashboard)
     * `docs/screenshots/login.gif` (login flow sebagai GIF)
     * `docs/images/team.jpg` (foto tim)
     * `docs/images/logo.png` (logo aplikasi)

2. Panggil gambar di README dengan markdown:

```markdown
![Dashboard](docs/screenshots/dashboard.png)
```

> Tip: kalau GIF berukuran besar, pertimbangkan gunakan Git LFS atau unggah ke layanan hosting gambar (Imgur / Cloud) lalu pakai URL-nya.

---

## 📊 Database (ERD)

```mermaid
erDiagram
    USERS {
        int id PK
        string name
        string email
        string password
        string role
    }

    CATEGORIES {
        int id PK
        string name
        text description
    }

    SUPPLIERS {
        int id PK
        string name_suppliers
        string contact
    }

    PRODUCTS {
        int id PK
        string name_product
        int category_id FK
        int supplier_id FK
        double price
        int stock
    }

    PURCHASES {
        int id PK
        int user_id FK
        int supplier_id FK
        date purchase_date
        double total_amount
    }

    SALES {
        int id PK
        int user_id FK
        int product_id FK
        date sale_date
        double total_amount
        string payment_method
    }

    USERS ||--o{ PURCHASES : melakukan
    USERS ||--o{ SALES : melakukan
    CATEGORIES ||--o{ PRODUCTS : memiliki
    SUPPLIERS ||--o{ PRODUCTS : menyediakan
    SUPPLIERS ||--o{ PURCHASES : dilibatkan
    PRODUCTS ||--o{ SALES : dijual
```

---

## 🏛️ Arsitektur Sistem

```mermaid
flowchart TD
    A[User Browser / Mobile] --> B[Laravel Routes]
    B --> C[Controllers]
    C --> D[Eloquent Models]
    D --> E[(MySQL Database)]
    C --> F[Blade Views / API Response]
    F --> A
```

---

## ⚡ Instalasi Singkat

```bash
# Clone
git clone https://github.com/username/gothru-aplikasi-penjualan.git
cd gothru-aplikasi-penjualan

# Install dependency
composer install
npm install && npm run dev

# Konfigurasi .env
cp .env.example .env
php artisan key:generate
# Edit .env -> sesuaikan DB_*

# Migrasi & seeder
php artisan migrate --seed

# Jalankan server
php artisan serve
```

Buka: `http://127.0.0.1:8000`

---

## 👥 Role & Hak Akses

| Role         | Hak Akses                                                            |
| ------------ | -------------------------------------------------------------------- |
| **Admin**    | CRUD Produk, Kategori, Supplier, User, Penjualan, Pembelian, Laporan |
| **Karyawan** | Input Penjualan & Pembelian, Lihat Data Produk                       |

---

## 📸 Contoh Penempatan Foto di README

Berikut contoh markup yang rapi untuk menampilkan beberapa gambar secara responsif:

```html
<p align="center">
  <img src="docs/images/logo.png" alt="Logo" width="120" />
</p>

<p align="center">
  <img src="docs/screenshots/dashboard.png" alt="Dashboard" width="600" />
</p>

<div align="center">
  <img src="docs/screenshots/login.gif" alt="Login Demo" width="300" />
  <img src="docs/screenshots/sales.gif" alt="Sales Demo" width="300" />
</div>

<p align="center">
  <img src="docs/images/team.jpg" alt="Team GOTHRU" width="600" />
</p>
```

---

## 🤝 Kontribusi

Fork repository → buat branch fitur → pull request. Sertakan deskripsi jelas & screenshot jika ada perubahan UI.

---

## 📄 Lisensi

MIT License © 2025 — GOTHRU

---

## 📬 Kontak

Dibuat oleh tim **GOTHRU** (Eqi, Azhar, Tegar). Untuk pertanyaan atau demo, buka Issues atau hubungi via GitHub.

---

*Catatan: Ganti contoh path gambar (`docs/screenshots/*` dan `docs/images/*`) dengan file yang nyata di repo kamu. Jika butuh, saya bisa bantu buat GIF demo atau pilihan layout foto yang lebih estetis.*
