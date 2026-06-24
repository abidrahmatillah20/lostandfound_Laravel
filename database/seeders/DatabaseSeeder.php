<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@lostandfound.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Buat akun user contoh
        User::create([
            'name'     => 'Mahasiswa Demo',
            'email'    => 'user@lostandfound.com',
            'password' => Hash::make('user123'),
            'role'     => 'user',
        ]);

        // Isi kategori
        $categories = [
            'Elektronik',
            'Buku & Alat Tulis',
            'Dompet & Kartu',
            'Kunci',
            'Tas & Ransel',
            'Aksesoris',
            'Pakaian',
            'Lainnya',
        ];

        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
