<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        @php
            $menus = [
                'admin' => [
                    ['route' => 'admin.dashboard', 'icon' => 'fas fa-tachometer-alt', 'label' => 'Dashboard'],
                    ['header' => 'Administration'],
                    ['route' => 'admin.users.index', 'icon' => 'fas fa-users', 'label' => 'Utilisateurs']
                ],
                'coach' => [
                    ['route' => 'coach.dashboard', 'icon' => 'fas fa-tachometer-alt', 'label' => 'Tableau de bord'],
                    ['header' => 'Gestion'],
                    ['route' => 'coach.fiancailles', 'icon' => 'fas fa-heart', 'label' => 'Fiançailles'],
                    ['route' => 'coach.rapports', 'icon' => 'fas fa-file-alt', 'label' => 'Rapports']
                ]
            ];
        @endphp

        <ul class="nav flex-column">
            @foreach($menus[auth()->user()->role] ?? [] as $item)
                @isset($item['header'])
                    <li class="nav-item mt-3">
                        <span class="nav-link text-muted small">{{ $item['header'] }}</span>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($item['route'].'*') ? 'active' : '' }}" 
                           href="{{ route($item['route']) }}">
                            <i class="{{ $item['icon'] }} me-2"></i>
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endisset
            @endforeach
        </ul>
    </div>
</nav>