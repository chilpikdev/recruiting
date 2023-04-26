<!DOCTYPE html>
<html lang="en, ru">

@include('admin.pages.inc.head')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- @include("admin.pages.inc.preloader") --}}

  <!-- Navbar -->
  @include("admin.pages.inc.navbar")
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include("admin.pages.inc.sidebar")

  <!-- Content Wrapper. Contains page content -->
  @yield("content")
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include("admin.pages.inc.footer")
</div>
<!-- ./wrapper -->

@include("admin.pages.inc.scripts")
</body>
</html>
