@extends("admin.layouts.admin")

@section("title", "Редактировать {$data->title}")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Редактировать настройку</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              <li class="breadcrumb-item"><a href="{{ route("admin.settings.index") }}">Настройки</a></li>
              <li class="breadcrumb-item active">Редактировать {{ $data->title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.settings.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">Редактировать {{ $data->title }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <!-- /.form-group -->
                          <div class="form-group">
                            <label>Ключ</label>
                            <input type="text" class="form-control" disabled="disabled" style="width: 100%;" value="{{ $data->key }}">
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <!-- /.form-group -->
                            <div class="form-group">
                              <label>Значение</label>
                              {!! $data->type !!}
                            </div>
                            <input type="hidden" name="value_old" id="value_old" value="{{ $data->value }}">
                            <script>
                                document.getElementById("value").value = document.getElementById("value_old").value;
                            </script>
                            <!-- /.form-group -->
                            @error('value')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror

                            @if (!empty($data->value) && file_exists(public_path($data->value)))
                            <div class="form-group">
                                <img style="width:50%" src="{{ asset($data->value) }}">
                            </div>
                            @endif
                        </div>
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                  </div>
                  <!-- /.card -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
