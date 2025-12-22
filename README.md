Sistem Manajemen Tugas Kelompok (Laravel)

Dokumen ini berisi **aturan dan panduan wajib** untuk seluruh anggota tim agar repository aman dan tidak terjadi konflik kode.

---

## 🧠 Prinsip Utama (WAJIB DIPATUHI)

-   ❌ DILARANG push ke branch `main`
-   ❌ DILARANG push ke branch `develop`
-   ❌ DILARANG merge Pull Request sendiri
-   ✅ Setiap anggota WAJIB kerja di branch masing-masing
-   ✅ Merge hanya dilakukan oleh **Leader**

Jika ragu atau terjadi error → **STOP dan hubungi Leader**

---

## 🧰 Tools Wajib

-   Git
-   VS Code
-   Akun GitHub (sudah di-invite & accept sebagai collaborator)

Tools opsional (sesuai tugas):

-   Laragon (backend Laravel)
-   Node.js & NPM (frontend)

---

## 🌿 Aturan Branch

Format branch anggota:
feature/nama-fitur

yaml
Copy code

Contoh:

-   `feature/project-management`
-   `feature/task-crud`
-   `feature/task-status`
-   `feature/task-comments`
-   `feature/ui-docs`

❌ Jangan membuat branch selain format di atas

---

## 👥 Alur Kerja Anggota (STEP BY STEP)

### 1️⃣ Clone Repository (CUMA SEKALI)

```bash
git clone https://github.com/USERNAME/task-manager-uas.git
cd task-manager-uas
2️⃣ Pindah ke Develop
bash
Copy code
git checkout develop
git pull origin develop
3️⃣ Buat Branch Sendiri
bash
Copy code
git checkout -b feature/nama-fitur
Branch ini digunakan terus, jangan buat ulang setiap hari.

4️⃣ Kerjakan Tugas
Fokus hanya pada bagian masing-masing

Jangan mengedit file di luar tugas

Jangan menyentuh file .env

5️⃣ Commit Perubahan
bash
Copy code
git status
git add .
git commit -m "Deskripsi singkat perubahan"
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

Tunggu review Leader

🚫 Jangan merge sendiri

🗂️ Peta File Laravel (ANTI NYASAR)
Folder utama yang boleh disentuh:
swift
Copy code
app/Models/
app/Http/Controllers/
database/migrations/
resources/views/
routes/web.php
Folder yang DILARANG disentuh:
arduino
Copy code
.env
vendor/
storage/
config/
🧑‍💻 Pembagian Tugas & File
👤 Anggota 1 — Manajemen Proyek
database/migrations/*_create_projects_table.php

app/Models/Project.php

app/Http/Controllers/ProjectController.php

resources/views/projects/*

routes/web.php (route project)

👤 Anggota 2 — Manajemen Tugas
database/migrations/*_create_tasks_table.php

app/Models/Task.php

app/Http/Controllers/TaskController.php

resources/views/tasks/*

routes/web.php (route task)

👤 Anggota 3 — Status Tugas
database/migrations/*_add_status_to_tasks_table.php

app/Models/Task.php (logic status)

app/Http/Controllers/TaskController.php (update status)

resources/views/tasks/index.blade.php

👤 Anggota 4 — Komentar Pengguna
database/migrations/*_create_comments_table.php

app/Models/Comment.php

app/Http/Controllers/CommentController.php

resources/views/tasks/show.blade.php

Relasi di Task.php & User.php

👤 Anggota 5 — UI & Dokumentasi
resources/views/layouts/app.blade.php

resources/views/*

resources/css/

resources/js/

README.md

❌ Tidak mengubah controller, model, migration

🔒 Keamanan Repository
Branch main dan develop dilindungi dengan Branch Protection Rules

Semua perubahan masuk melalui Pull Request

Leader bertanggung jawab atas merge dan integrasi

```
