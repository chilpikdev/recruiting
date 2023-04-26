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
                    <a class="btn btn-success" href="{{ route("admin.vakancies.create") }}">
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
                            <th>Название</th>
                            <th>Позиция</th>
                            <th>Навыки</th>
                            <th>Зарплата</th>
                            <th>Продцедура работы</th>
                            <th>Просмотры</th>
                            @if(auth('admin')->user()->hasRole('admin'))
                            <th>Отклики</th>
                            @endif
                            <th width="170px">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                        <tr>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->getPosition->title }}</td>
                            <td>
                                @foreach ($value->getSkills as $val)
                                    {{ $val->title }},
                                @endforeach
                            </td>
                            <td>{{ $value->salary }}</td>
                            <td>{{ $value->work_procedures }}</td>
                            <td>{{ $value->views }}</td>
                            @if(auth('admin')->user()->hasRole('admin'))
                            <td>
                                @php
                                    $count = DB::select('SELECT vakancy_id FROM checked_vakancies WHERE vakancy_id=?', [$value->id]);
                                    echo count($count);
                                @endphp
                            </td>
                            @endif
                            <td class="text-center">
                                <form action="{{ route("admin.vakancies.destroy", $value->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <a href="{{ route("admin.vakancies.edit", $value->id) }}" class="btn btn-info btn-sm">
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
                            <th>Название</th>
                            <th>Позиция</th>
                            <th>Навыки</th>
                            <th>Зарплата</th>
                            <th>Продцедура работы</th>
                            <th>Просмотры</th>
                            @if(auth('admin')->user()->hasRole('admin'))
                            <th>Отклики</th>
                            @endif
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
