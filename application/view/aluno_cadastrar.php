<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "aluno";
require_once("menu_esquerdo.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
      <?php
      require_once("aluno_nav.php");
      ?>
      <section class="content">
            <div class="row">
            <div class="col-md-12">            
                  <div class="box">
                  <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar aluno</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/aluno_cadastrar">
                        <input type="hidden" name="aluno[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <div class="col-md-12">
                              <div class="form-group col-md-12">
                              <label>Primeiro nome: </label>
                              <input class="form-control" type="text" 
                              name="aluno[primeiro_nome]" value="" 
                              autocomplete="off" required>
                              </div>
                              <div class="form-group col-md-12">
                              <label>Segundo nome: </label>
                              <input class="form-control" type="text" 
                              name="aluno[segundo_nome]" 
                              autocomplete="off" value="">
                              </div>
                              <div class="form-group col-md-12">
                              <label>Último nome: </label>
                              <input class="form-control" type="text" 
                              name="aluno[ultimo_nome]" value="" 
                              autocomplete="off" required>
                              </div>
                              <!--date-->
                              <div class="form-group col-md-4">
                              <label>Data de nascimento:</label>
                              <div class="input-group date">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" 
                                    id="datepicker" name="aluno[datanascimento]"
                                    autocomplete="off" data-format="dd/MM/yyyy"
                                    required>
                              </div>
                              <!--date-->                              
                              </div>
                              <div class="form-group col-md-12">
                              <input name="form-aluno" 
                              class="btn btn-info" type="submit" value="Cadastrar">
                              </div>
                        </div>
                        </form>
                  </div>          
            </div>
            <!-- /.box -->
            </div>
            </div>
      </section>
</div>
<?php
require_once ("footer.php");
?>
<script>

  $(function () {


    //Date picker
    $('#datepicker').datepicker({
      language: 'pt-BR'
    })

  })
</script>
</body>
</html>