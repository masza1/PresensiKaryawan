# Informasi
Website payroll pegawai sederhana, untuk belajar.

# Cara Instalasi Project
1. Download project
- [https://github.com/chappie-chap/PresensiKaryawan/archive/refs/heads/master.zip](https://github.com/chappie-chap/PresensiKaryawan/archive/refs/heads/master.zip)
2. Setting File .env
- Copy file .env.example dan ubah namanya menjadi .env.
- Setting Database dan sesuaikan punya anda. 

3. buka CMD dan ubah direktori sesuai tempat folder Anda menyimpan
- ketik `composer install` enter
- ketik `php artisan key:generate`

4. Migrate Database
- Anda juga bisa melakukan `php artisan migrate --seed`

# Cara penggunaan
- lakukan `php artisan serve`
## Akun Login
**Staff**
- Email : `staff@gmail.com`
- Password : `password`

**Supervisor**
- Email : `supervisor@gmail.com`
- Password : `password`

# API Absensi
Untuk melihat data pegawai yang melakukan absen
- ketik pada browser `localhost:8000/api/attendances`