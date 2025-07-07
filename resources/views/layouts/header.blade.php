<header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-3 shadow">
    <div class="container-fluid">
        <a class="navbar-brand col-md-3 col-lg-2 me-0" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
        </a>
        
        <div class="dropdown text-end ms-auto">
            <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
                <i class="fas fa-user-circle ms-2 fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-item-text fw-bold">{{ ucfirst(auth()->user()->role) }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>