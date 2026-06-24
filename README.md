Lost and Found System (Laravel)

Nama: M Abid Rahmatillah
NPM: 2408107010090
Mata Kuliah: Pemrograman Berbasis Web

Deskripsi Proyek

Lost and Found System adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk membantu pengguna melaporkan dan mencari barang hilang maupun barang temuan di lingkungan tertentu (kampus atau umum).

Sistem ini memungkinkan pengguna untuk:

Melaporkan barang hilang
Melaporkan barang temuan
Melihat daftar barang
Mengelola data barang (admin)
Autentikasi pengguna (login dan register)
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
Node.js dan NPM
Fitur Aplikasi
User
Registrasi dan Login
Melihat daftar barang hilang dan temuan
Melihat detail barang
Menambahkan laporan barang
Admin
Dashboard admin
Manajemen data barang
Manajemen kategori
Monitoring laporan user
Struktur Fitur Utama
Authentication (Login, Register, Logout)
CRUD Items (Barang Hilang dan Temuan)
CRUD Categories
Role-based access (Admin dan User)
Public landing page
Cara Menjalankan Project
Clone Repository
git clone https://github.com/abidrahmatillah20/lostandfound_Laravel.git
Masuk Folder Project
cd lostandfound_Laravel
Install Dependency PHP
composer install
Install Dependency Frontend
npm install
npm run dev
Setup Environment
cp .env.example .env

Atur konfigurasi database pada file .env:

DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
Generate Key
php artisan key:generate
Migrasi Database
php artisan migrate
Jalankan Server
php artisan serve

Akses aplikasi:

http://127.0.0.1:8000
Database

Database menggunakan migration Laravel, meliputi:

users
categories
items
cache dan jobs (default Laravel)
Role Sistem
Role	Akses
User	Melihat dan membuat laporan barang
Admin	Mengelola seluruh data sistem
Preview Aplikasi

(Tambahkan screenshot aplikasi di sini jika diperlukan)

Demo Video

Link video demo:
(isi link Google Drive atau YouTube di sini)

Catatan

Project ini dibuat sebagai tugas UAS Pemrograman Berbasis Web dengan implementasi full-stack menggunakan Laravel.

Penutup

Terima kasih telah menggunakan aplikasi ini.
Semoga sistem ini dapat membantu dalam pengelolaan barang hilang dan ditemukan secara lebih efektif dan efisien.
