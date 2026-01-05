use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/chat', [DashboardController::class, 'chat'])->name('chat');
Route::get('/tasks', [DashboardController::class, 'taskBoard'])->name('tasks.board');
Route::get('/timeline', [DashboardController::class, 'timeline'])->name('timeline');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
