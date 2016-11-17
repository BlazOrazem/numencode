<aside class="sidebar sidebar-bleachedcedar">
    <ul class="nav metismenu">
        <li class="profile-sidebar-container">
            <div class="profile-sidebar text-center">
                <div class="profile-userpic">
                    <img src="{{ $admin->avatar }}" width="86" height="86" class="img-circle center-block" alt="{{ $admin->name }}">
                    <span class="online"></span>
                </div>
                <div class="profile-usertitle">
                    <div class="name">
                        {{ $admin->name }}
                    </div>
                    <div class="city">
                        <i class="zmdi zmdi-email"></i>{{ $admin->email }}
                    </div>
                </div>
                <div class="profile-activity clearfix"></div>
            </div>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a>
        </li>
        <li>
            <a href="#"><i class="zmdi zmdi-account"></i>Managers<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside collapse">
                <li class="inside-title">Managers</li>
                <li><a href="{{ route('managers.index') }}">List managers</a></li>
                <li><a href="{{ route('managers.create') }}">Add new manager</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="zmdi zmdi-account-circle"></i>Users<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside collapse">
                <li class="inside-title">Managers</li>
                <li><a href="{{ route('users.index') }}">List users</a></li>
                <li><a href="{{ route('managers.create') }}">Add new user</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('roles.index') }}"><i class="zmdi zmdi-settings"></i>Settings<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside collapse">
                <li class="inside-title">Settings</li>
                <li><a href="{{ route('menus.index') }}">Menu types</a></li>
                <li><a href="{{ route('codelist.index') }}">Codelist</a></li>
                <li><a href="{{ route('plugins.index') }}">Plugins</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('tasks.index') }}"><i class="zmdi zmdi-format-align-justify"></i>Tasks</a>
        </li>
    </ul>
    <input id="activeUrl" type="hidden" value="{{ $activeUrl }}">
</aside>