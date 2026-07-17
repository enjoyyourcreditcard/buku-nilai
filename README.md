# 📚 Buku Nilai Siswa

Aplikasi sederhana berbasis **Laravel 10** dan **PostgreSQL** untuk mengelola nilai siswa.

Project ini memiliki dua role:

- 👨‍🏫 Guru
- 👨‍🎓 Siswa

Guru dapat membuat mata pelajaran, mengimpor nilai melalui file Excel, melihat seluruh nilai siswa, serta mengubah nilai secara manual.

Siswa hanya dapat melihat seluruh nilai miliknya sendiri.

---

# ✨ Fitur

## Guru

- Login Guru
- Dashboard
- CRUD Mata Pelajaran
- Import Nilai dari Excel (.xlsx)
- Download Template Excel
- Validasi File Excel
- Buku Nilai
- Pencarian Siswa
- Pagination
- Edit Nilai Manual

## Siswa

- Login menggunakan Nama + Nomor SPMB
- Dashboard
- Melihat seluruh nilai

---

# 🛠️ Tech Stack

- Laravel 10
- PHP 8.3+
- PostgreSQL
- Bootstrap 5
- PhpSpreadsheet

---

# 📦 Instalasi

Clone repository

```bash
git clone https://github.com/USERNAME/NAMA_REPOSITORY.git
```

Masuk ke folder project

```bash
cd NAMA_REPOSITORY
```

Install dependency

```bash
composer install
```

Install dependency frontend

```bash
npm install
```

Copy file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

---

# ⚙️ Konfigurasi Database

Edit file **.env**

Contoh menggunakan PostgreSQL

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=db_buku_nilai
DB_USERNAME=postgres
DB_PASSWORD=password
```

---

# 🗄️ Migrasi Database

```bash
php artisan migrate
```

---

# 👨‍🏫 Membuat Akun Guru

Karena aplikasi tidak memiliki fitur registrasi guru, buat akun melalui Tinker.

```bash
php artisan tinker
```

Kemudian jalankan

```php
\App\Models\Guru::create([
    'nama' => 'admin',
    'password' => bcrypt('password')
]);
```

Login menggunakan

```
Nama     : admin
Password : password
```

---

# 🚀 Menjalankan Project

Backend

```bash
php artisan serve
```

Frontend

```bash
npm run dev
```