<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
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
}
