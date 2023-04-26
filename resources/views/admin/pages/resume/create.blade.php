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
                <li class="breadcrumb-item"><a href="{{ route("admin.resumes.index") }}">Резюме</a></li>
                <li class="breadcrumb-item active">{{ isset($data) ? "Редактировать запись" : "Добавить запись" }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form action="@if(isset($data)) {{ route('admin.resumes.update', $data->id) }} @else {{ route('admin.resumes.store') }} @endif" method="POST" enctype="multipart/form-data">
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
                        <label for="experience">Стаж (месяц)</label>
                        <input type="text" class="form-control" name="experience" id="experience" @if(isset($data)) value="{{ $data->experience }}" @endif>
                    </div>
                    @error('experience')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label for="expected_salary">Ожидаемая зарплата</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" name="expected_salary" id="expected_salary" @if(isset($data)) value="{{ $data->expected_salary }}" @endif>
                        </div>
                    </div>
                    @error('expected_salary')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label>Позиции</label>
                        <select class="select2" multiple="multiple" data-placeholder="Выберите" name="positions[]" style="width: 100%;">
                            @foreach ($positions as $value)
                            <option @if(isset($data)) @foreach($data->getPositions as $val) @if($value->id == $val->id) {{ "selected" }} @endif @endforeach @endif value="{{ $value->id }}">{{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('positions')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label>Навыки</label>
                        <select class="select2" multiple="multiple" data-placeholder="Выберите" name="skills[]" style="width: 100%;">
                            @foreach ($skills as $value)
                            <option @if(isset($data)) @foreach($data->getSkills as $val) @if($value->id == $val->id) {{ "selected" }} @endif @endforeach @endif value="{{ $value->id }}">{{ $value->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('skills')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <label>Какими языками владеете?</label>
                        <select class="select2" multiple="multiple" data-placeholder="Выберите" name="languages[]" style="width: 100%;">
                            @foreach ($languages as $value)
                            <option @if(isset($data)) @foreach($data->getLanguages as $val) @if($value->id == $val->id) {{ "selected" }} @endif @endforeach @endif value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('languages')
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Файлы</h3>
                    </div>
                    <div class="card-body">
                        @if (isset($data) && $data->avatar)
                        <div class="form-group">
                            <img style="width:50%" src="{{ asset($data->avatar) }}">
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Аватар</label>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" id="file">
                                <label class="custom-file-label" for="file">Выбрать файл</label>
                                </div>
                            </div>
                        </div>
                        @error('avatar')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label>Портфолио</label>
                            <div class="input-group">
                                <div class="custom-file">
                                <input type="file" class="custom-file-input" name="files[]" id="file" multiple>
                                <label class="custom-file-label" for="file">Выбрать файлы</label>
                                </div>
                            </div>
                        </div>
                        @error('files')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        @if (isset($data) && $data->files)
                        <div class="well" style="">
                            @foreach (json_decode($data->files) as $key => $value)
                            <div>{{ $key+1 }}. <a href="{{ asset($value) }}" target="_blank">{{ $value }}</a></div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
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
