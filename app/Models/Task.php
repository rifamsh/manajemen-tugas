<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'description',
        'priority',   // High, Medium, Low
        'status',     // todo, in_progress, done
        'deadline',   // Tanggal: 2023-01-01
        'due_time',   // Jam: 09:00:00
    ];

    // Agar deadline otomatis jadi objek tanggal (bisa diformat)
    protected $casts = [
        'deadline' => 'date',
    ];

    // --- RELASI ---

    // Task milik satu Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Task dikerjakan oleh satu User
    public function assignee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Files yang terkait dengan Task (attachments)
    public function files()
    {
        return $this->hasMany(File::class);
    }

    // --- HELPER (Untuk Tampilan Dashboard) ---

    // 1. Warna Badge Prioritas
    // Cara panggil di view: $task->priority_color
    public function getPriorityColorAttribute()
    {
        return match ($this->priority) {
            'High' => 'danger',    // Merah
            'Medium' => 'warning', // Kuning/Oranye
            'Low' => 'info',       // Biru Muda
            default => 'secondary',
        };
    }

    // 2. Hitung Sisa Hari (Countdown)
    // Cara panggil di view: $task->days_left
    public function getDaysLeftAttribute()
    {
        if (!$this->deadline) return '-';

        $days = Carbon::now()->diffInDays($this->deadline, false);

        if ($days < 0) return "Overdue";
        if ($days == 0) return "Today";
        return abs($days) . " Days left";
    }
}
