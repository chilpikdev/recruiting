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
                @if(auth('admin')->user()->hasRole('admin'))
                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
                @endif
                <li class="breadcrumb-item"><a href="{{ route("admin.vakancies.index") }}">Ваканции</a></li>
                <li class="breadcrumb-item active">{{ isset($data) ? "Редактировать запись" : "Добавить запись" }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="@if(isset($data)) {{ route('admin.vakancies.update', $data->id) }} @else {{ route('admin.vakancies.store') }} @endif" method="POST">
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
                    <h3 class="card-title">Основные</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                    <div class="card-body">
                      <div class="form-group">
                        <label for="title">Название</label>
                        <input type="text" class="form-control" name="title" id="title" @if(isset($data)) value="{{ $data->title }}" @endif>
                    </div>
                    @error('title')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="work_procedures">Процедура работы</label>
                        <textarea class="form-control" name="work_procedures" id="work_procedures">@if(isset($data)){{ $data->work_procedures }}@endif</textarea>
                    </div>
                    @error('work_procedures')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="salary">Зарплата</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" name="salary" id="salary" @if(isset($data)) value="{{ $data->salary }}" @endif>
                        </div>
                    </div>
                    @error('salary')
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
                        <h3 class="card-title">Дополнительные</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Позиция</label>
                            <select class="form-control select2" name="position_id" style="width: 100%;">
                                @foreach ($positions as $value)
                                <option @if(isset($data)) @if($data->position_id == $value->id) {{ "selected" }} @endif @endif value="{{ $value->id }}">{{ $value->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('position_id')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label>Навыки</label>
                            <select class="select2" multiple="multiple" data-placeholder="Select a State" name="skills[]" style="width: 100%;">
                                @foreach ($skills as $value)
                                <option @if(isset($data)) @foreach($data->getSkills as $val) @if($value->id == $val->id) {{ "selected" }} @endif @endforeach @endif value="{{ $value->id }}">{{ $value->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('skills')
                        <p class="text-red-500">{{ $message }}</p>
                        @enderror
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
