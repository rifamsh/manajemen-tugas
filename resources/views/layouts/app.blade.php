<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav>
    <a href="/projects">Projects</a>

    <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<main>
    @yield('content')
</main>
</body>
</html>
