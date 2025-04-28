<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    @if(Auth::check())
        <form action="{{ route('logout') }}" method="POST" style="float:right;">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    @endif
    
    @yield('content')
</div>
</body>
</html>
