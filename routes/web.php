use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/chat', [DashboardController::class, 'chat'])->name('chat');
Route::get('/tasks', [DashboardController::class, 'taskBoard'])->name('tasks.board');
Route::get('/timeline', [DashboardController::class, 'timeline'])->name('timeline');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ================= AUTH =================

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// ================= PROTECTED ROUTES =================

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks.index');

    Route::get('/tasks/{id}', function ($id) {
        return view('tasks.show', compact('id'));
    })->name('tasks.show');

    Route::get('/calendar', function () {
        return view('tasks.calendar');
    })->name('calendar');

    Route::get('/groups/create', function () {
        return view('groups.create');
    })->name('groups.create');

    Route::get('/files', fn () => 'File Manager')->name('files');
    Route::get('/profile', fn () => 'Profile')->name('profile');

    Route::get('/chat', function () {
        return view('chat'); // File: resources/views/chat.blade.php
    })->name('chat.index');

    Route::get('/timeline', function () {
        return view('timeline'); // File: resources/views/timeline.blade.php
    })->name('timeline.index');

    Route::get('/reports', function () {
        return view('reports'); // File: resources/views/reports.blade.php
    })->name('reports.index');

    // Group Detail
    Route::get('/groups/{id}', function ($id) {
        return view('groups.show'); // File: resources/views/groups/show.blade.php
    })->name('groups.show');

    // Profile
    Route::get('/profile', function () {
        return view('profile'); // File: resources/views/profile.blade.php
    })->name('profile.index');

    // File Manager
    Route::get('/files', function () {
        return view('files'); // File: resources/views/files.blade.php
    })->name('files.index');

});
