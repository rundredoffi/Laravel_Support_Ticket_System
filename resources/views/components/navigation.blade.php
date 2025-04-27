{{-- Sidebar --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    {{-- Sidebar brand --}}
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('tickets.index') }}">
        <div class="sidebar-brand-icon">
            <img width="50px"src="{{ asset('images/track-it-white.png') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Système de support</div>
    </a>

    {{-- Divider --}}
    <hr class="sidebar-divider my-0">

    {{-- Nav items --}}
    @can ('access-dashboard')
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-gauge-high"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
    @endcan

    <li class="nav-item {{ request()->routeIs('tickets*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('tickets.index') }}">
            <i class="fas fa-fw fa-ticket-simple"></i>
            <span>{{ __('Tickets') }}</span>
        </a>
    </li>

    @can ('viewAny', \App\Models\User::class)
        <li class="nav-item {{ request()->routeIs('users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>{{ __('Utilisateurs') }}</span>
            </a>
        </li>
    @endcan

    @can ('viewAny', \App\Models\Category::class)
        <li class="nav-item {{ request()->routeIs('categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-rectangle-list"></i>
                <span>{{ __('Catégories') }}</span>
            </a>
        </li>
    @endcan

    @can ('viewAny', \App\Models\Label::class)
        <li class="nav-item {{ request()->routeIs('labels*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('labels.index') }}">
                <i class="fas fa-fw fa-tags"></i>
                <span>{{ __('Labels') }}</span>
            </a>
        </li>
    @endcan

    @can ('viewAny', \App\Models\Priority::class)
        <li class="nav-item {{ request()->routeIs('priorities*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('priorities.index') }}">
                <i class="fas fa-fw fa-turn-up"></i>
                <span>{{ __('Priorité') }}</span>
            </a>
        </li>
    @endcan

    @can ('access-activities')
        <li class="nav-item {{ request()->routeIs('activities') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('activities') }}">
                <i class="fas fa-fw fa-timeline"></i>
                <span>{{ __('Logs') }}</span>
            </a>
        </li>
    @endcan

    {{-- Divider --}}
    <hr class="sidebar-divider">

    {{-- Sidebar toggler --}}
    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
{{-- End of sidebar --}}
