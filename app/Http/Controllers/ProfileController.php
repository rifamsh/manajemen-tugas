<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Get active projects (same logic as dashboard)
        $projects = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)
            ->with('members')
            ->orderBy('created_at', 'desc')
            ->take(4) // Show more projects in profile
            ->get();

        return view('profile.edit', compact('user', 'projects'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'avatar' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');

            // delete old avatar if it's stored in public disk
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $path;
        }

        $user = \App\Models\User::find(Auth::id());
        $user->update($data);

        return redirect()->route('profile.edit')->with('success', 'Profile updated');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048']);
        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');


            $user->update(['avatar' => $path]);
        }

        return back()->with('success', 'Avatar updated!');
    }
}
