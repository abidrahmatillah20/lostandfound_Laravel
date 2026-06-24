 Lost and Found System (Laravel)
     Nama: M Abid Rahmatillah
     NPM: 2408107010090
     Mata Kuliah: Pemrograman Berbasis Web
 
 Deskripsi Proyek

Lost and Found System adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk membantu pengguna melaporkan dan mencari barang hilang maupun barang temuan di lingkungan tertentu (kampus/umum)

Sistem ini memungkinkan pengguna untuk:

Melaporkan barang hilang
Melaporkan barang temuan
Melihat daftar barang
Mengelola data barang (admin)
Autentikasi pengguna (login & register)

  Tujuan Sistem
Mempermudah proses pelaporan barang hilang dan ditemukan
Meningkatkan efisiensi pencarian barang
Menyediakan sistem terpusat untuk manajemen data barang
Mengimplementasikan konsep CRUD dan autentikasi dalam Laravel

 Teknologi yang Digunakan
Laravel (PHP Framework)
MySQL / MariaDB
Blade Template Engine
Tailwind CSS
Vite
Node.js & NPM
 
  Fitur Aplikasi
  User
Registrasi & Login
Melihat daftar barang hilang/temuan
Melihat detail barang
Menambahkan laporan barang

  Admin
Dashboard admin
Manajemen data barang
Manajemen kategori
Monitoring laporan user

 Struktur Fitur Utama
Authentication (Login, Register, Logout)
CRUD Items (Barang Hilang & Temuan)
CRUD Categories
Role-based access (Admin & User)
Public landing page
 
  Cara Menjalankan Project
1. Clone Repository
git clone https://github.com/abidrahmatillah20/lostandfound_Laravel.git
2. Masuk Folder Project
cd lostandfound_Laravel
3. Install Dependency PHP
composer install
4. Install Dependency Frontend
npm install
npm run dev
5. Setup Environment
cp .env.example .env

Lalu sesuaikan konfigurasi database:

DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
6. Generate Key
php artisan key:generate
7. Migrasi Database
php artisan migrate
8. Jalankan Server
php artisan serve

Akses di:

http://127.0.0.1:8000
  Database

Database menggunakan migration Laravel:

users
categories
items
cache & jobs (default Laravel)
  Role Sistem
Role	Akses
User	Melihat & membuat laporan barang
Admin	Mengelola semua data sistem
  Preview Aplikasi

(Tambahkan screenshot aplikasi di sini jika diperlukan untuk nilai lebih tinggi)

  Demo Video

Link video demo:

(isi link Google Drive / YouTube kamu di sini)
📌 Catatan

Project ini dibuat sebagai tugas UAS Pemrograman Berbasis Web dengan implementasi full-stack menggunakan Laravel


Terima kasih telah menggunakan aplikasi ini
Semoga sistem ini dapat membantu dalam pengelolaan barang hilang dan ditemukan secara lebih efektif dan efisien
