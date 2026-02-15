# 🌿 Si Cerdas

**Si Cerdas** adalah platform berbasis web yang dirancang sebagai
sahabat digital bagi ibu hamil dalam menjaga kesehatan dan mencegah
stunting sejak dini. Platform ini menyediakan informasi edukatif,
rekomendasi menu sehat, serta fitur interaktif untuk mendukung kesehatan
ibu dan pertumbuhan optimal janin.

------------------------------------------------------------------------

## 🎯 Tujuan Project

Project ini bertujuan untuk:

-   Meningkatkan literasi kesehatan ibu hamil\
-   Membantu pencegahan stunting sejak masa kehamilan\
-   Memberikan panduan nutrisi yang mudah dipahami\
-   Mendukung terciptanya generasi sehat dan cerdas

------------------------------------------------------------------------

## ✨ Fitur Utama

### 📚 Edukasi Kesehatan Ibu & Anak

-   Artikel informatif seputar kehamilan\
-   Informasi nutrisi dan pencegahan stunting\
-   Dukungan embed video YouTube\
-   Sistem kategori untuk navigasi terstruktur

### 🍲 Rekomendasi Menu Sehat

-   Resep bergizi untuk ibu hamil\
-   Informasi bahan-bahan\
-   Langkah pembuatan\
-   Informasi nutrisi\
-   Detail porsi dan durasi memasak

### 🤰 Kalkulator BMI Ibu Hamil

-   Menghitung Indeks Massa Tubuh (BMI)\
-   Memberikan rekomendasi kenaikan berat badan\
-   Interaktif menggunakan Alpine.js

------------------------------------------------------------------------

## 🏗️ Struktur Sistem

Relasi database utama:

-   Category → Education\
-   Category → Recipe\
-   Recipe → Ingredients\
-   Recipe → Steps\
-   Recipe → Nutritions

------------------------------------------------------------------------

## 💻 Teknologi yang Digunakan

-   Laravel\
-   Blade Template Engine\
-   Tailwind CSS\
-   Alpine.js\
-   MySQL\
-   YouTube Embed (iframe)

------------------------------------------------------------------------

## 🚀 Instalasi Project

### 1️⃣ Clone Repository

``` bash
git clone https://github.com/username/si-cerdas.git
cd si-cerdas
```

### 2️⃣ Install Dependency

``` bash
composer install
npm install
```

### 3️⃣ Setup Environment

``` bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Konfigurasi Database

Atur di file `.env`:

DB_DATABASE=si_cerdas\
DB_USERNAME=root\
DB_PASSWORD=

Lalu jalankan:

``` bash
php artisan migrate
```

### 5️⃣ Jalankan Server

``` bash
php artisan serve
npm run dev
```

Akses melalui:

http://127.0.0.1:8000

------------------------------------------------------------------------

## 🌱 Pengembangan Selanjutnya

-   Autentikasi pengguna\
-   Dashboard admin\
-   Bookmark artikel & resep\
-   Sistem komentar\
-   API untuk versi mobile\
-   Monitoring perkembangan kehamilan

------------------------------------------------------------------------

## 📜 Lisensi

Project ini dikembangkan untuk tujuan edukasi dan pengembangan sistem
informasi kesehatan.

------------------------------------------------------------------------

# 🌸 Si Cerdas

### Sahabat Ibu Hamil Menuju Generasi Sehat dan Bebas Stunting
