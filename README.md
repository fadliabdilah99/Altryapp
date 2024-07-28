# Aplikasi Altry

Deskripsi singkat tentang apa yang dilakukan proyek Anda dan tujuannya.

## Daftar Isi

-   [Pendahuluan](#pendahuluan)
    -   [Prasyarat](#prasyarat)
    -   [Instalasi](#instalasi)
    -   [Menjalankan Aplikasi](#menjalankan-aplikasi)
-   [Penggunaan](#penggunaan)
-   [Fitur](#fitur)
-   [Konfigurasi](#konfigurasi)
-   [Kontak](#kontak)

## Pendahuluan

aplikasi ini saya buat sebagai latihan sebelum PKL(Praktek Kerja Lapngan) di Altry consulting di jakarta barat, aplikasi ini saya buat untuk memenuhi salah satu layanan altry yaitu penjualan dan penyewaan barang, pada aplikasi ini saya sudah memikirkannya cukup matang, mulai dari bagaimana jika ada user menyewa barang di hari yang sama, hingga user ingin melakukan refaund, saya menggunakan payment gateway untuk mempermudah user melakukan pembayaran dan juga twillo untuk mengirim notifikasi jika ada aktifitas seperti pembayaran, konfirmasi, hingga masa sewa habis.

### Prasyarat

-   PHP >= ^8.0
-   Composer
-   Git
-   twillo
-   midtrans

### fitur

-   payment gateway
-   management keuangan
-   notifikasi whatsapp
-   booking barang sewaan
-   auth prosess
-   record penjualan
-   3 role
    -   Admin(dapat mengakses semua halaman)
    -   Akuntan(dapat mengakses halaman keuangan dan history)
    -   Manager Barang(Dapat mengakses halaman produk kategori)
    -   CS(Dapat mengakses halaman user dan mail)
-   maintenece barang untuk menghentikan penjualan/penyewaan barang

### Instalasi



untuk FE dan BE disini saya menggunakan 100% laravel, dengan beberapa dukungan bootstrap, admin LTE, css native, jquery dan beberapa package pendukung


1.  Clone repositori:

    ```sh
    git clone https://github.com/fadliabdilah99/Altryapp.git
    ```

2.  Navigasi ke direktori proyek:

    ```sh
    cd repositori-anda
    ```

3.  Instal dependensi PHP:

    ```sh
    composer install
    ```

4.  Instal dependensi JavaScript:

    ```sh
    npm install
    ```

5.  Salin file `.env.example` menjadi `.env`:

    ```sh
    cp .env.example .env
    ```

6.  Generate kunci aplikasi:

    ```sh
    php artisan key:generate
    ```

7.  Atur konfigurasi database Anda di file `.env`.

8.  Jalankan migrasi dan seed database:

    ```sh
    php artisan migrate --seed
    ```

9.  instalasi twillo sdk

    ```sh
    composer require twilio/sdk
    ```

10. instalasi midtrans
    ```sh
    composer require midtrans/midtrans-php
    ```

### Menjalankan Aplikasi

Untuk memulai aplikasi, jalankan perintah berikut:

```sh
php artisan serve
```

### konfigurasi

terdapat beberapa konfigurasi yang perlu di isi di dalam env seperti

-   midtrans

```sh
MIDTRANS_CLIENTKEY=
MIDTRANS_SERVERKEY=
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZIED=true
MIDTRANS_IS_3DS=true
```

-twillo

```sh
# twillo
TWILIO_SID=
TWILIO_TOKEN=
```

jangan lupa sesuaikan zona waktu di env
