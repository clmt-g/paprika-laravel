<aside class="col-md-2 sidebar">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="bi bi-house"></i> Accueil
    </a>
    <a href="#" class="{{ request()->is('caserne*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Casernes
    </a>
    <a href="{{ route('pompiers') }}" class="{{ request()->is('pompiers*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Pompiers
    </a>
    <a href="#" class="{{ request()->is('users*') ? 'active' : '' }}">
        <i class="bi bi-person-badge"></i> Users
    </a>
</aside>
