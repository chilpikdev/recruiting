@extends("admin.layouts.admin")

@section("title", "Панель управления")

@section("content")
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
                @if(auth('admin')->user()->hasRole('admin'))
                За последнюю неделю
                @else
                Добро пожаловать в систему!
                @endif
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Главная</a></li>
              <li class="breadcrumb-item active">Панель управления</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
          @if(auth('admin')->user()->hasRole('admin'))
          <div class="row">
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ count($byWeek) }}</h3>

                  <p>Созданы ваканции</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-paper"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ count($checkeds) }}<sup style="font-size: 20px"></sup></h3>

                  <p>Откликались</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          @else
          <div class="card">
            <div class="card-header">
              <h5 class="card-title m-0">Добро пожаловать!</h5>
            </div>
            <div class="card-body">
              <p class="card-text">Здесь вы можете управлять своими записями.</p>
              <a href="#" class="btn btn-primary">Начать работу</a>
            </div>
          </div>
          @endif
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
