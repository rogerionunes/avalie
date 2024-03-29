<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Avalie </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('assets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{url('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Select2 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{url('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets/dist/css/adminlte.min.css')}}">

  {{-- favicon --}}
  <link rel="shortcut icon" href="{{url('assets/dist/img/favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{url('assets/dist/img/favicon.ico')}}" type="image/x-icon">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<style>
  .isDisabled {
    color: currentColor;
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
  }
</style>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        @if (Request::segment(3) != 'sessao')
          <a href="#" class="nav-link">Seja bem vindo, <strong>{{ Auth::user()->name }}.</strong></a>
        @else
          <a href="#" class="nav-link">Seja bem vindo Aluno.</strong></a>
        @endif
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      @if (Request::segment(3) != 'sessao')
        <a href="{{ route('admin.login.logout') }}" class="nav-link">Sair</a>
      @else
        <a href="{{ route('/') }}" class="nav-link">Cancelar</a>
      @endif
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container MENU -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="@if (Request::segment(3) == 'sessao') {{route('autenticar')}} @else {{route('admin')}} @endif" class="brand-link">
      <img src="{{url('assets/dist/img/icon.png')}}" alt="Avalie" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Avalie</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Request::segment(3) != 'sessao')
            <li class="nav-item">
              <a href="{{ route('admin') }}" class="nav-link @if (Request::segment(1) == 'admin' && !Request::segment(2)) active @endif">
                <i class="fas fa-home nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            @if (Auth::user()->tp_usuario != 'P')
              <li class="nav-item has-treeview @if (Request::segment(2) == 'user' || Request::segment(2) == 'curso' || Request::segment(2) ==  'turma' || Request::segment(2) ==  'disciplina' || Request::segment(2) ==  'formulario')) menu-open @endif">
                <a href="#" class="nav-link @if (Request::segment(2) == 'user' || Request::segment(2) == 'curso' || Request::segment(2) ==  'turma' || Request::segment(2) ==  'disciplina' || Request::segment(2) ==  'formulario')) active @endif">
                  <i class="fas fa-plus-square nav-icon"></i>
                  <p>
                    Cadastros
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.users.list') }}" class="nav-link @if (Request::segment(2) == 'user') active @endif">
                      <i class="fas fa-user nav-icon"></i>
                      <p>Usuario</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.curso.list') }}" class="nav-link @if (Request::segment(2) == 'curso') active @endif">
                      <i class="fas fa-layer-group nav-icon"></i>
                      <p>Cursos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.turma.list') }}" class="nav-link @if (Request::segment(2) == 'turma') active @endif">
                      <i class="fas fa-users nav-icon"></i>
                      <p>Turmas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.disciplina.list') }}" class="nav-link @if (Request::segment(2) == 'disciplina') active @endif">
                    <i class="fas fa-book nav-icon"></i>
                      <p>Disciplinas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.formulario.list') }}" class="nav-link @if (Request::segment(2) == 'formulario') active @endif">
                    <i class="fas fa-align-justify nav-icon"></i>
                      <p>Formulários</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview @if (Request::segment(2) == 'comparar')) menu-open @endif">
                <a href="#" class="nav-link @if (Request::segment(2) == 'comparar')) active @endif">
                  <i class="fas fa-chart-pie nav-icon"></i>
                  <p>
                    Relatórios
                    <i class="right fas fa-angle-left"></i>
                  </p>                                                                           
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.comparar') }}" class="nav-link @if (Request::segment(2) == 'comparar') active @endif">
                      <i class="fas fa-project-diagram nav-icon"></i>
                      <p>Comparar Avaliações</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
            <li class="nav-item">
              <a href="{{ route('admin.avaliacao.list') }}" class="nav-link @if (Request::segment(2) == 'avaliacao') active @endif">
                <i class="fas fa-star nav-icon"></i>
                <p>Avaliação</p>
              </a>
            </li>
          @else
            <li class="nav-item">
              <a href="" class="nav-link @if (Request::segment(2) == 'avaliacao') active @endif">
                <i class="fas fa-star nav-icon"></i>
                <p>Avaliação</p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">

    @yield('contentDashboard')

  </div>

  <footer class="main-footer" align="center">
    <strong>Avalie - Sistema de Avaliação Docente
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('assets/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('assets/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- DataTables -->
<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Select2 -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="{{url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{url('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- ChartJS -->
<!-- <script src="{{url('assets/plugins/chart.js/Chart.min.js')}}"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> -->

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<!-- FLOT CHARTS -->
<script src="{{url('assets/plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{url('assets/plugins/flot-old/jquery.flot.resize.min.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{url('assets/plugins/flot-old/jquery.flot.pie.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{url('assets/dist/js/adminlte.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('assets/dist/js/demo.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="@if (Request::segment(2) == '') {{url('assets/dist/js/pages/dashboard.js')}} @else {{url('assets/dist/js/pages/'.Request::segment(2).'.js')}} @endif"></script>

<script>
  
  //datatables
  $(function () {

  //Initialize Select2 Elements
  $('.select2').select2({
    maximumSelectionLength: 3,
    width:'100%',
    allowClear : false,
    language: "pt"
  });

  $('#turmaComparar').select2({
    maximumSelectionLength: 3,
    minimumSelectionLength: 2,
    width:'100%',
    allowClear : false,
    language: "pt"
  });

  $('.select2Simple').select2({
    width:'100%',
    allowClear : false,
    language: "pt"
  });

    var url = window.location.pathname,
    url = url.split('/');

    colunaForm = (url[2] != 'avaliacao')?0:7;
    // order = (url[2] != 'avaliacao')?'desc':'asc';
    order = 'asc';

    var table = $('#table').DataTable({
      dom: 'Bfrtip',
      oLanguage: {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
          "sNext": "Próximo",
          "sPrevious": "Anterior",
          "sFirst": "Primeiro",
          "sLast": "Último"
        },
        "oAria": {
          "sSortAscending": ": Ordenar colunas de forma ascendente",
          "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      },
      ordering: true,
      paging: true,
      pageLength: 15, //paginacao necessaria para otimizar os filtros do relatoria
      searching: true,
      info: false,
      order: [[ colunaForm, order ]]
    });
  });
  
  // AVALIAÇÃO (INICIO)

    $('#btnCadastrar').on('click', function() {
      $('#blocoCadastro').attr('hidden', false);
      $('#btnIniciarAvaliacao').attr('hidden', false);
      $('#btnCancelar').attr('hidden', false);
      $(this).attr('hidden', true);
    });
    
    $('#btnCancelar').on('click', function() {
      $('#curso, #turma, #disciplina').val('').trigger('change');
      $('#turma, #disciplina').attr('disabled', true);
      $('#blocoCadastro').attr('hidden', true);
      $('#btnIniciarAvaliacao').attr('hidden', true);
      $('#btnCadastrar').attr('hidden', false);
      $(this).attr('hidden', true);
    });
  
    $('#curso').on('change', function() {
      if($(this).val() != '') {
        $.ajax({
          url: "{{ route('admin.avaliacao.listTurma') }}",
          dataType: "json",
          type: 'get',
          data: {
            idCurso : $(this).val()
          },
          beforeSend : function() {
            $("#turma").html('<option>Pesquisando...</option>');
            $("#turma").attr('disabled', true);
          }
        })
        .done(function(response) {
          var conteudo = '';
          if (response.status == '1') {
            $("#turma").attr('disabled', false);
            conteudo += '<option value=""></option>';
            $.each(response.dados, function(index, value) {
              conteudo += '<option value="'+value.id+'">'+value.nm_turma+'</option>';
            });
            
          } else {
            conteudo += '<option value="">Nenhuma turma encontrada neste Curso para este professor</option>';
          }
          $("#turma").html(conteudo);
        })
        .fail(function(jqXHR, textStatus, msg) {
          console.log(msg);
        }); 
      }
    });
    
    $('#turma').on('change', function() {
      if($(this).val() != '') {
        $.ajax({
          url: "{{ route('admin.avaliacao.listDisciplina') }}",
          dataType: "json",
          type: 'get',
          data: {
            idTurma : $(this).val()
          },
          beforeSend : function() {
            $("#disciplina").html('<option>Pesquisando...</option>');
            $("#disciplina").attr('disabled', true);
          }
        })
        .done(function(response) {
          var conteudo = '';
          if (response.status == '1') {
            $("#disciplina").attr('disabled', false);
            conteudo += '<option value=""></option>';
            $.each(response.dados, function(index, value) {
              conteudo += '<option value="'+value.id+'">'+value.nm_disciplina+'</option>';
            });
            
          } else {
            conteudo += '<option value="">Nenhuma Disciplina encontrada nesta Turma para este professor</option>';
          }
          $("#disciplina").html(conteudo);
        })
        .fail(function(jqXHR, textStatus, msg) {
          console.log(msg);
        }); 
      }
    });
  
    $('#btnIniciarAvaliacao').on('click', function() {
      
      $('#divMsgErro').attr('hidden', true);
      
      if ($('#curso').val() == '') {
        $('#divMsgErro').attr('hidden', false);
        $('#msgErro').html('O campo Curso é obrigatorio.');
        return;
      }
      
      if ($('#turma').val() == '') {
        $('#divMsgErro').attr('hidden', false);
        $('#msgErro').html('O campo Turma é obrigatorio.');
        return;
      }
      
      if ($('#disciplina').val() == '') {
        $('#divMsgErro').attr('hidden', false);
        $('#msgErro').html('O campo Disciplina é obrigatorio.');
        return;
      }
      
      if (confirm("Tem certeza que deseja INICIAR a avaliação?")) {
        $.ajax({
          url: "{{ route('admin.avaliacao.add') }}",
          dataType: "json",
          type: 'get',
          data: {
            curso : $('#curso').val(),
            turma : $('#turma').val(),
            disciplina : $('#disciplina').val()
          },
          beforeSend : function() {
            $('#btnIniciarAvaliacao').html('<i class="fa fa-spinner fa-spin"></i> Criando...');
            $('#btnIniciarAvaliacao, #btnCancelar').attr('disabled', true);
          }
        })
        .done(function(response) {
          var conteudo = '';
          if (response.status == '1') {
            
            location.reload();
            
          } else {
            $('#btnIniciarAvaliacao').html('Iniciar Avaliação');
            $('#btnIniciarAvaliacao, #btnCancelar').attr('disabled', false);

            $('#divMsgErro').attr('hidden', false);
            $('#msgErro').html(response.erro);
          }
        })
        .fail(function(jqXHR, textStatus, msg) {
          console.log(msg);
        });
      }
    });
    
    $('.confirmationDelete').on('click', function () {
      return confirm('Você tem certeza que deseja CANCELAR a avaliação?');
    });
    
    $('.confirmationFinalizar').on('click', function () {
      return confirm('Você tem certeza que deseja FINALIZAR a avaliação?');
    });
    
    $('.confirmationDeleteAll').on('click', function () {
      return confirm('Você tem certeza que deseja EXCLUIR?');
    });
    
    $('#btnPdf').on('click', function () {
      $('#btnPdf').text('Gerando PDF. . .').attr('disabled', true);
      CreatePDFfromHTML();
    });
    
    $('#btnFinalizarAvaliacao').on('click', function() {
      var valid = true;
      var name = '';

      $( ".fieldsForms" ).each(function() {
        if (!$('[name="'+$(this).attr('name')+'"]:checked').val()) {
          valid = false
        }
      });

      $( ".fieldText" ).each(function() {
        if ($(this).val() == '') {
          valid = false
        }
      });

      
      if (valid) {
        $('form').submit();
      } else {
        alert('É obrigatório preencher todas opções!!');
      }
    });
    
    function copyToClipboard(element) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val($(element).text()).select();
      document.execCommand("copy");
      $temp.remove();
    }

    function CreatePDFfromHTML() {
      var HTML_Width = $(".content-wrapper").width();
      var HTML_Height = $(".content-wrapper").height();
      var top_left_margin = 15;
      var PDF_Width = HTML_Width + (top_left_margin * 2);
      var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
      var canvas_image_width = HTML_Width;
      var canvas_image_height = HTML_Height;

      var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

      html2canvas($(".content-wrapper")[0]).then(function (canvas) {
          
          $('#btnPdf').text('Gerando PDF . . .').attr('disabled', true);
          var imgData = canvas.toDataURL("image/jpeg", 1.0);
          var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
          pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
          for (var i = 1; i <= totalPDFPages; i++) { 
              pdf.addPage(PDF_Width, PDF_Height);
              pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
          }
          pdf.save("Resultado.pdf");
          
          $('#btnPdf').text('Gerar PDF').attr('disabled', false);
          return;
      });
    }

  //COMPARAR AVALIAÇÕES
  
  $('#cursoComparar').on('change', function() {
      if($(this).val() != '') {
        $.ajax({
          url: "{{ route('admin.comparar.listDisciplina') }}",
          dataType: "json",
          type: 'get',
          data: {
            idCurso : $(this).val()
          },
          beforeSend : function() {
            $("#disciplinaComparar").html('<option>Pesquisando...</option>');
            $("#disciplinaComparar").attr('disabled', true);
          }
        })
        .done(function(response) {
          var conteudo = '';
          if (response.status == '1') {
            $("#disciplinaComparar").attr('disabled', false);
            conteudo += '<option value=""></option>';
            $.each(response.dados, function(index, value) {
              conteudo += '<option value="'+value.id+'">'+value.nm_disciplina+'</option>';
            });
            
          } else {
            conteudo += '<option value="">Nenhuma turma encontrada neste Curso para este professor</option>';
          }
          $("#disciplinaComparar").html(conteudo);
        })
        .fail(function(jqXHR, textStatus, msg) {
          console.log(msg);
        }); 
      }
    });
    
    $('#disciplinaComparar').on('change', function() {
      if($(this).val() != '') {
        $.ajax({
          url: "{{ route('admin.comparar.listTurma') }}",
          dataType: "json",
          type: 'get',
          data: {
            idDisciplina : $(this).val()
          },
          beforeSend : function() {
            $("#turmaComparar").html('<option>Pesquisando...</option>');
            $("#turmaComparar").attr('disabled', true);
          }
        })
        .done(function(response) {
          var conteudo = '';
          if (response.status == '1') {
            $("#turmaComparar").attr('disabled', false);
            conteudo += '<option value=""></option>';
            $.each(response.dados, function(index, value) {
              conteudo += '<option value="'+value.id+'">'+value.nm_turma+'</option>';
            });
            
          } else {
            conteudo += '<option value="">Nenhuma Disciplina encontrada nesta Turma para este professor</option>';
          }
          $("#turmaComparar").html(conteudo);
        })
        .fail(function(jqXHR, textStatus, msg) {
          console.log(msg);
        }); 
      }
    });
  
  $('#btnGerarRelComparar').on('click', function () {
    
    if ($('#cursoComparar').val() == '') {
      $('#divMsgErro').attr('hidden', false);
      $('#msgErro').html('O campo Curso é obrigatorio.');
      return;
    }
    
    if ($('#turmaComparar').val() == '') {
      $('#divMsgErro').attr('hidden', false);
      $('#msgErro').html('O campo Turma é obrigatorio.');
      return;
    }
    
    if ($('#disciplinaComparar').val() == '') {
      $('#divMsgErro').attr('hidden', false);
      $('#msgErro').html('O campo Disciplina é obrigatorio.');
      return;
    }
    window.open('/admin/comparar/relatorio/'+$('#cursoComparar').val()+'/'+$('#turmaComparar').val()+'/'+$('#disciplinaComparar').val()+'', '_blank');

  });

</script>
</body>
</html>