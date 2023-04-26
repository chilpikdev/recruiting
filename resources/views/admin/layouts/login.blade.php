<!DOCTYPE html>
<html lang="en, ru">

@include('admin.pages.inc.head')

<body class="hold-transition login-page">

  <!-- Preloader -->
  @include("admin.pages.inc.preloader")

  <!-- Content Wrapper. Contains page content -->
  @yield("content")
  <!-- /.content-wrapper -->

@include("admin.pages.inc.scripts")
</body>
</html>
