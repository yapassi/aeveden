<aside class="bg-light border-end"
       style="width: 240px; position: fixed; top: 70px; left: 0; height: calc(100vh - 70px); overflow-y: auto;">
    <ul class="nav flex-column p-3">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}">
                🏠 Accueil
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active fw-bold' : '' }}">
                👤 Utilisateurs
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.fiances.index') }}" class="nav-link {{ request()->routeIs('admin.fiances.*') ? 'active fw-bold' : '' }}">
                💍 Fiancés
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.fiancailles.index') }}" class="nav-link {{ request()->routeIs('admin.fiancailles.*') ? 'active fw-bold' : '' }}">
                💑 Fiançailles
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.coachings.index') }}" class="nav-link {{ request()->routeIs('admin.coachings.*') ? 'active fw-bold' : '' }}">
                🧑‍🏫 Coachings
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.rapports.index') }}" class="nav-link {{ request()->routeIs('admin.rapports.*') ? 'active fw-bold' : '' }}">
                📄 Rapports
            </a>
        </li>
        <li class="nav-item mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    🚪 Déconnexion
                </button>
            </form>
        </li>
    </ul>
</aside>
