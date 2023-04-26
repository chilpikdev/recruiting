@extends("admin.layouts.admin")

@section("title", "Отклики вакантов")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Отклики вакантов</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @if(auth('admin')->user()->hasRole('admin'))
              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Главная</a></li>
              @endif
              <li class="breadcrumb-item active">Отклики вакантов</li>
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
                            <th>Имя</th>
                            <th>Эл. почта</th>
                            <th>Фотография</th>
                            <th>Стаж (месяц)</th>
                            <th>Резюме</th>
                            <th>Ожидаемая зарплата</th>
                            <th>Позиции</th>
                            <th>Навыки</th>
                            <th>Владеет языками</th>
                            <th>Дата отклика</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value->getResume->getUser->name }}</td>
                                    <td>{{ $value->getResume->getUser->email }}</td>
                                    <td>@if($value->getResume->avatar) <img src="{{ $value->getResume->avatar }}" width="100%"> @endif</td>
                                    <td>{{ $value->getResume->experience }}</td>
                                    <td>
                                        @foreach (json_decode($value->getResume->files) as $val)
                                        <a href="{{ asset($val) }}" target="_blank">{{ $val }}</a>
                                        @endforeach
                                    </td>
                                    <td>{{ $value->getResume->expected_salary }}</td>
                                    <td>
                                        @foreach ($value->getResume->getPositions as $val)
                                        {{ $val->title }},
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($value->getResume->getSkills as $val)
                                        {{ $val->title }},
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($value->getResume->getLanguages as $val)
                                        {{ $val->name }},
                                        @endforeach
                                    </td>
                                    <td>{{ $value->created_at }}</td>
                                </tr>
                                <tr class="expandable-body">
                                    <td colspan="11">
                                        <div>
                                            <strong>Для ваканции:</strong><br>
                                            <strong>Название ваканции:</strong> {{ $value->getVakancy->title }}<br>
                                            <strong>Продцедура работы:</strong> {{ $value->getVakancy->work_procedures }}
                                        </div>
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
