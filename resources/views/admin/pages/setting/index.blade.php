@extends("admin.layouts.admin")

@section("title", "Настройки сайта")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Настройки</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              <li class="breadcrumb-item active">Настройки</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title">Установите значения</h3>
                      </div>
                <table id="tableForSettings" class="table table-striped">
                    <thead>
                        <tr>
                            <th width="30%">Название</th>
                            <th width="50%">Значение</th>
                            <th width="20%">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                        <tr>
                            <td>{{ $value->title }}</td>
                            <td>
                                @if (!empty($value->value) && file_exists(public_path($value->value)))
                                <div class="form-group">
                                    <img style="width:20%" src="{{ asset($value->value) }}">
                                </div>
                                @else
                                    {{ $value->value }}
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route("admin.settings.edit", $value->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Изменить
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Название</th>
                            <th>Значение</th>
                            <th>Действия</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
