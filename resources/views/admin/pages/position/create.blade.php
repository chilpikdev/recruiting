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
              <li class="breadcrumb-item"><a href="{{ route("admin.positions.index") }}">Позиции</a></li>
              <li class="breadcrumb-item active">{{ isset($data) ? "Редактировать запись" : "Добавить запись" }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="@if(isset($data)) {{ route('admin.positions.update', $data->id) }} @else {{ route('admin.positions.store') }} @endif" method="POST">
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
                                    <label for="title">Название</label>
                                    <input type="text" class="form-control" name="title" id="title" @if(isset($data)) value="{{ $data->title }}" @endif>
                                </div>
                                @error('title')
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
                </div>
                <!-- /.row -->
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
