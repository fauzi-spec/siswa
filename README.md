# Siswa Nilai — Pendataan Siswa & Nilai (Laravel)

Aplikasi web sederhana untuk CRUD data siswa dan nilai, dibangun dengan **Laravel 12**.

## Fitur

- Dashboard ringkas (jumlah siswa & nilai)
- CRUD siswa (NIS, nama, jenis kelamin, kelas, tanggal lahir, alamat)
- CRUD nilai per siswa, mata pelajaran, dan semester
- Pencarian di halaman siswa dan nilai
- Detail siswa + rata-rata nilai

## Persyaratan lokal

- PHP 8.2+
- Composer
- MySQL (mis. XAMPP) **atau** SQLite

## Menjalankan di komputer (MySQL)

1. Buat database di MySQL:

```sql
CREATE DATABASE siswa_nilai CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Salin environment dan sesuaikan:

```bash
cp .env.example .env
php artisan key:generate
```

Pastikan di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siswa_nilai
DB_USERNAME=root
DB_PASSWORD=
```

3. Migrasi dan jalankan server:

```bash
composer install
php artisan migrate
php artisan serve
```

Buka http://127.0.0.1:8000

## Database production: Supabase

**Supabase menyediakan PostgreSQL**, bukan MySQL. Skema migrasi Laravel di proyek ini kompatibel dengan MySQL (lokal) dan PostgreSQL (Supabase).

1. Buat proyek di [Supabase](https://supabase.com).
2. Di **Project Settings → Database**, salin connection string (**URI**, mode **Session** untuk migrasi).
3. Jalankan migrasi dari komputer (arahkan ke Supabase):

```env
DB_CONNECTION=pgsql
DB_HOST=db.<project-ref>.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=<password-proyek>
DB_SSLMODE=require
```

```bash
php artisan migrate
```

Untuk aplikasi di Vercel, gunakan kredensial yang sama di Environment Variables (atau `DATABASE_URL` jika memakai connection string penuh).

## Deploy ke Vercel

Laravel di Vercel berjalan sebagai **PHP serverless** (`vercel-php`) lewat `api/index.php`. File penting: `vercel.json`, `api/index.php`, `package.json`.

### Langkah

1. Push proyek ke GitHub (folder root repo = folder `siswa-nilai` atau sesuaikan root di Vercel).
2. Import repo di [Vercel](https://vercel.com).
3. Set **Environment Variables** (Production):

| Variabel | Contoh |
|----------|--------|
| `APP_KEY` | `php artisan key:generate --show` |
| `APP_NAME` | Siswa Nilai |
| `APP_ENV` | production |
| `APP_DEBUG` | false |
| `APP_URL` | https://nama-proyek.vercel.app |
| `DB_CONNECTION` | pgsql |
| `DB_HOST` | db.xxx.supabase.co |
| `DB_PORT` | 5432 |
| `DB_DATABASE` | postgres |
| `DB_USERNAME` | postgres |
| `DB_PASSWORD` | (dari Supabase) |
| `DB_SSLMODE` | require |
| `SESSION_DRIVER` | cookie |
| `CACHE_STORE` | array |
| `LOG_CHANNEL` | stderr |
| `VIEW_COMPILED_PATH` | /tmp |

Opsional (cache config di `/tmp` untuk serverless):

```env
APP_CONFIG_CACHE=/tmp/config.php
APP_ROUTES_CACHE=/tmp/routes.php
APP_EVENTS_CACHE=/tmp/events.php
APP_PACKAGES_CACHE=/tmp/packages.php
APP_SERVICES_CACHE=/tmp/services.php
```

4. Deploy (`vercel --prod` atau push ke branch utama).

5. Pastikan migrasi sudah dijalankan ke Supabase **sebelum** testing production.

### Catatan arsitektur

- **Lokal**: MySQL sesuai permintaan pelatihan.
- **Cloud**: Vercel (hosting PHP) + Supabase (PostgreSQL). Ini kombinasi umum karena Vercel tidak men-host MySQL managed, dan Supabase fokus pada Postgres.
- Queue/worker Laravel tidak berjalan di background di Vercel; aplikasi ini tidak memakai queue.

## Struktur singkat

- `app/Models/Siswa.php`, `Nilai.php`
- `app/Http/Controllers/*`
- `database/migrations/*_create_siswas_table.php`, `*_create_nilais_table.php`
- `resources/views/` — Blade + CSS sederhana (tanpa build Vite wajib)

## Push ke GitHub (untuk import Vercel)

Repositori Git lokal sudah siap (`main`, commit awal). File `.env` tidak ikut di-commit.

1. Login GitHub CLI (sekali saja):

```bash
brew install gh   # jika belum ada
gh auth login
```

2. Buat repo di GitHub dan push dari folder proyek:

```bash
cd /Volumes/PROJECT/PELATIHAN/HALTIM/siswa-nilai
gh repo create siswa-nilai --public --source=. --remote=origin --push
```

Ganti `siswa-nilai` jika nama repo sudah dipakai (mis. `siswa-nilai-haltim`).

3. Di [Vercel](https://vercel.com) → **Add New Project** → import repo GitHub tersebut → root directory `.` → deploy.

Alternatif tanpa `gh`: buat repo kosong di github.com, lalu:

```bash
git remote add origin git@github.com:USERNAME/siswa-nilai.git
git push -u origin main
```

## Lisensi

Proyek pelatihan — bebas dimodifikasi.
