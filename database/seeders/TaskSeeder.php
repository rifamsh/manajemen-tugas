<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $today = Carbon::now()->toDateString();

        // Safely clear tasks (disable foreign key checks briefly)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Task::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ensure a project exists to satisfy the foreign key
        $project = \App\Models\Project::first();
        if (! $project) {
            $project = \App\Models\Project::create([
                'user_id' => 1,
                'name' => 'Sample Project',
                'description' => 'Auto-created project for demo',
                'category' => 'Design',
                'deadline' => $today,
                'progress' => 10,
                'status' => 'active',
            ]);
        }

        Task::create([
            'project_id' => $project->id,
            'title' => 'UI Design Review',
            'description' => 'Review wireframe with team',
            'deadline' => $today,
            'due_time' => '09:00:00',
            'priority' => 'Medium',
            'status' => 'todo',
            'user_id' => 1,
        ]);

        Task::create([
            'project_id' => $project->id,
            'title' => 'Database Config',
            'description' => 'Setup MySQL for project',
            'deadline' => $today,
            'due_time' => '12:00:00',
            'priority' => 'Low',
            'status' => 'todo',
            'user_id' => 1,
        ]);
    }
}
