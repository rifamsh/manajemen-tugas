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
            $todayTasks = Task::whereDate('deadline', $today)->orderBy('due_time')->get();
            $view->with('todayTasks', $todayTasks);
        });
    }
}
