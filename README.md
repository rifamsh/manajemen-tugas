# 📌 Sistem Manajemen Tugas Kelompok

Project UAS – Laravel  
Kelompok (6 Orang)

## 📖 Deskripsi

Sistem Manajemen Tugas Kelompok adalah aplikasi berbasis web yang digunakan untuk mengelola pekerjaan dalam sebuah tim.  
Aplikasi ini dibangun menggunakan Laravel dan dikembangkan secara kolaboratif menggunakan GitHub.

### Fitur Utama:

-   Autentikasi pengguna (Login & Register)
-   Manajemen Proyek
-   Manajemen Tugas
-   Deadline tugas
-   Status tugas (To Do, In Progress, Done)
-   Komentar pada tugas

---

## 🧑‍🤝‍🧑 Aturan Kerja Tim (WAJIB DIBACA)

-   ❌ DILARANG push langsung ke branch `main`
-   ❌ DILARANG push langsung ke branch `develop`
-   ✅ SETIAP ORANG wajib pakai branch masing-masing
-   ✅ Semua penggabungan kode melalui Pull Request
-   ✅ Jika ada error / conflict → hubungi leader

---

## 🌿 Struktur Branch

main → versi final (pengumpulan UAS)
develop → branch kerja tim
feature/\* → branch masing-masing anggota

yaml
Copy code

---

## 🚀 Panduan Anggota Tim

### A. Langkah Awal (Dilakukan Sekali)

````bash
git clone https://github.com/USERNAME/task-manager-uas.git
cd task-manager-uas
git checkout develop
git pull origin develop
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
Buka browser:

cpp
Copy code
http://127.0.0.1:8000
B. Mulai Kerja (Setiap Hari)
Buat branch sesuai tugas:

bash
Copy code
git checkout -b feature/nama-fitur
Sebelum ngoding:

bash
Copy code
git checkout develop
git pull origin develop
git checkout feature/nama-fitur
git merge develop
C. Simpan & Kirim Hasil Kerja
bash
Copy code
git add .
git commit -m "Deskripsi perubahan"
git push origin feature/nama-fitur
D. Pull Request
Buka GitHub repository

Klik Compare & Pull Request

Base: develop

Compare: feature/nama-fitur

Submit dan tunggu leader merge

👥 Pembagian Tugas
Anggota	Tugas
1	Leader & Integrator
2	Auth & User
3	Proyek
4	Tugas
5	Komentar
6	UI / UX

⚠️ Catatan Penting
Jika terjadi conflict atau error Git:
👉 JANGAN merge sendiri, hubungi leader

yaml
Copy code

---

### 4️⃣ Ganti `USERNAME`
Ubah bagian ini:
https://github.com/USERNAME/task-manager-uas.git

yaml
Copy code
jadi username GitHub kamu.

---

### 5️⃣ Simpan, lalu commit
```bash
git add README.md
git commit -m "Add README workflow project"
git push origin develop
````
