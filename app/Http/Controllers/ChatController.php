<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        // Get all users except current user for chat list
        $users = User::where('id', '!=', auth()->id())->get();

        // Get projects where user is owner or member
        $projects = Project::where('user_id', auth()->id())
            ->orWhereHas('members', function($q) {
                $q->where('user_id', auth()->id());
            })
            ->with(['members', 'user'])
            ->get();

        $project = null;
        if ($request->has('project_id')) {
            $project = Project::with(['members', 'user'])->find($request->project_id);

            // Check if user is member or owner
            if ($project && ($project->user_id !== auth()->id() && !$project->members->contains('id', auth()->id()))) {
                abort(403);
            }
        }

        return view('chat', compact('users', 'projects', 'project'));
    }
}
