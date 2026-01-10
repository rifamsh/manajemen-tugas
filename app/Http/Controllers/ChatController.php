<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan Auth::id() lebih disukai oleh IDE daripada auth()->id()
        $currentUserId = Auth::id();

        // Ambil semua user kecuali user yang sedang login
        $users = User::where('id', '!=', $currentUserId)->get();

        // Ambil project dimana user adalah owner atau member
        $projects = Project::where('user_id', $currentUserId)
            ->orWhereHas('members', function ($q) use ($currentUserId) {
                $q->where('user_id', $currentUserId);
            })
            ->with(['members', 'user'])
            ->get();

        $project = null;
        if ($request->has('project_id')) {
            // Load 'comments.user' agar riwayat chat dan nama pengirimnya muncul
            $project = Project::with(['members', 'user', 'comments.user'])->find($request->project_id);

            // Cek akses: apakah user adalah owner atau member?
            if ($project && ($project->user_id !== $currentUserId && !$project->members->contains('id', $currentUserId))) {
                abort(403, 'Anda tidak memiliki akses ke grup ini.');
            }
        }

        return view('chat', compact('users', 'projects', 'project'));
    }

    public function store(Request $request)
    {
        // 1. Validasi: Pastikan nama field sesuai dengan yang dikirim JS (comment_text)
        $request->validate([
            'comment_text' => 'required|string',
            'project_id'   => 'required|exists:projects,id'
        ]);

        // 2. Simpan ke database
        $comment = new \App\Models\Comment();
        $comment->user_id = \Illuminate\Support\Facades\Auth::id(); // Agar tidak merah di editor
        $comment->project_id = $request->project_id;
        $comment->comment_text = $request->comment_text; // SESUAIKAN DENGAN DATABASE
        $comment->save();

        // 3. Load relasi user agar JavaScript bisa menampilkan nama pengirim
        $comment->load('user');

        return response()->json([
            'status' => 'success',
            'data'   => $comment
        ]);
    }
}
