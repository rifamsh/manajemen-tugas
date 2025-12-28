<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the notes for the user.
     */

    /**
     * Get the calendar events for the user.
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function projectMembers()
    {
        return $this->belongsToMany(Project::class, 'project_teams', 'user_id', 'project_id');
    }
    public function projectTeams()
    {
        return $this->hasMany(ProjectTeam::class);
    }
}
