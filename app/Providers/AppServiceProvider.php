<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Task;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share today's tasks with the sidebar layout
        View::composer('layouts.app', function ($view) {
            $today = Carbon::now()->toDateString();
            $nextWeek = Carbon::now()->addDays(7)->toDateString();

            // Get tasks for today, or upcoming tasks if none today
            $todayTasks = Task::whereDate('deadline', $today)
                ->where('user_id', auth()->id())
                ->orderBy('due_time')
                ->get();

            // If no tasks today, show upcoming tasks
            if ($todayTasks->isEmpty()) {
                $todayTasks = Task::whereBetween('deadline', [$today, $nextWeek])
                    ->where('user_id', auth()->id())
                    ->orderBy('deadline')
                    ->orderBy('due_time')
                    ->limit(3)
                    ->get();
            }

            $view->with('todayTasks', $todayTasks);
        });
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
