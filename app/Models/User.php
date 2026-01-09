<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'occupation', // Tambahan: Untuk tulisan "Mahasiswa"
        'avatar',     // Tambahan: Untuk foto profil
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELASI KHUSUS DASHBOARD ---

    // 1. User punya banyak Task (Widget: My Tasks & Schedule)
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // 2. User tergabung di banyak Project (Widget: Active Groups)
    // Relasi Many-to-Many lewat tabel pivot 'project_teams'
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_teams', 'user_id', 'project_id')
            ->withPivot('role');
    }
}
