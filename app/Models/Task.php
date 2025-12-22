<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    const STATUS_TODO = 'todo';
    const STATUS_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';

    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'description',
        'deadline',
        'status'
    ];

    public static function statuses()
    {
        return [
            self::STATUS_TODO,
            self::STATUS_PROGRESS,
            self::STATUS_DONE,
        ];
    }
}
