@extends('layouts.app')

@section('content')
<h1>My Projects</h1>

<form method="POST" action="{{ route('projects.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Project name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Add Project</button>
</form>

<ul>
@foreach ($projects as $project)
    <li>{{ $project->name }}</li>
@endforeach
</ul>
@endsection
