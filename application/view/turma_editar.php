<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (empty($arr_dados)) {
      exit();
}
$turma = $arr_dados["turma"];
if ($turma["status"] == "2") {
      $flashMessages = new \Application\Model\FlashMessages;
      $flashMessages->adicionaMensagem("Turma já finalizada!", "2");
      header("Location: /turma");
      exit();
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
      <?php
      require_once("turma_nav.php");
      ?>
      <section class="content">
            <div class="row">
            <div class="col-md-12">            
                  <div class="box">
                  <div class="box-header with-border">
                        <h3 class="box-title">Editar turma</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                  <form method="post" action="/turma_editar">
                        <input type="hidden" name="turma[turma_id]" 
                        value="<?=$turma["turma_id"];?>">
                        <input type="hidden" name="turma[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <div class="col-md-12">
                              <div class="form-group col-md-12">
                              <label>Descricao: </label>
                              <input class="form-control" type="text" 
                              name="turma[descricao]" value="<?=$turma["descricao"];?>" 
                              autocomplete="off" required>
                              </div>
                              <div class="form-group col-md-4">
                              <label>Ano:</label>
                              <input class="form-control" type="number" 
                              name="turma[ano]" value="<?=$turma["ano"]?>">  
                              </div> 
                              <div class="col-md-12"></div>
                              <?php
                              /*
                              <div class="form-group col-md-2">
                              <label>Quantidade de avaliações: </label>
                              <select class="form-control" required
                              name="turma[quantidade_avaliacao]">
                                 <option <?=($turma["quantidade_avaliacao"] = "3")?"checked":"";?>
                                 value="3">3</option>
                                 <option <?=($turma["quantidade_avaliacao"] = "2")?"checked":"";?>
                                 value="2">2</option>
                                 <option <?=($turma["quantidade_avaliacao"] = "1")?"checked":"";?>
                                 value="1">1</option>
                              </select>                                                                                                                    
                              </div>  
                              */
                              ?>   
                              <div class="form-group col-md-12">
                              <input name="form-turma" 
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
</body>
</html>