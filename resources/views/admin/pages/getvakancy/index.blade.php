@extends("admin.layouts.admin")

@section("title", "Ваканции для вас")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ваканции для вас</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @if(auth('admin')->user()->hasRole('admin'))
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              @endif
              <li class="breadcrumb-item active">Ваканции для вас</li>
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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Автор</th>
                            <th>Позиция</th>
                            <th>Навыки</th>
                            <th>Зарплата</th>
                            <th>Создан в</th>
                            <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value['title'] }}</td>
                                    <td>{{ $value['user']->name }}</td>
                                    <td>{{ $value['position']->title }}</td>
                                    <td>
                                        @foreach ($value['skills'] as $val)
                                            {{ $val->title }},
                                        @endforeach
                                    </td>
                                    <td>{{ $value['salary'] }}</td>
                                    <td>{{ $value['created_at'] }}</td>
                                    <td class="text-center">
                                        <form action="{{ route("admin.checkvakancy", [$value['id'], $value['user']->id, $value['resume_id']]) }}" method="POST">
                                            @csrf
                                            @method("PUT")
                                            @php
                                                $checkeds = DB::select('SELECT * FROM checked_vakancies WHERE vakancy_id = ? AND author_id = ? AND resume_id = ?', [$value['id'], $value['user']->id, $value['resume_id']]);
                                            @endphp
                                            <button class="btn btn-success btn-sm" @if($checkeds) disabled @endif type="submit">
                                                <i class="fas fa-check"></i>@if($checkeds) Откликались @else Откликатся @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="expandable-body">
                                    <td colspan="8">
                                        <div><strong>Продцедура работы:</strong></div>
                                        <div>{{ $value['work_procedures'] }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
