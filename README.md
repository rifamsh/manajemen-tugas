# 📌 Task Manager Web Application

Aplikasi **Task Manager berbasis Web** yang digunakan untuk mengelola **project, task, anggota tim, komentar, dan file** dalam satu sistem terintegrasi.  
Project ini dikembangkan sebagai **tugas mata kuliah Pemrograman Berbasis Web**.

---

## 👥 Tim Pengembang

| Nama           | Peran                  |
| -------------- | ---------------------- |
| (Maulana Arif) | Leader Project / Model |
| (Rhista)       | view                   |
| (Dika)         | View                   |
| (Hilma)        | Controller             |
| (Rizky)        | Controller             |
| (Zilmie)       | Model                  |

---

## 🎯 Tujuan Aplikasi

-   Mengelola project secara terstruktur
-   Membagi tugas (task) kepada anggota tim
-   Memantau status pekerjaan (To Do, In Progress, Done)
-   Menyediakan kolaborasi melalui komentar
-   Menyimpan file pendukung project

---

## 🚀 Fitur Utama

-   🔐 Authentication (Login & Register)
-   📁 Manajemen Project
-   📝 Manajemen Task
-   👥 Project Team (Leader & Member)
-   💬 Comment pada Task
-   📎 Upload File
-   📊 Status Task (To Do, Process, Done)

---

## 🧩 Teknologi yang Digunakan

-   **Framework**: Laravel 11
-   **Bahasa Pemrograman**: PHP
-   **Database**: MySQL
-   **Frontend**: Blade Template
-   **Version Control**: Git & GitHub

---

## 🗂️ Struktur Database (ERD)

Relasi database dirancang menggunakan **Entity Relationship Diagram (ERD)** dengan tabel utama:

-   users
-   projects
-   project_teams
-   tasks
-   comments
-   files

Relasi utama:

-   User dapat memiliki banyak Project
-   Project memiliki banyak Task
-   Task dapat memiliki banyak Comment dan File
-   Project memiliki banyak anggota (many-to-many)

---

## 📂 Struktur Folder Penting

```text
app/
├── Models/
│   ├── User.php
│   ├── Project.php
│   ├── ProjectTeam.php
│   ├── Task.php
│   ├── Comment.php
│   └── File.php
│
└── Http/
    └── Controllers/
        ├── ProjectController.php
        ├── TaskController.php
        └── CommentController.php
```
