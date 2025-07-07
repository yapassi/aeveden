<div id="sidebar-wrapper" class="bg-dark text-white p-3">
    <h4 class="mb-4">Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                <i class="bi bi-house-door-fill"></i> Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link text-white">
                <i class="bi bi-people-fill"></i> Utilisateurs
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.rapports.index') }}" class="nav-link text-white">
                <i class="bi bi-journal-text"></i> Rapports
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link text-white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
