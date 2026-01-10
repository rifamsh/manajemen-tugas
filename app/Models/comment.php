<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'project_id',
        'comment_text',
    ];

    // Komentar milik Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Komentar ditulis oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Perbaikan Model Comment
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
