# LF Store

Toko online kacamata anti radiasi, photocromic, style, kaos kaki, dan aksesoris berbasis di Balikpapan, Kalimantan Timur. Menggunakan **Laravel 13** dengan **Filament 3** sebagai admin panel dan **WhatsApp** sebagai saluran pemesanan utama.

---

## Tech Stack

| Teknologi | Keterangan |
|---|---|
| **Framework** | Laravel 13 |
| **PHP** | ^8.5 |
| **Admin Panel** | Filament 3 (Livewire 3) |
| **Database** | MySQL |
| **Frontend** | Tailwind CSS, Alpine.js, Vite |
| **Auth** | Laravel Breeze + Sanctum |
| **Image Processing** | Intervention Image, Spatie Image |
| **Invoice** | Spatie Browsershot + Puppeteer |
| **Testing** | Pest PHP 3 |

---

## Fitur

- **Katalog Produk** — Lihat produk dengan pencarian, filter kategori, pagination
- **Detail Produk** — Gallery gambar, deskripsi, tombol pesan via WhatsApp
- **Admin Panel** `/admin` — CRUD Kategori, Produk, Invoice
- **Manajemen Invoice** — Generate invoice JPG otomatis, kalkulasi subtotal/ongkir/diskon
- **Upload Gambar** — Auto-convert ke WebP, resize 1024x1024
- **Stok Monitoring** — Widget produk stok rendah di dashboard admin
- **Autentikasi** — Register, login, reset password, verifikasi email
- **SEO** — Open Graph, meta tags

---

## Persyaratan Sistem

- PHP ^8.5
- Composer 2.x
- MySQL 8.0+
- Node.js 18+ & NPM
- Chrome/Chromium (untuk Browsershot generate invoice)
- GD/Imagick PHP extension
- Fileinfo PHP extension

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/lfstore.git
cd lfstore
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install NPM Dependencies

```bash
npm install
npm run build
```

### 4. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai konfigurasi database dan environment:

```env
APP_NAME=LF Store
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lfstore
DB_USERNAME=root
DB_PASSWORD=

CHROME_PATH=/usr/bin/chromium-browser
```

### 5. Database & Migrasi

```bash
php artisan migrate --seed
```

Seeder akan membuat:
- 1 akun admin
- 7 kategori produk
- Puluhan produk dengan gambar
- Data invoice contoh

### 6. Storage Link

```bash
php artisan storage:link
```

### 7. Jalankan Development Server

```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`.

---

## Admin Panel

Panel admin dapat diakses di `/admin`.

### Akun Default

```
Email: luqmannfauzy46@gmail.com
Password: (lihat di database seed)
```

### Resources Admin

| Resource | Deskripsi |
|---|---|
| Category | Kelola kategori produk |
| Product | Kelola produk (multi-kategori, gambar, stok) |
| Invoice | Buat & unduh invoice (JPG) |

---

## Struktur Direktori

```
app/
├── Filament/
│   ├── Resources/       # Filament CRUD resources
│   └── Widgets/         # Dashboard widgets
├── Http/
│   ├── Controllers/
│   │   ├── Auth/        # Breeze auth controllers
│   │   └── ClientController.php  # Frontend controller
│   └── Middleware/      # Custom middleware
├── Models/              # Eloquent models
└── Providers/
    ├── AppServiceProvider.php
    └── Filament/
        └── AdminPanelProvider.php

routes/
├── web.php              # Frontend routes
├── api.php              # API routes
└── auth.php             # Auth routes (Breeze)

resources/views/
├── home.blade.php       # Beranda
├── catalog.blade.php    # Katalog produk
├── detail-product.blade.php  # Detail produk
├── category-product.blade.php  # Produk per kategori
├── invoice.blade.php    # Template invoice
└── filament/            # Override views Filament
```

---

## Model Relasi

```
Category ──belongsToMany──> Product ──hasMany──> ProductImage
                                │
Invoice ──hasMany──> InvoiceItem ──belongsTo──> Product
```

---

## Routes Publik

| Method | URI | Deskripsi |
|---|---|---|
| GET | `/` | Halaman beranda |
| GET | `/catalog` | Katalog produk |
| GET | `/detail-product/{slug}` | Detail produk |
| GET | `/category-product/{slug}` | Produk per kategori |

---

## Deployment

### Update ke Production

```bash
git fetch origin
git reset --hard origin/main

composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Catatan Deployment

- Set `APP_ENV=production` dan `APP_DEBUG=false` di `.env`
- Konfigurasi `CHROME_PATH` jika menggunakan fitur invoice JPG
- Pastikan storage link sudah dibuat

---

## Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ProductTest
```

---

## Lisensi

[MIT License](LICENSE)
