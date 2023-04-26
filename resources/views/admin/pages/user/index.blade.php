@extends("admin.layouts.admin")

@section("title", "Пользователи")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Пользователи</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              <li class="breadcrumb-item active">Пользователи</li>
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
                    <a class="btn btn-success" href="{{ route("admin.users.create") }}">
                        <i class="fas fa-plus">
                        </i>
                        Добавить пользователья
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роли</th>
                            <th>Разрешения</th>
                            <th width="170px">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>
                                @foreach ($value->roles as $val)
                                {{ $val->name }},
                                @endforeach
                            </td>
                            <td>
                                @foreach ($value->getAllPermissions() as $val)
                                {{ $val->name }},
                                @endforeach
                            </td>
                            <td class="text-center">
                                <form action="{{ route("admin.users.destroy", $value->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <a href="{{ route("admin.users.edit", $value->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Изменить
                                    </a>
                                    @if($value->id != auth('admin')->user()->id)
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash">
                                        </i>
                                        Удалить
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роли</th>
                            <th>Разрешения</th>
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
