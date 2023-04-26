@extends("admin.layouts.admin")

@section("title", "Ваканции")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ваканции</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @if(auth('admin')->user()->hasRole('admin'))
                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
                @endif
                <li class="breadcrumb-item active">Ваканции</li>
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
                <div class="text-left" style="margin: 20px 0 0 20px">
                    <a class="btn btn-success" href="{{ route("admin.resumes.create") }}">
                        <i class="fas fa-plus">
                        </i>
                        Добавить запись
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Стаж (месяц)</th>
                            <th>Ожидаемая зарплата</th>
                            <th>Позиции</th>
                            <th>Навыки</th>
                            <th>Языки</th>
                            <th width="170px">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                        <tr>
                            <td>{{ $value->experience }}</td>
                            <td>{{ $value->expected_salary }}</td>
                            <td>
                                @foreach ($value->getPositions as $val)
                                    {{ $val->title }},
                                @endforeach
                            </td>
                            <td>
                                @foreach ($value->getSkills as $val)
                                    {{ $val->title }},
                                @endforeach
                            </td>
                            <td>
                                @foreach ($value->getLanguages as $val)
                                    {{ $val->name }},
                                @endforeach
                            </td>
                            <td class="text-center">
                                <form action="{{ route("admin.resumes.destroy", $value->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <a href="{{ route("admin.resumes.edit", $value->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Изменить
                                    </a>
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash">
                                        </i>
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Стаж (месяц)</th>
                            <th>Ожидаемая зарплата</th>
                            <th>Позиции</th>
                            <th>Навыки</th>
                            <th>Языки</th>
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
