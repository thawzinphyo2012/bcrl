<nav class="subnav" aria-label="Studio">
    <a href="{{ route('studio.dashboard') }}" @if (request()->routeIs('studio.dashboard')) aria-current="page" @endif>Desk</a>
    <a href="{{ route('studio.catalogue') }}" @if (request()->routeIs('studio.catalogue')) aria-current="page" @endif>Catalogue</a>
    <a href="{{ route('studio.roster') }}" @if (request()->routeIs('studio.roster')) aria-current="page" @endif>Roster</a>
    <form method="POST" action="{{ route('studio.logout') }}">
        @csrf
        <button class="btn btn-line" type="submit">Log out</button>
    </form>
</nav>
