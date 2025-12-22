# 📌 Sistem Manajemen Tugas Kelompok

Project UAS – Laravel  
Jumlah Anggota: 6 Orang

---

## 🎯 Deskripsi Project

Aplikasi web berbasis Laravel untuk manajemen tugas kelompok dengan fitur:

-   Manajemen Proyek
-   Manajemen Tugas
-   Deadline tugas
-   Status tugas (To Do, Proses, Selesai)
-   Komentar antar pengguna
-   Sistem kerja kolaboratif menggunakan GitHub

---

## 🧠 Aturan Utama (WAJIB DIBACA)

❌ DILARANG push ke branch `main`  
❌ DILARANG push ke branch `develop`  
❌ DILARANG merge Pull Request sendiri

✅ Setiap anggota WAJIB kerja di branch masing-masing  
✅ Merge hanya dilakukan oleh **Leader**

Jika ragu atau error → **STOP dan hubungi Leader**

---

## 🧰 Tools yang Digunakan

WAJIB:

-   Git
-   VS Code
-   Akun GitHub

OPSIONAL (sesuai tugas):

-   Laragon (untuk backend Laravel)
-   Node.js & NPM (untuk frontend)

---

## 👥 Alur Kerja Anggota (STEP BY STEP)

### 1️⃣ Clone Repository (CUMA SEKALI)

```bash
git clone https://github.com/USERNAME/task-manager-uas.git
cd task-manager-uas
2️⃣ Pindah ke Branch Develop
bash
Copy code
git checkout develop
git pull origin develop
3️⃣ Buat Branch Sendiri (WAJIB)
Gunakan format:

bash
Copy code
feature/nama-fitur
Contoh:

bash
Copy code
git checkout -b feature/task-crud
📌 Branch ini digunakan terus, jangan buat ulang setiap hari

4️⃣ Kerjakan Tugas
Edit file sesuai bagian masing-masing

Jangan edit .env

Jangan menghapus kode anggota lain

5️⃣ Commit Perubahan
bash
Copy code
git status
git add .
git commit -m "Tambah fitur task CRUD"
Gunakan pesan commit yang jelas.

6️⃣ Push ke Branch Sendiri
bash
Copy code
git push origin feature/nama-fitur
❌ Jangan push ke main atau develop

7️⃣ Buat Pull Request
Buka GitHub repository

Klik Compare & Pull Request

Base branch: develop

Klik Create Pull Request

Tunggu review dari Leader

🚫 Jangan merge sendiri

🔒 Keamanan Branch
Branch main dan develop dilindungi menggunakan Branch Protection Rules:

Anggota tidak bisa push langsung

Anggota tidak bisa merge

Semua perubahan masuk melalui Pull Request

🧪 Testing
Project ini menggunakan PHPUnit sebagai framework testing bawaan Laravel.

⚠️ Catatan Penting
File .env TIDAK BOLEH di-push

Konfigurasi database dilakukan masing-masing di lokal

Gunakan .env.example sebagai template

🗣️ Jika Terjadi Error
Hentikan pekerjaan dan hubungi Leader dengan format:

“Saya error di bagian (sebutkan), saya stop dulu.”
```
