<ul class="mtree transit bubba">
    <li><a href="{{ url('/home') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li>
        <a href="{{ route('tickets.index') }}"><i class="fa fa-ticket"></i> Tickets</a>
    </li>
    <li>
        <a href="{{ route('wikipedias.index') }}"><i class="fa fa-book"></i> Wikipedias</a>
    </li>
    <li>
        <a href="{{ route('archives.index') }}"><i class="fa fa-archive"></i> Archives</a>
    </li>
    <li>
        <a href="{{ route('dailys.index') }}"><i class="fa fa-archive"></i> Daily</a>
    </li>
    <li>
        <a href="#"><i class="fa fa-users"></i> USERS</a>
        <ul>
            <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
            <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
            <li><a class="nav-link" href="{{ route('permissions.index') }}">Manage Permissions</a></li>
        </ul>
    </li>
</ul>