# Cooklyst - Who let them cook?
> Tugas Milestone 1 IF3110 Web-based Application Development - Monolithic PHP & Vanilla Web Application

## Panduan Pengerjaan (to be deleted)
* Lakukan beberapa commit dengan pesan yang bermakna, contoh: “add register form”, “fix logout bug”, jangan seperti “final”, “benerin dikit”, “fix bug”.
* Disarankan untuk tidak melakukan commit dengan perubahan yang besar karena akan mempengaruhi penilaian (contoh: hanya melakukan satu commit kemudian dikumpulkan).
* Commit dari setiap anggota tim akan mempengaruhi penilaian.
* Jadi, setiap anggota tim harus melakukan commit yang berpengaruh terhadap proses pembuatan aplikasi.
* Sebagai panduan bisa mengikuti [semantic commit](https://gist.github.com/joshbuchea/6f47e86d2510bce28f8e7f42ae84c716).

## cara jalanin dockernya (to be deleted)
1. Buat `.env` di root directory. Copy aja `.env.example` terus isi valuenya (jangan ada yang kosong).
2. Build image: `sh scripts/build-image.sh`
3. Compose: `docker compose up -d`
4. Kalo mau akses database: `docker exec -it tubes-1-wbd-mysql-1 mysql -u root -p`, terus masukin password root
5. Cara masukin command: `docker exec -it [tubes-1-wbd-mysql-1/tubes-1-wbd-web-1] [command]`
6. Matiin: `docker compose down`

## Daftar Isi (Auto Generated)
- [Cooklyst - Who let them cook?](#cooklyst---who-let-them-cook)
  - [Panduan Pengerjaan (to be deleted)](#panduan-pengerjaan-to-be-deleted)
  - [cara jalanin dockernya (to be deleted)](#cara-jalanin-dockernya-to-be-deleted)
  - [Daftar Isi (Auto Generated)](#daftar-isi-auto-generated)
  - [Deskripsi Aplikasi Web](#deskripsi-aplikasi-web)
  - [Daftar Requirement](#daftar-requirement)
  - [Cara Instalasi](#cara-instalasi)
  - [Cara Menjalankan Server](#cara-menjalankan-server)
  - [Screenshot Tampilan Aplikasi](#screenshot-tampilan-aplikasi)
    - [X](#x)
    - [Y](#y)
  - [Bonus: Google Lighthouse](#bonus-google-lighthouse)
    - [X](#x-1)
    - [Y](#y-1)
  - [Pembagian Tugas](#pembagian-tugas)
    - [Server Side](#server-side)
    - [Client Side](#client-side)
  - [Lampiran](#lampiran)
    - [Database Schema](#database-schema)

## Deskripsi Aplikasi Web


## Daftar Requirement
1. ...
2. ...

## Cara Instalasi
1. ...
2. ...

## Cara Menjalankan Server
1. ...
2. ...

## Screenshot Tampilan Aplikasi
(tidak perlu semua kasus, minimal 1 per halaman)
### X
![Halaman X](url)

### Y
![Halaman Y1](url)
![Halaman Y2](url)

## Bonus: Google Lighthouse
### X
![Halaman X](url)

### Y
![Halaman Y1](url)
![Halaman Y2](url)

## Pembagian Tugas
### Server Side
| Task                            | NIM                |
| ------------------------------- | ------------------ |
|                                 | 13521   , 13521    |
|                                 | 13521              |
|                                 | 13521              |

### Client Side
| Task                            | NIM                |
| ------------------------------- | ------------------ |
|                                 | 13521   , 13521    |
|                                 | 13521              |
|                                 | 13521              |

## Lampiran
### Database Schema
![Schema](url)
