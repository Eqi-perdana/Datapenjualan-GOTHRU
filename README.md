
**GOTHRU**



Anggota 

   ⬇


1.Eqi Perdana



2.Azhar Aulia



3.Tegar Katresna

# ✨ Aplikasi Penjualan  

<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&pause=1000&color=3B82F6&center=true&vCenter=true&width=600&lines=Selamat+Datang+di+Aplikasi+Penjualan;Kelola+Produk%2C+Pembelian%2C+Penjualan+dengan+Mudah;Role+%3A+Admin+dan+Karyawan" alt="Typing SVG" />
</p>

<p align="center">
  <img src="docs/screenshots/demo.gif" alt="Demo Aplikasi" width="700">
</p>

---

## 🚀 Fitur Utama
- ⚡ **Autentikasi dengan Role (Admin & Karyawan)**  
- 📊 **Dashboard Statistik (Chart.js animasi)**  
- 🛒 **CRUD Produk, Kategori, Supplier**  
- 💳 **Transaksi Penjualan & Pembelian**  
- 🎨 **UI Modern dengan Bootstrap 5**  
- 🔐 **Role-based Access Control (RBAC)**  

---

## 🛠️ Teknologi
| Bagian     | Teknologi                          |
|------------|------------------------------------|
| Backend    | Laravel 10, Eloquent ORM           |
| Frontend   | Blade, Bootstrap 5, Chart.js       |
| Database   | MySQL / MariaDB                    |
| Tools      | Composer, NPM, Carbon, Breeze Auth |

---

## 🎬 Demo Animasi
- **Login & Role Redirect**
  ![Login Demo](docs/screenshots/login.gif)

- **Transaksi Penjualan**
  ![Sales Demo](docs/screenshots/sales.gif)

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

    USERS ||--o{ PURCHASES : "melakukan"
    USERS ||--o{ SALES : "melakukan"
    CATEGORIES ||--o{ PRODUCTS : "memiliki"
    SUPPLIERS ||--o{ PRODUCTS : "menyediakan"
    SUPPLIERS ||--o{ PURCHASES : "dilibatkan"
    PRODUCTS ||--o{ SALES : "dijual"
