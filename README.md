
**GOTHRU**



Anggota 

   ⬇


1.Eqi Perdana



2.Azhar Aulia



3.Tegar Katresna

# 🚀 Aplikasi Penjualan

Selamat datang di **Aplikasi Penjualan** 🎉  
Aplikasi ini dibuat menggunakan **Laravel** sebagai backend untuk mengelola data **produk, penjualan, pembelian, dan karyawan** dengan sistem role-based (Admin & Karyawan).  

---

## ✨ Fitur Utama
- 🔑 **Autentikasi & Role** (Admin & Karyawan)
- 📦 **Manajemen Produk** (CRUD Produk & Kategori)
- 💰 **Manajemen Penjualan & Pembelian**
- 📊 **Dashboard Statistik** dengan grafik interaktif
- 👨‍💼 **Manajemen Karyawan**
- 🎨 **UI Modern** menggunakan Bootstrap 5

---

## 🛠️ Teknologi yang Digunakan
- [Laravel 10](https://laravel.com/) - Framework PHP
- [Bootstrap 5](https://getbootstrap.com/) - Frontend UI
- [MySQL/MariaDB](https://www.mysql.com/) - Database
- [Carbon](https://carbon.nesbot.com/) - Date & Time Handling

---

## ⚡ Instalasi & Setup

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di lokal:

```bash
# 1. Clone repository
git clone https://github.com/username/aplikasi-penjualan.git
cd aplikasi-penjualan

# 2. Install dependency
composer install
npm install && npm run dev

# 3. Copy file .env
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Atur koneksi database di file .env lalu migrate
php artisan migrate --seed

# 6. Jalankan server lokal
php artisan serve
