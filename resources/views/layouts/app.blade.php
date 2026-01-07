<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PKL Yamatogomu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Yamatogomu</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->hasRole('operator'))
                        <li class="nav-item"><a href="{{ route('operator.form') }}" class="nav-link">Operator</a></li>
                    @endif
                    @if(auth()->user()->hasRole('supervisor'))
                        <li class="nav-item"><a href="{{ route('supervisor.dashboard') }}" class="nav-link">Supervisor</a></li>
                    @endif
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link">Admin</a></li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">@csrf<button class="btn btn-link nav-link">Logout</button></form>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>