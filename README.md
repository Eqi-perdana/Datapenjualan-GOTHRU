# 🚀 GOTHRU — Aplikasi Penjualan

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red?logo=laravel" alt="Laravel" />
  <img src="https://img.shields.io/badge/Database-MySQL-blue?logo=mysql" alt="MySQL" />
  <img src="https://img.shields.io/badge/Frontend-Bootstrap_5-563d7c?logo=bootstrap&logoColor=white" alt="Bootstrap" />
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License" />
  <img src="https://img.shields.io/badge/Status-Active-success" alt="Status" />
</p>

---

## 👥 PKL — GOTHRU

Anggota:

1. Eqi Perdana
2. Azhar Aulia
3. Tegar Katresna

---



## ✨ Ringkasan

**GOTHRU — Aplikasi Penjualan** adalah sistem manajemen penjualan berbasis *Laravel* yang dibuat untuk memudahkan pengelolaan **produk, kategori, supplier, penjualan, dan pembelian**. Sistem ini menerapkan **role-based access control** (Admin & Karyawan) sehingga hak akses dapat dibedakan.

<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=3B82F6&center=true&vCenter=true&width=700&lines=Selamat+Datang+di+Aplikasi+Penjualan;Kelola+Produk%2C+Penjualan%2C+Pembelian+dengan+Mudah;Role+%3A+Admin+dan+Karyawan" alt="Typing SVG" />
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

| Bagian   | Teknologi                                              |
| -------- | ------------------------------------------------------ |
| Backend  | Laravel 12, Eloquent ORM                               |
| Frontend | Blade, Bootstrap 5, Chart.js                           |
| Database | MySQL / MariaDB                                        |
| Tools    | Composer, NPM, Carbon, Breeze Auth,Viscode, dan github |
                        
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

| Role         | Hak Akses                                                                                    |
| ------------ | -------------------------------------------------------------------------------------------- |
| **Admin**    | CRUD Produk, Kategori, Supplier, User, Penjualan, Pembelian, Stocklog, Product Harga Histori |
| **Karyawan** | Input Penjualan & Pembelian, Lihat Data Produk                                               |

---


## 🤝 Kontribusi

repo ini di colaborasi supaya mempermudah kelompok untuk mengakses reponya dan bisa menambahkan atau mengedit repo nya juga

---

## 📄 Lisensi

MIT License © 2025 — GOTHRU

---

## 📬 Kontak

Dibuat oleh tim **GOTHRU** (Eqi, Azhar, Tegar). Untuk pertanyaan atau demo, buka Issues atau hubungi via GitHub.

---
