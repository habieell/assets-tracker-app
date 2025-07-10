<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">Assets Tracker App</h1>

<p align="center">
  A simple asset management system with barcode and QR code generation, built with Laravel 12 and Filament.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel 12">
  <img src="https://img.shields.io/github/license/habieell/assets-tracker-app" alt="License">
</p>

---

## 🚀 Features

- Manajemen data aset lengkap
- Generate dan cetak **barcode** (Code128) dan **QR Code** untuk setiap aset
- Tampilan admin interaktif dengan [FilamentPHP](https://filamentphp.com/)
- Cetak barcode langsung dari UI admin
- Menyimpan informasi aset: nama, kode unik, lokasi, status, penanggung jawab, tanggal pembelian & penggunaan

---

## 🛠 Tech Stack

- Laravel 12
- Filament PHP v3
- Milon/Barcode (QR Code & Code128)
- Tailwind CSS (dari Filament)
- MySQL / MariaDB

---

## ⚙️ Installation

```bash
git clone https://github.com/habieell/assets-tracker-app.git
cd assets-tracker-app

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Update .env with your DB credentials, then:
php artisan migrate

# (Optional) Create admin user for Filament
php artisan make:filament-user