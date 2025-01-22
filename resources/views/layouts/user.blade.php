<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AMS')</title>
    <!-- Add CSS files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
     html, body {
            height: 100%;
            margin: 0;
        }

        /* Flexbox layout for the entire page */
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Main content should take the remaining space */
        .content {
            flex: 1;
        }

        /* Footer style */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: relative;
        }
     
    </style>
</head>
<body>
    <!-- Navbar -->
    @auth
    <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Student Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('attendance.view') }}">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('leave.status') }}">Leaves</a>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Profile Image Icon -->
                            @if (Auth::user()->profile_picture)
                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="40" height="40">
            @else
                <img src="{{ asset('default-profile.png') }}" alt="Default Profile Picture" class="rounded-circle" width="40" height="40">
            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Edit Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <div class="container content mt-4">
        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p class="mb-0">&copy; {{ date('Y') }} User Panel. All rights reserved.</p>
    </footer>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
