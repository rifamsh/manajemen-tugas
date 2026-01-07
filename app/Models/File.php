<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    // File milik Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // File diupload oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
