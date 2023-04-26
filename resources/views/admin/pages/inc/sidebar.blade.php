<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset(config('settings.site_logo')) }}" alt="{{ config('settings.site_name') }}" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('settings.site_name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset(auth('admin')->user()->img) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route("admin.users.edit", auth('admin')->user()->id) }}" class="d-block">{{ auth("admin")->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @can('dashboard')
          <li class="nav-item">
            <a href="{{ route("admin.dashboard") }}" class="nav-link @if(request()->is('dashboard') || request()->is('dashboard/*')) active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Панель управления
              </p>
            </a>
          </li>
          @endcan
          @can('manage users')
          <li class="nav-item @if(request()->is('roles') || request()->is('roles/*') || request()->is('permissions') || request()->is('permissions/*') || request()->is('users') || request()->is('users/*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->is('roles') || request()->is('roles/*') || request()->is('permissions') || request()->is('permissions/*') || request()->is('users') || request()->is('users/*')) active @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Управление пользоваетельями
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route("admin.users.index") }}" class="nav-link @if(request()->is('users') || request()->is('users/*')) active @endif">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                        Пользователи
                      </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link @if(request()->is('roles') || request()->is('roles/*')) active @endif">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Роли</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.permissions.index') }}" class="nav-link @if(request()->is('permissions') || request()->is('permissions/*')) active @endif">
                        <i class="fas fa-key nav-icon"></i>
                    <p>Разрешения</p>
                    </a>
                </li>
            </ul>
          </li>
          @endcan
          @can('employer menu')
          <li class="nav-item">
            <a href="{{ route("admin.vakancies.index") }}" class="nav-link @if(request()->is('vakancies') || request()->is('vakancies/*')) active @endif">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Ваканции
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route("admin.getcheckeds") }}" class="nav-link @if(request()->is('getcheckeds') || request()->is('getcheckeds/*')) active @endif">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>
                Отклики вакантов
              </p>
            </a>
          </li>
          @endcan
          @can('job seeker menu')
          <li class="nav-item">
            <a href="{{ route("admin.resumes.index") }}" class="nav-link @if(request()->is('resumes') || request()->is('resumes/*')) active @endif">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Резюме
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route("admin.getvakancies") }}" class="nav-link @if(request()->is('getvakancies') || request()->is('getvakancies/*')) active @endif">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Ваканции для вас
              </p>
            </a>
          </li>
          @endcan
          @can('additional')
          <li class="nav-item @if(request()->is('positions') || request()->is('positions/*') || request()->is('skills') || request()->is('skills/*') || request()->is('languages') || request()->is('languages/*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->is('positions') || request()->is('positions/*') || request()->is('skills') || request()->is('skills/*') || request()->is('languages') || request()->is('languages/*')) active @endif">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Дополнительные
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route("admin.positions.index") }}" class="nav-link @if(request()->is('positions') || request()->is('positions/*')) active @endif">
                      <i class="nav-icon fas fa-map-pin"></i>
                      <p>
                        Позиции
                      </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.skills.index") }}" class="nav-link @if(request()->is('skills') || request()->is('skills/*')) active @endif">
                      <i class="nav-icon fas fa-magic"></i>
                      <p>
                        Навыки
                      </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.languages.index") }}" class="nav-link @if(request()->is('languages') || request()->is('languages/*')) active @endif">
                      <i class="nav-icon fas fa-magic"></i>
                      <p>
                        Языки
                      </p>
                    </a>
                </li>
            </ul>
          </li>
          @endcan
          @can('settings')
          <li class="nav-item">
            <a href="{{ route("admin.settings.index") }}" class="nav-link @if(request()->is('settings') || request()->is('settings/*')) active @endif">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Настройки
              </p>
            </a>
          </li>
          @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
