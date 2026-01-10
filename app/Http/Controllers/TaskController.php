<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        // 1. Ambil semua ID project di mana user ini adalah Owner ATAU Member
        $projectIds = Project::where('user_id', auth()->id())
            ->orWhereHas('members', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->pluck('id');

        // 2. Ambil task yang project_id-nya ada di daftar tadi
        $tasks = Task::whereIn('project_id', $projectIds)
            ->get()
            ->groupBy('status');

        // 3. Project dropdown juga harus muncul untuk member
        $projects = Project::whereIn('id', $projectIds)->get();

        return view('tasks.index', compact('tasks', 'projects'));
    }
    public function create(Request $request)
    {
        // Ambil project di mana user adalah owner ATAU member
        $projects = Project::where('user_id', auth()->id())
            ->orWhereHas('members', function ($q) {
                $q->where('user_id', auth()->id());
            })->get();

        $selectedProject = null;
        if ($request->has('project_id')) {
            $selectedProject = Project::whereIn('id', $projects->pluck('id'))
                ->find($request->project_id);
        }

        return view('tasks.create', compact('projects', 'selectedProject'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date',
            'due_time' => 'nullable',
        ]);

        // 1. Pastikan task yang dibuat terhubung dengan user yang sedang login
        $data['user_id'] = Auth::id();

        // 2. Logika pencarian/pembuatan Project yang aman
        if (empty($data['project_id'])) {

            $project = Project::where('user_id', Auth::id())->first();

            if (!$project) {
                // Jika user belum punya project sama sekali, buatkan satu yang khusus milik dia
                $project = Project::create([
                    'user_id'     => Auth::id(),
                    'name'        => 'Default Project',
                    'description' => 'Auto-created project for tasks',
                    'category'    => 'General',
                    'deadline'    => now()->addMonth()->toDateString(),
                    'progress'    => 0,
                    'status'      => 'active',
                ]);
            }
            $data['project_id'] = $project->id;
        } else {
            // VALIDASI TAMBAHAN: Pastikan project_id yang dikirim user via form 
            // memang benar milik user tersebut (mencegah manipulasi ID lewat Inspect Element)
            $isMember = Project::where('id', $data['project_id'])
                ->where(function ($query) {
                    $query->where('user_id', auth()->id())
                        ->orWhereHas('members', function ($q) {
                            $q->where('user_id', auth()->id());
                        });
                })->exists();

            if (!$isMember) {
                return back()->withErrors(['project_id' => 'Anda bukan anggota project ini.']);
            }
        }

        Task::create($data);

        // 3. Redirect
        if ($request->filled('project_id')) {
            return redirect()->route('groups.show', $request->project_id)->with('success', 'Task created successfully!');
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        // 1. KEAMANAN: Pastikan task yang akan diupdate benar-benar milik user yang login
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah task ini.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date',
            'due_time' => 'nullable',
        ]);

        // 2. Logika Project yang aman (hanya cari project milik user ini)
        if (empty($data['project_id'])) {
            $project = Project::where('user_id', Auth::id())->first();

            if (!$project) {
                $project = Project::create([
                    'user_id' => Auth::id(),
                    'name' => 'Default Project',
                    'description' => 'Auto-created project for tasks',
                    'category' => 'General',
                    'deadline' => now()->addMonth()->toDateString(),
                    'progress' => 0,
                    'status' => 'active',
                ]);
            }
            $data['project_id'] = $project->id;
        } else {
            // VALIDASI: Pastikan project_id yang dipilih memang milik user ini
            $isOwned = Project::where('id', $data['project_id'])
                ->where('user_id', Auth::id())
                ->exists();

            if (!$isOwned) {
                return back()->withErrors(['project_id' => 'Project tidak valid.']);
            }
        }

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        // Proteksi: Pastikan task yang mau dihapus adalah milik user yang sedang login
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }
    public function calendar()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->whereNotNull('deadline')
            ->orderBy('deadline')
            ->get();

        return view('tasks.calendar', compact('tasks'));
    }
}
