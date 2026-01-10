# 🚀 CollaboTask - Collaboration & Task Management System

**CollaboTask** adalah platform manajemen proyek berbasis web yang memungkinkan tim untuk bekerja sama dalam satu wadah. Aplikasi ini dirancang untuk mempermudah pembagian tugas (Task Board), pemantauan progres proyek, dan pengelolaan anggota tim secara real-time.

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![Railway](https://img.shields.io/badge/Railway-000000?style=for-the-badge&logo=railway&logoColor=white)

---

## ✨ Fitur Utama

* **👥 Collaborative Workspace:** Pemilik proyek dapat mengundang anggota tim melalui email. Anggota yang bergabung dapat melihat dan mengelola tugas yang sama.
* **📊 Interactive Task Board:** Sistem Kanban untuk memantau tugas dengan status *To Do*, *In Progress*, dan *Done*.
* **📈 Project Progress Tracking:** Dashboard visual yang menampilkan statistik tugas selesai, tugas tertunda, dan persentase progres proyek.
* **👤 User Profile Management:** Fitur edit profil lengkap termasuk penggantian Avatar, informasi pekerjaan (Occupation), nomor telepon, dan lokasi.
* **📁 Project File Sharing:** Berbagi dokumen dan file aset langsung di dalam setiap proyek.
* **📅 Deadline Alerts:** Notifikasi visual untuk tugas yang mendekati atau telah melewati batas waktu (deadline).

---

## 🛠️ Persyaratan Sistem

* PHP >= 8.1
* Composer
* MySQL 
* Node.js & NPM (untuk aset frontend)

---

## ⚙️ Cara Instalasi (Lokal)

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/username/collabotask.git](https://github.com/username/collabotask.git)
    cd collabotask
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run dev
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Migration**
    Jalankan migrasi untuk membuat tabel-tabel yang dibutuhkan:
    ```bash
    php artisan migrate
    ```

5.  **Symbolic Link Storage** (Penting agar Avatar muncul)
    ```bash
    php artisan storage:link
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```

---

## ☁️ Catatan Deployment (Railway)

Project ini telah dioptimalkan untuk dideploy di **Railway**. 

---

## 📂 Struktur Database Utama

* `users`: Menyimpan data pengguna dan path avatar.
* `projects`: Menyimpan data proyek utama.
* `project_teams`: Tabel pivot untuk menghubungkan anggota tim dengan proyek.
* `tasks`: Menyimpan daftar tugas yang terhubung dengan `project_id`.

---

## 🤝 Kontribusi

Kontribusi selalu terbuka! Jika Anda ingin meningkatkan fitur atau melaporkan bug, silakan buat *Issue* atau kirimkan *Pull Request*.

---
## 👥 Anggota Kelompok

| NAMA | Peranan Tim |
| Maulana Arif | Project Leader & model |
| Rhista Gita | Lead View |
| Dika Putra | View |
| Hilma Aulia | Lead Controller |
| Rizky Pebriyanto | Model |
| Zillmie Pasca | Controller |
---
