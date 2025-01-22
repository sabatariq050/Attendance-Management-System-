<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal')</title>
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
    <div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.attendance') }}">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('attendance.report') }}">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.leaves') }}">Leaves</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container content mt-4">
        @yield('content')
    </div>

  <footer class="bg-dark text-white text-center py-3 mt-4">
        <p class="mb-0">&copy; {{ date('Y') }} Admin Panel. All rights reserved.</p>
    </foote>
</div>
</body>
</html>
