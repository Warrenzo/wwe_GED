<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GED Admin</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Lien vers le fichier CSS personnalisé -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <style>
        /* Style personnalisé pour la sidebar */
        .sidebar-header {
            font-size: 1.5rem;
            color: #f8f9fa;
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #495057; /* Ligne de séparation */
        }

        .sidebar-welcome {
            font-size: 1.1rem;
            color: #adb5bd;
            margin-bottom: 20px;
            padding: 10px 0;
            border-bottom: 1px solid #495057; /* Ligne de séparation */
            text-align: center;
        }

        .sidebar .nav-link {
            color: #f8f9fa;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark flex-column vh-100 sidebar">
        <div class="container-fluid d-flex flex-column">
            <!-- Header de la Sidebar -->
            <div class="sidebar-header">
                GED Admin
            </div>
            <!-- Section de bienvenue -->
            <div class="sidebar-welcome">
                Bienvenue, Admin
            </div>
            <!-- Liens de navigation -->
            <ul class="navbar-nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('documents.index') ? 'active' : '' }}" href="{{ route('documents.index') }}">
                        <i class="bi bi-file-earmark-text"></i> Documents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-people-fill"></i> Utilisateurs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('classifications.index') ? 'active' : '' }}" href="{{ route('classifications.index') }}">
                        <i class="bi bi-layers-fill"></i> Repertoires
                    </a>
                </li>
            </ul>
            <!-- Bouton de déconnexion -->
            <ul class="navbar-nav mt-auto">
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Se deconnecter
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="content flex-grow-1 p-4">
        @yield('content')
    </div>
</div>

<!-- Lien vers Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
