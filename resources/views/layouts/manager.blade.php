<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Responsive</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><style>
    :root {
      --header-bg: #2c3e50;
      --sidebar-bg: #ecf0f1;
    }
    
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    
    #sidebar {
      width: 200px;
      transition: all 0.3s;
    }
    
    @media (max-width: 768px) {
      #sidebar {
        position: fixed;
        left: -200px;
        top: 56px;
        height: calc(100vh - 56px);
        z-index: 1000;
      }
      
      #sidebar.show {
        left: 0;
      }
    }
  </style>
</head>
@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp
<body>
  <div class="d-flex flex-column vh-100">
    <!-- HEADER -->
    <header class="navbar navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <button class="navbar-toggler d-md-none me-2" type="button" onclick="toggleSidebar()">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">LOGO</a>
        <div class="d-flex align-items-center text-white">
          <strong>Pasteur   {{ $user->prenoms }}  {{ $user->nom }}</strong>
        </div>
      </div>
    </header>

    <div class="d-flex flex-grow-1">
      <!-- SIDEBAR -->
      <nav id="sidebar" class="bg-light flex-shrink-0 p-3 border-end">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('manager.dashboard') ? 'active fw-bold' : '' }}" href="{{ route('manager.dashboard') }}">
              <i class="bi bi-house me-2"></i>Accueil
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('manager.users.index') }}" class="nav-link {{ request()->routeIs('manager.users.*') ? 'active fw-bold' : '' }}">
              <i class="fas fa-users me-2"></i>Utilisateurs
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('manager.couple-coaches.index') }}" class="nav-link {{ request()->routeIs('manager.couple-coaches.*') ? 'active fw-bold' : '' }}">
              <i class="fas fa-users me-2"></i>Coaches
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('manager.fiances.index') }}" class="nav-link {{ request()->routeIs('manager.fiances.*') ? 'active fw-bold' : '' }}">
              <i class="far fa-gem me-2"></i>Fiancés
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('manager.fiancailles.index') }}" class="nav-link {{ request()->routeIs('manager.fiancailles.*') ? 'active fw-bold' : '' }}">
              <i class="bi bi-gem me-2"></i>Fiançailles
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('manager.coachings.index') }}" class="nav-link {{ request()->routeIs('manager.coachings.*') ? 'active fw-bold' : '' }}">
              <i class="bi bi-people me-2"></i>Coachings
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('manager.rapports.index') }}" class="nav-link {{ request()->routeIs('manager.rapports.*') ? 'active fw-bold' : '' }}">
              <i class="bi bi-bar-chart-line me-2"></i>Rapports
            </a>
          </li>
          <li class="nav-item mt-3">
            <a href="{{ route('evenements.index') }}" class="nav-link {{ request()->routeIs('evenements.*') ? 'active fw-bold' : '' }}">
              <i class="bi bi-calendar-event me-2"></i>Événements
            </a>
          </li>
          <li class="nav-item mt-3">
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="nav-link text-danger" href="#" onclick="document.getElementById('logout-form').submit()">
                  <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                </a>
            </form>
          </li>
        </ul>
      </nav>

      <!-- CONTENT -->
      <main class="flex-grow-1 p-4 bg-white">
        <div class="card shadow-sm">
          <div class="card-body">
            @yield('content')
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('show');
    }
  </script>
</body>
</html>