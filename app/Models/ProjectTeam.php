<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    use HasFactory;

    protected $table = 'project_teams'; // Pastikan nama tabel benar

    protected $fillable = [
        'project_id',
        'user_id',
        'role' // member/leader
    ];
}
