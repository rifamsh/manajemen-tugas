<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // 1. Kolom yang boleh diisi
    protected $fillable = [
        'user_id',     // Leader/Pembuat Project
        'name',
        'description',
        'category',    // Design, Dev, Marketing
        'deadline',
        'progress',    // Angka 0-100
        'status'       // active, completed
    ];

    // 2. Casting: Agar 'deadline' otomatis dianggap Tanggal (objek Carbon)
    // Ini penting biar di View bisa pakai format('d F') -> "20 March"
    protected $casts = [
        'deadline' => 'date',
    ];

    // --- RELASI ---

    // A. Project punya banyak Member (Untuk menampilkan avatar "+3" di dashboard)
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_teams', 'project_id', 'user_id')
            ->withPivot('role');
    }

    // B. Project punya banyak Task (Tugas-tugas di dalamnya)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // D. Project punya banyak File (melalui Task)
    public function files()
    {
        return $this->hasManyThrough(File::class, Task::class);
    }

    // C. Project dibuat oleh satu Leader (User)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // E. Project punya banyak Comment (Chat di dalamnya)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
