👑 TUGAS 1 — LEADER + AUTH & INTEGRASI

(KAMU, TETAP IKUT NGODING)

Fokus

Setup Laravel

Auth (login/register)

Integrasi semua fitur

Merge PR

FILE YANG BOLEH DISENTUH
app/Models/User.php
database/migrations/_users_
resources/views/auth/
resources/views/layouts/app.blade.php
README.md
CONTRIBUTING.md

❌ TIDAK menyentuh:

ProjectController
TaskController
CommentController

🌿 Branch:

feature/auth-setup

👤 TUGAS 2 — PROJECT (CRUD)

AMAN karena berdiri sendiri

FILE
app/Models/Project.php
app/Http/Controllers/ProjectController.php
database/migrations/_projects_
resources/views/projects/

🌿 Branch:

feature/project

🚫 Tidak menyentuh task / comment

👤 TUGAS 3 — TASK (CRUD + DEADLINE)
FILE
app/Models/Task.php
app/Http/Controllers/TaskController.php
database/migrations/_tasks_
resources/views/tasks/

🌿 Branch:

feature/task

🚫 Tidak menyentuh project & comment

👤 TUGAS 4 — STATUS TUGAS

Hanya EXTEND task, bukan rewrite

FILE (SANGAT TERBATAS)
database/migrations/_add_status_
resources/views/tasks/index.blade.php

⚠️ HANYA TAMBAH, bukan hapus logic task

🌿 Branch:

feature/task-status

👤 TUGAS 5 — KOMENTAR

Berdiri sendiri

FILE
app/Models/Comment.php
app/Http/Controllers/CommentController.php
database/migrations/_comments_
resources/views/tasks/show.blade.php

🌿 Branch:

feature/comment

🚫 Tidak menyentuh TaskController utama

👤 TUGAS 6 — UI & LAYOUT

PALING AMAN karena frontend-only

FILE
resources/views/layouts/
resources/views/components/
resources/css/
resources/js/

🌿 Branch:

feature/ui

🚫 Tidak menyentuh logic backend

🧠 KUNCI AGAR GIT KELIHATAN RAPI
✅ Aturan File Emas
File Siapa
routes/web.php LEADER
.env TIDAK ADA
User.php LEADER
Controller lain MASING-MASING
🔁 ALUR KERJA SEMUA ANGGOTA (TERMASUK LEADER)
git checkout develop
git pull origin develop
git checkout -b feature/nama-fitur

Kerja ➜ commit ➜ push ➜ PR ➜ leader merge

🧾 CONTOH COMMIT MESSAGE (BIAR RAPI)

✅ BENAR:

Add project CRUD
Add task deadline field
Add comment feature
Update task status badge

❌ SALAH:

fix
update
coba-coba
