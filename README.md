👥 PANDUAN ANGGOTA TIM
Sistem Manajemen Tugas Kelompok (Laravel)

📌 BACA DARI ATAS KE BAWAH – JANGAN LOMPAT

🧠 HAL PENTING YANG HARUS DIPAHAMI DULU

Project ini dikerjakan bareng

Kode TIDAK BOLEH dikerjakan di branch main / develop

Setiap orang punya branch sendiri

Merge hanya dilakukan oleh leader

Kalau ragu → STOP & tanya leader

🧰 PERSIAPAN WAJIB (SEBELUM NGODING)
1️⃣ Install tools ini

WAJIB:

Git

VS Code

OPSIONAL (tergantung tugas):

Laragon (kalau backend Laravel)

Node.js (kalau frontend)

2️⃣ Pastikan kamu SUDAH:

Punya akun GitHub

Sudah di-invite sebagai collaborator

Sudah klik Accept Invite

Kalau belum accept → TIDAK BISA PUSH

📥 LANGKAH 1 — CLONE PROJECT (CUMA SEKALI)

Buka terminal / Git Bash:

git clone https://github.com/USERNAME/task-manager-uas.git
cd task-manager-uas

📌 Ini hanya dilakukan SATU KALI di awal

🌿 LANGKAH 2 — PINDAH KE BRANCH DEVELOP
git checkout develop
git pull origin develop

📌 Jangan kerja di main

🌱 LANGKAH 3 — BUAT BRANCH SENDIRI (WAJIB)

Nama branch harus sesuai tugas kamu.

git checkout -b feature/nama-fitur

Contoh:

git checkout -b feature/task-crud

📌 Branch ini dipakai terus, jangan buat ulang setiap hari

💻 LANGKAH 4 — KERJAKAN TUGAS KAMU

Edit file sesuai tugas

Jangan edit file yang bukan bagianmu

Jangan sentuh .env

Jangan hapus kode orang lain

📦 LANGKAH 5 — SIMPAN PERUBAHAN (COMMIT)

Cek dulu:

git status

Lalu:

git add .
git commit -m "Tambah fitur task CRUD"

📌 Pesan commit harus jelas

📤 LANGKAH 6 — PUSH KE GITHUB
git push origin feature/nama-fitur

Contoh:

git push origin feature/task-crud

✅ Push HANYA ke branch sendiri

🔁 LANGKAH 7 — BUAT PULL REQUEST

Buka GitHub

Akan muncul tombol Compare & Pull Request

Base branch → develop

Klik Create Pull Request

Selesai

🚫 JANGAN MERGE SENDIRI

🛑 ATURAN KERAS (WAJIB DITAATI)

❌ Jangan push ke main
❌ Jangan push ke develop
❌ Jangan merge PR
❌ Jangan edit .env
❌ Jangan panik kalau error

✅ Kerja di branch sendiri
✅ Tanya leader kalau bingung

🚨 KALAU ADA ERROR / BINGUNG

HENTIKAN dulu dan kirim pesan ke leader:

“Aku error pas push / branch, aku stop dulu.”

🧠 RINGKASAN SUPER SINGKAT (HAFALIN)
git clone
git checkout develop
git checkout -b feature/nama
kerja
git add .
git commit -m "pesan"
git push origin feature/nama
