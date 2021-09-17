@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      
        <div class="col-lg-3">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalAvaliacoes }}</h3>

              <p>Avaliações</p>
            </div>
            <div class="icon">
              <i class="fas fa-star"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalCursos }}</h3>
              <p>Cursos</p>
            </div>
            <div class="icon">
              <i class="fas fa-layer-group"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalTurmas }}</h3>
              <p>Turmas</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalDisciplinas }}</h3>
              <p>Disciplinas</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
          </div>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection