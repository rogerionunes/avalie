@extends('templates.templateDashboard')

@section('contentDashboard')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Adicionar Curso</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Dashboard</li>
              <li class="breadcrumb-item">Curso</li>
              <li class="breadcrumb-item active">Adicionar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
          <form action='{{ route('admin.curso.addCurso') }}' method='POST'>
            @csrf

            @if($errors->all())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5><i class="icon fas fa-ban"></i> Erro!</h5>
              {{ $error }}
            </div>
            @endforeach
            @endif

            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="nome" require>
                </div>
                
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success">Cadastrar Curso</button>
                <a class="btn btn-danger" href="{{ route('admin.curso.list') }}">Cancelar</a>
              </div>
            </div>

          </form>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection