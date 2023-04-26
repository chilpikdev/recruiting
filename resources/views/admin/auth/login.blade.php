@extends("admin.layouts.login")

@section("title", "Авторизация")

@section("content")
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="/" class="h1"><img src="{{ asset(config('settings.site_logo')) }}" width="15%"> <b>{{ config('settings.site_name') }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Войдите, чтобы начать работу</p>

      <form action="{{ route("admin.login_process") }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="email" placeholder="Электронная почта">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error("email")
            <p class="text-red-500">{{ $message }}</p>
        @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Пароль">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error("password")
            <p class="text-red-500">{{ $message }}</p>
        @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Запомнить меня
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Войти</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@endsection
