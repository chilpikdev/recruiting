@extends("admin.layouts.admin")

@section("title", isset($data) ? "Редактировать запись ID {$data->id}" : "Добавить запись")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ isset($data) ? "Редактировать запись ID {$data->id}" : "Добавить запись" }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              <li class="breadcrumb-item"><a href="{{ route("admin.permissions.index") }}">Разрешения</a></li>
              <li class="breadcrumb-item active">{{ isset($data) ? "Редактировать запись" : "Добавить запись" }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="@if(isset($data)) {{ route('admin.permissions.update', $data->id) }} @else {{ route('admin.permissions.store') }} @endif" method="POST">
                @csrf
                @if (isset($data))
                    @method("PUT")
                @endif
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Названия разрешения</label>
                                    <input type="text" class="form-control @error('name') border-red-500 @enderror" name="name" id="name" @if(isset($data)) value="{{ $data->name }}" @endif>
                                </div>
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>Роли для разрешения:</label>
                                    @if (isset($roles))
                                    @foreach ($roles as $key => $value)
                                    <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" name="roles[]" type="checkbox" id="customCheckbox{{$key}}" @if (isset($data)) @foreach($data->roles as $val) @if($val->name == $value->name) {{ "checked" }} @endif @endforeach @endif value="{{ $value->id }}">
                                      <label for="customCheckbox{{$key}}" class="custom-control-label">{{ $value->name }}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Сохранить</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
