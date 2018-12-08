<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "aluno";
require_once("menu_esquerdo.php");
if (empty($arr_dados)) {
      exit();
}
$aluno = $arr_dados["aluno"];
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
                        <h3 class="box-title">Editar aluno</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/aluno_editar">
                        <input type="hidden" name="aluno[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="aluno[aluno_id]"
                        value="<?=$aluno["aluno_id"];?>">
                        <div class="col-md-12">
                              <div class="form-group col-md-12">
                              <label>Primeiro nome: </label>
                              <input class="form-control" type="text" 
                              name="aluno[primeiro_nome]"
                              value="<?=$aluno["primeiro_nome"];?>" 
                              autocomplete="off" required>
                              </div>
                              <div class="form-group col-md-12">
                              <label>Segundo nome: </label>
                              <input class="form-control" type="text" 
                              name="aluno[segundo_nome]" 
                              autocomplete="off" 
                              value="<?=$aluno["segundo_nome"];?>">
                              </div>
                              <div class="form-group col-md-12">
                              <label>Último nome: </label>
                              <input class="form-control" type="text" 
                              name="aluno[ultimo_nome]" 
                              value="<?=$aluno["ultimo_nome"];?>" 
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
                                    value="<?=$aluno["datanascimento"];?>"
                                    autocomplete="off" data-format="dd/MM/yyyy">
                              </div>
                              <!--date-->                              
                              </div>
                              <div class="form-group col-md-12">
                              <input name="form-aluno" 
                              class="btn btn-info" type="submit" value="Gravar">
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