<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset(auth('admin')->user()->img) }}" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline">{{ auth("admin")->user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <img src="{{ asset(auth('admin')->user()->img) }}" class="img-circle elevation-2" alt="User Image">
              <p>
                {{ auth("admin")->user()->email }}
                <small>{{ auth("admin")->user()->created_at }}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="{{ route("admin.users.edit", auth('admin')->user()->id) }}" class="btn btn-default btn-flat">Профиль</a>
              <a href="{{ route("admin.logout") }}" class="btn btn-default btn-flat float-right">Выйти</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
    </ul>
</nav>
