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
                        <a href="{{ route('managers.profile') }}">{{ $admin->name }}</a>
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
            <a href="{{ route('admin.elements') }}"><i class="zmdi zmdi-view-dashboard"></i>TPL Elements</a>
        </li>
        @if ($admin->can('view_pages'))
            <li>
                <a href="{{ route('pages.index') }}"><i class="zmdi zmdi-format-list-bulleted"></i>Page Structure</a>
            </li>
        @endif
        <li>
            <a href="#"><i class="zmdi zmdi-format-align-justify"></i>Tasks<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside collapse">
                <li class="inside-title">Tasks</li>
                <li><a href="{{ route('tasks.index') }}">List tasks</a></li>
                <li><a href="{{ route('tasks.create') }}">Add new task</a></li>
            </ul>
        </li>
        @if ($admin->can('view_managers') || $admin->can('manage_managers'))
            <li>
                <a href="#"><i class="zmdi zmdi-account"></i>Managers<span class="zmdi arrow"></span></a>
                <ul class="nav nav-inside collapse">
                    <li class="inside-title">Managers</li>
                    <li><a href="{{ route('managers.index') }}">List managers</a></li>
                    @if ($admin->can('manage_managers'))
                        <li><a href="{{ route('managers.create') }}">Add manager</a></li>
                    @endif
                    <li><a href="{{ route('managers.profile') }}">My profile</a></li>
                </ul>
            </li>
        @endif
        @if ($admin->can('view_users') || $admin->can('manage_users'))
            <li>
                <a href="#"><i class="zmdi zmdi-account-circle"></i>Users<span class="zmdi arrow"></span></a>
                <ul class="nav nav-inside collapse">
                    <li class="inside-title">Users</li>
                    <li><a href="{{ route('users.index') }}">List users</a></li>
                    @if ($admin->can('manage_users'))
                        <li><a href="{{ route('users.create') }}">Add new user</a></li>
                    @endif
                </ul>
            </li>
        @endif
        <li>
            <a href="#"><i class="zmdi zmdi-settings"></i>Settings<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside collapse">
                <li class="inside-title">Settings</li>
                @if ($admin->can('manage_menus'))
                    <li><a href="{{ route('menus.index') }}">Menu types</a></li>
                @endif
                @if ($admin->can('view_codelist') || $admin->can('manage_codelist'))
                    <li><a href="{{ route('codelist.index') }}">Codelist</a></li>
                @endif
                @if ($admin->can('view_plugins') || $admin->can('manage_plugins'))
                    <li><a href="{{ route('plugins.index') }}">Plugins</a></li>
                @endif
                @if ($admin->can('view_roles') || $admin->can('manage_roles'))
                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                @endif
                @if ($admin->can('manage_permissions'))
                    <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                @endif
                <li><a href="{{ route('log.viewer') }}" target="_blank">Log Viewer</a></li>
            </ul>
        </li>
    </ul>
    <input id="activeUrl" type="hidden" value="{{ $activeUrl }}">
</aside>