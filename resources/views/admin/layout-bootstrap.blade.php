<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #343a40 0%, #495057 100%);
            color: white;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar.collapsed {
            transform: translateX(-250px);
        }
        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #495057;
        }
        .sidebar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar .menu li {
            border-bottom: 1px solid #495057;
        }
        .sidebar .menu a {
            display: block;
            padding: 15px 20px;
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }
        .sidebar .menu a:hover, .sidebar .menu a.active {
            color: white;
            background-color: #495057;
            border-left: 4px solid #007bff;
        }
        .sidebar .menu a i {
            margin-right: 10px;
            width: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            background: #f4f6f9;
        }
        .main-content.expanded {
            margin-left: 0;
        }
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .toggle-btn {
            background: none;
            border: none;
            color: #343a40;
            font-size: 20px;
            cursor: pointer;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fa;
            border-top: none;
            font-weight: 600;
        }
        .btn {
            border-radius: 25px;
            font-weight: 500;
        }
        .badge {
            font-size: 0.8em;
        }
        .breadcrumb {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 10px 20px;
        }
        .stats-card {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .stats-card .card-title {
            font-size: 2rem;
            font-weight: 700;
        }
        .stats-card .card-text {
            font-size: 1.5rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                display: none;
            }
            .overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <h4><i class="fas fa-cogs"></i> Admin Panel</h4>
        </div>
        <ul class="menu">
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="{{ route('admin.news') }}" class="{{ request()->routeIs('admin.news*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Manage News</a></li>
            <li><a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}"><i class="fas fa-users"></i> Manage Users</a></li>
            <li><a href="{{ route('admin.tags') }}" class="{{ request()->routeIs('admin.tags*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Manage Tags</a></li>
            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Back to Site</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="btn btn-link text-white w-100 text-start p-0" style="padding: 15px 20px;"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="main-content" id="main-content">
        <nav class="navbar-admin d-flex justify-content-between align-items-center">
            <button class="toggle-btn" id="toggle-btn"><i class="fas fa-bars"></i></button>
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            <div></div>
        </nav>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('collapsed');
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('expanded');
            overlay.classList.toggle('show');
        });

        document.getElementById('overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const overlay = document.getElementById('overlay');
            sidebar.classList.add('collapsed');
            sidebar.classList.remove('show');
            mainContent.classList.remove('expanded');
            overlay.classList.remove('show');
        });
    </script>
</body>
</html>