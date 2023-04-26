@extends("admin.layouts.admin")

@section("title", isset($data) ? "Редактировать запись ID {$data->id}" : "Добавить пользователья")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ isset($data) ? "Редактировать запись ID {$data->id}" : "Добавить пользователья" }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              <li class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">Пользователи</a></li>
              <li class="breadcrumb-item active">{{ isset($data) ? "Редактировать пользователья" : "Добавить пользователья" }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="@if(isset($data)) {{ route('admin.users.update', $data->id) }} @else {{ route('admin.users.store') }} @endif" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($data))
            @method("PUT")
        @endif
        <div class="row">
                <!-- left column -->
              <div class="col-md-6">
                <!-- general form elements -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Данные пользователья</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                    <div class="card-body">
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control @error('name') border-red-500 @enderror" name="name" id="name" @if(isset($data)) value="{{ $data->name }}" @endif>
                    </div>
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="url">Электронная почта</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="text" class="form-control @error('email') border-red-500 @enderror" name="email" id="email" @if(isset($data)) value="{{ $data->email }}" @endif>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="password">{{ isset($data) ? "Новый пароль" : "Пароль" }}</label>
                        <input type="password" class="form-control @error('password') border-red-500 @enderror" name="password" id="password">
                    </div>
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="form-group">
                        <label for="password_confirmation">Подтверждение пароля</label>
                        <input type="password" class="form-control @error('password_confirmation') border-red-500 @enderror" name="password_confirmation" id="password_confirmation">
                    </div>
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </div>
                <!-- /.card -->

              </div>
              <!--/.col (left) -->

              <!-- right column -->
              <div class="col-md-6">
                <!-- Form Element sizes -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Аватар</h3>
                    </div>
                    <div class="card-body">
                        @if (isset($data) && $data->img)
                        <div class="form-group">
                            <img style="width:50%" src="{{ asset($data->img) }}">
                        </div>
                        @endif

                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input @error('img') border-red-500 @enderror" name="img" id="file">
                                <label class="custom-file-label" for="file">Выбрать файл</label>
                                </div>
                            </div>
                        </div>
                        @error('img')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- Form Element sizes -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Роли</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            @if (isset($roles))
                            @foreach ($roles as $key => $value)
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" name="roles[]" type="checkbox" id="customCheckbox{{$key}}" @if (isset($data)) @foreach($data->roles as $val) @if($val->name == $value->name) {{ "checked" }} @endif @endforeach @endif value="{{ $value->name }}">
                              <label for="customCheckbox{{$key}}" class="custom-control-label">{{ $value->name }}</label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!--/.col (right) -->

            </div>
            <!-- /.row -->
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
