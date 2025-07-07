<div class="d-flex flex-column h-100">
    <div class="text-center mb-4">
        <h5 class="text-white mt-2">Espace Coach</h5>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="sidebar-link {{ request()->is('coach/dashboard') ? 'active' : '' }}" href="{{ route('coach.dashboard') }}">
                <i class="bi bi-house-door me-2"></i> Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a class="sidebar-link {{ request()->is('coach/coachings') ? 'active' : '' }}" href="{{ route('coach.coachings.index') }}">
                <i class="bi bi-people me-2"></i> Mes coachings
            </a>
        </li>
        <li class="nav-item">
            <a class="sidebar-link {{ request()->is('coach/rapports') ? 'active' : '' }}" href="{{ route('coach.rapports.index') }}">
                <i class="bi bi-journal-text me-2"></i> Rapports
            </a>
        </li>
        <li class="nav-item">
            <a class="sidebar-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
