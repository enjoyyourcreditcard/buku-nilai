<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        Guru::create([
            'nama' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}